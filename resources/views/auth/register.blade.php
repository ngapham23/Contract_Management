<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    /* Reset mặc định */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
    }
    /* Nền gradient */
    body {
      background: linear-gradient(135deg, #667eea, #764ba2);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 20px;
    }
    /* Container form */
    .register-container {
      background: #fff;
      width: 100%;
      max-width: 400px;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .register-container h1 {
      text-align: center;
      font-size: 2rem;
      font-weight: bold;
      color: #333;
      margin-bottom: 1.5rem;
    }
    .register-container label {
      display: block;
      margin-bottom: 0.5rem;
      color: #555;
      font-weight: bold;
    }
    .register-container input {
      width: 100%;
      padding: 0.75rem;
      margin-bottom: 1rem;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 1rem;
      transition: border-color 0.3s;
    }
    .register-container input:focus {
      border-color: #667eea;
      outline: none;
    }
    .register-container button {
      width: 100%;
      padding: 0.75rem;
      background: #667eea;
      color: #fff;
      font-size: 1.1rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .register-container button:hover {
      background: #5a67d8;
    }
    .register-container p {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.95rem;
      color: #444;
    }
    .register-container a {
      color: #667eea;
      text-decoration: none;
      font-weight: bold;
    }
    .register-container a:hover {
      text-decoration: underline;
    }
    .error-messages {
      background: #ffe6e6;
      border: 1px solid #ffcccc;
      padding: 0.75rem;
      margin-bottom: 1rem;
      border-radius: 5px;
      color: #cc0000;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h1>Đăng ký</h1>
    <!-- Hiển thị lỗi nếu có -->
    @if($errors->any())
      <div class="error-messages">
        @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif
    <form action="{{ route('register') }}" method="POST">
      @csrf
      <div>
        <label for="name">Tên</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
      </div>
      <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
      </div>
      <div>
        <label for="phone">Số điện thoại</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
      </div>
      <div>
        <label for="address">Địa chỉ</label>
        <input type="text" id="address" name="address" value="{{ old('address') }}" required>
      </div>
      <div>
        <label for="password">Mật khẩu</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div>
        <label for="password_confirmation">Xác nhận mật khẩu</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
      </div>
      <button type="submit">Đăng ký</button>
    </form>
    <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a></p>
  </div>
</body>
</html>
