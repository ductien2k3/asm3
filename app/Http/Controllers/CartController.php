<?php

namespace App\Http\Controllers;

use App\Mail\PaymentSuccessful;
use App\Models\Course;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\UserCourse;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();
        return view('client.cart.index', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $course = Course::find($request->id);

        // Kiểm tra xem khóa học đã tồn tại trong giỏ hàng chưa
        $existingItem = Cart::get($course->id);

        if ($existingItem) {
            // Nếu khóa học đã tồn tại, không thêm mới mà chỉ cập nhật giá trị
            Cart::update($course->id, [
                'quantity' => [
                    'relative' => false,
                    'value' => 1, // Chỉ cần đảm bảo rằng số lượng là 1
                ],
            ]);
        } else {
            // Nếu khóa học chưa tồn tại, thêm mới vào giỏ hàng
            Cart::add([
                'id' => $course->id,
                'name' => $course->title,
                'price' => $course->price,
                'quantity' => 1, // Mỗi khóa học chỉ thêm một lần
                'attributes' => [
                    'image' => $course->image,
                    'start_date' => $course->start_date,
                ]
            ]);
        }

        return redirect()->route('cart.index');
    }


    public function update(Request $request)
    {
        // Xác nhận số lượng và ID
        $id = $request->id;
        $quantity = $request->quantity;

        // Cập nhật số lượng cho sản phẩm trong giỏ hàng
        Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => 1
            ],
        ]);

        // Chuyển hướng đến trang giỏ hàng
        return redirect()->route('cart.index');
    }
    public function remove(Request $request)
    {
        Cart::remove($request->id);

        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        $cartItems = Cart::getContent();
        $totalAmount = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->price * $item->quantity);
        }, 0);
        return view('client.cart.checkout', compact('cartItems', 'totalAmount'));
    }

    public function processPayment(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to be logged in to proceed with payment.');
        }

        $cartItems = Cart::getContent();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $totalAmount = 0;
        $discountAmount = 0;

        if ($request->has('coupon_code') && !empty($request->input('coupon_code'))) {
            $couponCode = $request->input('coupon_code');
            $coupon = Promotion::where('code', $couponCode)->first();

            if ($coupon && $coupon->start_date <= now() && $coupon->end_date >= now()) {
                $discountAmount = $coupon->discount_percentage;
            } else {
                return redirect()->back()->with('error', 'Invalid or expired coupon code.');
            }
        }

        foreach ($cartItems as $item) {
            $totalAmount += $item->price;
        }

        $totalAmount = $totalAmount - ($totalAmount * ($discountAmount / 100));

        foreach ($cartItems as $item) {
            $userCourse = UserCourse::updateOrCreate(
                ['user_id' => $user->id, 'course_id' => $item->id],
                ['status' => 'paid']
            );

            Order::updateOrCreate([
                'user_course_id' => $userCourse->id,
                'payment_date' => now(),
                'amount' => $item->price,
            ]);
        }

        Mail::to($user->email)->send(new PaymentSuccessful($user, $cartItems, $totalAmount));
        Cart::clear();
        return redirect()->route('home')->with('success', 'Payment successful!');
    }


    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon_code');
        $coupon = Promotion::where('code', $couponCode)->first();

        if ($coupon) {
            $now = now();
            if ($coupon->start_date <= $now && $coupon->end_date >= $now) {
                return response()->json([
                    'success' => true,
                    'discountAmount' => $coupon->discount_percentage,
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid or expired coupon code.',
        ]);
    }

}

