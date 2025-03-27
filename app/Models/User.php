<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Model;
class User extends Authenticatable
{
    use HasFactory, Notifiable,HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'role', // Sử dụng đúng cột role trong database
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    /**
     * Lấy tên role (dành cho middleware)
     */
    public function roleName()
    {
        return $this->role; // Trả về 'admin', 'user', ...
    }
}
//Model này dùng để xác định các trường trong bảng users
//ví dụ: protected $fillable = ['name', 'email', 'password', 'role'];
//các trường này sẽ được lấy từ form và lưu vào database
//ví dụ: protected $hidden = ['password', 'remember_token'];
//các trường này sẽ không được hiển thị khi trả về dữ liệu
//ví dụ: protected function casts(): array
//các trường này sẽ được chuyển đổi sang kiểu dữ liệu khác  