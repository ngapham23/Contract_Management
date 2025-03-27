<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerProfileController;
// Route mặc định: nếu đã đăng nhập chuyển đến dashboard, nếu chưa chuyển đến login
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Routes cho khách chưa đăng nhập
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Route đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes cần đăng nhập
Route::middleware('auth')->group(function () {
    // Dashboard: Bỏ phân quyền, ai cũng vào được
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Quản lý dịch vụ (Ai cũng có quyền)
    Route::resource('services', ServiceController::class);

    // Quản lý hợp đồng (Ai cũng có quyền)
    Route::resource('contracts', ContractController::class);

    // Quản lý thanh toán (Ai cũng có quyền)
    Route::resource('payments', PaymentController::class);

    // Quản lý người dùng (Ai cũng có quyền)
    Route::resource('users', UserController::class);

    // Quản lý khách hàng (Ai cũng có quyền)
    Route::resource('customers', CustomerController::class);

    // Cài đặt hệ thống (Ai cũng có quyền)
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');

    // Các chức năng bổ sung
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [CustomerProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [CustomerProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [CustomerProfileController::class, 'updatePassword'])->name('profile.password');
    });
    
    Route::post('contracts/{contract}/sign', [ContractController::class, 'sign'])->name('contracts.sign');
    Route::post('contracts/{contract}/cancel', [ContractController::class, 'cancel'])->name('contracts.cancel');
    Route::post('contracts/{contract}/extend', [ContractController::class, 'extend'])->name('contracts.extend');
    Route::post('services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    Route::post('payments/{payment}/update-status', [PaymentController::class, 'updateStatus'])->name('payments.update-status');
});
