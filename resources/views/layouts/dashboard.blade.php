<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Dashboard')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Sử dụng Google Fonts nếu cần -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  @stack('styles')
  <style>
    /* Reset & Global Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body, html {
      font-family: 'Roboto', sans-serif;
      background: #f4f7f9;
      color: #333;
      height: 100%;
    }
    /* Header */
    header {
      background: #4a76a8;
      padding: 1rem 2rem;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    header .logo {
      font-size: 1.8rem;
      font-weight: bold;
    }
    header .user-info {
      font-size: 1rem;
    }
    /* Container Layout */
    .dashboard-container {
      display: flex;
      min-height: calc(100vh - 70px);
    }
    /* Sidebar */
    .sidebar {
      width: 250px;
      background: #2d3748;
      color: #fff;
      padding: 1.5rem 1rem;
    }
    .sidebar h2 {
      font-size: 1.4rem;
      margin-bottom: 1rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid #4a5568;
    }
    .sidebar ul {
      list-style: none;
      padding: 0;
    }
    .sidebar li {
      margin-bottom: 0.8rem;
    }
    .sidebar a {
      color: #cbd5e0;
      text-decoration: none;
      display: block;
      padding: 0.6rem;
      border-radius: 4px;
      transition: background 0.3s;
    }
    .sidebar a:hover {
      background: #4a5568;
      color: #fff;
    }
    /* Content Area */
    .content {
      flex: 1;
      padding: 2rem;
      background: #fff;
      overflow-y: auto;
    }
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .dashboard-container {
        flex-direction: column;
      }
      .sidebar {
        width: 100%;
      }
    }
    .user-actions {
    display: flex;
    flex-direction: column; /* Chuyển về dạng cột để "Chào mừng" nằm trên */
    align-items: flex-end; /* Canh về phía phải */
    gap: 5px; /* Giữ khoảng cách nhỏ giữa các phần tử */
}

.welcome-text {
    font-size: 1rem;
    font-weight: bold;
}

.logout-button {
    background: #e53e3e;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
    font-size: 0.9rem;
}

.logout-button:hover {
    background: #c53030;
}


  </style>
</head>
<body>
  <header>
    <div class="logo">
      <a href="{{ route('dashboard') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 85px;"></a>
  </div>
  
    <div class="user-actions">
      <span class="welcome-text">Chào mừng, {{ auth()->user()->name }}!</span>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-button">Đăng xuất</button>
      </form>
    </div>
  </header>
  
  </header>
  
  <div class="dashboard-container">
    <div class="sidebar">
      <h2>Menu</h2>
      <ul>
        @if(auth()->user()->role == 'admin')
          <li><a href="#">Quản lý khách hàng &amp; nhân viên</a></li>
          <li><a href="{{ route('contracts.index') }}">Quản lý hợp đồng</a></li>
          <li><a href="{{ route('services.index') }}">Quản lý dịch vụ</a></li>
          <li><a href="#">Quản lý thanh toán</a></li>
          <li><a href="#">Báo cáo thống kê</a></li>
        @elseif(auth()->user()->role == 'staff')
          <li><a href="#">Quản lý hợp đồng</a></li>
          <li><a href="#">Quản lý dịch vụ</a></li>
          <li><a href="#">Quản lý thông tin cá nhân</a></li>
        @elseif(auth()->user()->role == 'customer')
          <li><a href="{{ route('services.index') }}">Xem &amp; lựa chọn dịch vụ</a></li>
          <li><a href="{{ route('contracts.index') }}">Quản lý hợp đồng</a></li>
          <li><a href="{{ route('profile.edit') }}">Quản lý thông tin cá nhân</a></li>
        @endif
        {{-- <li style="margin-top: 1rem;">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button" style="width: 100%; background: #e53e3e; padding: 0.6rem; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s;">Đăng xuất</button>
          </form>
        </li> --}}
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
