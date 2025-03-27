<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Kiểm tra nếu role NULL hoặc không hợp lệ
            if (!$user->role) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => ['Tài khoản của bạn chưa được cấp quyền.'],
                ]);
            }

            // Lưu role vào session để sử dụng trong middleware
            session(['role' =>Auth::user()->role]);


            // Điều hướng theo vai trò
            return match ($user->role) {
                'admin'  => redirect()->route('admin.dashboard'),
                'staff'  => redirect()->route('staff.dashboard'),
                'customer' => redirect()->route('dashboard'),
                default  => redirect()->route('dashboard'),
            };
        }

        throw ValidationException::withMessages([
            'email' => ['Thông tin đăng nhập không chính xác.'],
        ]);
    }

    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'customer', // Mặc định role là customer
        ]);

        Auth::login($user);
        session(['role' => $user->role]);

        return redirect()->route('dashboard');
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
