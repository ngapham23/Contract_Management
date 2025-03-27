<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Dashboard')</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  @stack('styles')
  <style>
    body, html { margin: 0; padding: 0; font-family: 'Roboto', sans-serif; background: #f4f7f9; color: #333; }
    header { background: #667eea; padding: 1rem; color: #fff; text-align: center; }
    .container { display: flex; min-height: calc(100vh - 70px); }
    .sidebar { width: 250px; background: #2d3748; color: #fff; padding: 1rem; }
    .sidebar h2 { font-size: 1.2rem; margin-bottom: 1rem; }
    .sidebar ul { list-style: none; padding: 0; }
    .sidebar li { margin-bottom: 0.5rem; }
    .sidebar a { color: #cbd5e0; text-decoration: none; display: block; padding: 0.5rem; border-radius: 4px; transition: 0.3s; }
    .sidebar a:hover { background: #4a5568; color: #fff; }
    .logout-button { background: #e53e3e; color: #fff; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer; transition: 0.3s; }
    .logout-button:hover { background: #c53030; }
    .content { flex: 1; padding: 2rem; }
  </style>
</head>
<body>
  <header>
    <h1>Dashboard</h1>
    <p>Chào mừng, {{ auth()->user()->name }}! </p>
  </header>
  
  <div class="container">
    <div class="sidebar">
      <h2>Menu</h2>
      <ul>
        @if(auth()->user()->role == 'admin')
          <li><a href="#">Quản lý khách hàng & nhân viên</a></li>
          <li><a href="{{ route('contracts.index')}}">Quản lý hợp đồng</a></li>
          <li><a href="{{ route('services.index') }}">Quản lý dịch vụ</a></li>
          <li><a href="#">Quản lý thanh toán</a></li>
          <li><a href="#">Báo cáo thống kê</a></li>
        @elseif(auth()->user()->role == 'staff')
          <li><a href="#">Quản lý hợp đồng</a></li>
          <li><a href="#">Quản lý dịch vụ</a></li>
          <li><a href="#">Quản lý thông tin cá nhân</a></li>
        @elseif(auth()->user()->role == 'customer')
          <li><a href="{{ route('services.index') }}">Xem & lựa chọn dịch vụ</a></li>
          <li><a href="{{ route('contracts.index')}}">Quản lý hợp đồng</a></li>
          <li><a href="{{ route('profile.edit')}}">Quản lý thông tin cá nhân</a></li>
        @endif
        <li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">Đăng xuất</button>
          </form>
        </li>
      </ul>
    </div>
    
    <div class="content">
      @yield('content')
    </div>
  </div>
  @stack('scripts')
  <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
