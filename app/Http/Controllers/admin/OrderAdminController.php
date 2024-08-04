<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order; // Import model Order
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function index()
    {
        // Lấy tất cả các đơn hàng và eager load userCourse, course và user
        $orders = Order::with('userCourse2.course2', 'userCourse2.user')->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Lấy chi tiết đơn hàng với eager load
        $order = Order::with('userCourse2.course2', 'userCourse2.user')->find($id);

        if (!$order) {
            abort(404);
        }

        return view('admin.orders.show', compact('order'));
    }
}
