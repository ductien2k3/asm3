<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoriAdminController;
use App\Http\Controllers\admin\ClassAdminController;
use App\Http\Controllers\admin\CourseAdminController;
use App\Http\Controllers\admin\LessonAdminController;
use App\Http\Controllers\admin\OrderAdminController;
use App\Http\Controllers\admin\PromotionAdminController;
use App\Http\Controllers\admin\ReviewAdminController;
use App\Http\Controllers\admin\UserAdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\client\CourseController;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\LessonController;
use App\Http\Controllers\client\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// client home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');

Route::get('/login', [HomeController::class, 'showLogin'])->name('login');
Route::post('/login', [HomeController::class, 'login'])->name('login.post');

Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/store', [HomeController::class, 'store'])->name('store');

Route::get('logout', [HomeController::class, 'logout'])->name('logout');
// client courses
Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('courses');
    Route::get('/detail/{id}', [CourseController::class, 'detail'])->name('coursesDetail');
});

// client teachers
Route::prefix('teacher')->group(function () {
    Route::get('/', [UserController::class, 'indexTeacher'])->name('teacher');
    Route::get('/detail/{id}', [UserController::class, 'detailTeacher'])->name('detailTeacher');
});

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/update-profile', [UserController::class, 'showUpdateForm'])->name('showUpdateForm');
Route::post('/update-profile', [UserController::class, 'update'])->name('updateProfile');

// client lessons
Route::prefix('lesson')->group(function () {
    Route::get('/courses/{courseId}/watch-video/{lessonId}', [LessonController::class, 'watchVideo'])->name('watch-video');
    Route::post('lessons/{lesson}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

});

// client cart
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart', [CartController::class, 'add'])->name('cart.add');
Route::post('cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// checkout cart

Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout', [CartController::class, 'processPayment'])->name('cart.processPayment');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');

//order clients
Route::get('/orders', [HomeController::class, 'showOrders'])->name('orders.index');


//client review
Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');


// admin
Route::prefix('admin')->name('admin.')->middleware('checkRole')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoriAdminController::class, 'index'])->name('index');
        Route::get('/create', [CategoriAdminController::class, 'create'])->name('create');
        Route::post('/store', [CategoriAdminController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoriAdminController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoriAdminController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [CategoriAdminController::class, 'detail'])->name('detail');
        Route::get('/delete/{id}', [CategoriAdminController::class, 'delete'])->name('delete');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', [UserAdminController::class, 'index'])->name('user.index');
    });
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/', [CourseAdminController::class, 'index'])->name('index');
        Route::get('/create', [CourseAdminController::class, 'create'])->name('create');
        Route::post('/store', [CourseAdminController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CourseAdminController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CourseAdminController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CourseAdminController::class, 'delete'])->name('delete');
    });
    Route::prefix('lessons')->name('lessons.')->group(function () {
        Route::get('/', [LessonAdminController::class, 'index'])->name('index');
        Route::get('/create', [LessonAdminController::class, 'create'])->name('create');
        Route::post('/store', [LessonAdminController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [LessonAdminController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [LessonAdminController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [LessonAdminController::class, 'detail'])->name('detail');
        Route::get('/delete/{id}', [LessonAdminController::class, 'delete'])->name('delete');
    });
    Route::prefix('class')->name('class.')->group(function () {
        Route::get('/', [ClassAdminController::class, 'index'])->name('index');
        Route::get('/create', [ClassAdminController::class, 'create'])->name('create');
        Route::post('/store', [ClassAdminController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ClassAdminController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ClassAdminController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [ClassAdminController::class, 'detail'])->name('detail');
        Route::get('/delete/{id}', [ClassAdminController::class, 'delete'])->name('delete');
    });
    Route::prefix('promotion')->name('promotion.')->group(function () {
        Route::get('/', [PromotionAdminController::class, 'index'])->name('index');
        Route::get('/create', [PromotionAdminController::class, 'create'])->name('create');
        Route::post('/store', [PromotionAdminController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PromotionAdminController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [PromotionAdminController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [PromotionAdminController::class, 'detail'])->name('detail');
        Route::get('/delete/{id}', [PromotionAdminController::class, 'delete'])->name('delete');
    });
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserAdminController::class, 'index'])->name('index');
        Route::get('/create', [UserAdminController::class, 'create'])->name('create');
        Route::post('/store', [UserAdminController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserAdminController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UserAdminController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [UserAdminController::class, 'detail'])->name('detail');
        Route::get('/delete/{id}', [UserAdminController::class, 'delete'])->name('delete');
    });
    Route::prefix('review')->group(function () {
        Route::get('/', [ReviewAdminController::class, 'index'])->name('review.index');
    });
    Route::prefix('order')->group(function () {
        Route::get('orders', [OrderAdminController::class, 'index'])->name('orders.index');
        Route::get('orders/{id}', [OrderAdminController::class, 'show'])->name('orders.show');
    });
});