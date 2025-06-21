<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - SISFO SARPRAS</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    body {
      background: linear-gradient(135deg, #667eea, #764ba2);
      min-height: 100vh;
      margin: 0;
      font-family: 'Arial', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .main-container {
      background: white;
      border-radius: 28px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.18);
      display: flex;
      overflow: hidden;
      width: 800px;
      max-width: 98vw;
      min-height: 460px;
      animation: fadeIn 1s;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-30px);}
      to { opacity: 1; transform: translateY(0);}
    }

    .left-anim {
      background: linear-gradient(135deg, #667eea 60%, #764ba2 100%);
      flex: 1.2;
      min-width: 0;
      min-height: 460px;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .right-form {
      flex: 1;
      padding: 40px 32px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      min-width: 0;
    }

    @media (max-width: 900px) {
      .main-container { width: 98vw; }
    }

    @media (max-width: 700px) {
      .main-container { flex-direction: column; width: 98vw; min-height: unset;}
      .left-anim { min-height: 180px; height: 180px;}
      .right-form { padding: 28px 12px; }
    }

    /* Login Form Styles */
    .form-title {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 8px;
      color: #333;
    }

    .form-subtitle {
      font-size: 17px;
      color: #555;
      margin-bottom: 25px;
    }

    .form-group {
      position: relative;
      margin-bottom: 18px;
    }

    .form-control {
      background: #f0f0f0;
      border: none;
      border-radius: 18px;
      padding: 12px 45px 12px 45px;
      font-size: 14px;
    }

    .form-control:focus {
      background: #e6e6e6;
      box-shadow: none;
    }

    .form-group i {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      color: #888;
    }

    .form-group .fa-envelope,
    .form-group .fa-lock {
      left: 15px;
      font-size: 16px;
    }

    .toggle-password {
      right: 15px;
      font-size: 16px;
      cursor: pointer;
      transition: color 0.3s;
    }

    .toggle-password:hover {
      color: #333;
    }

    .btn-primary {
      background: linear-gradient(to right, #667eea, #764ba2);
      border: none;
      border-radius: 18px;
      padding: 12px;
      font-size: 16px;
      width: 100%;
      margin-top: 10px;
      color: white;
      transition: background 0.3s ease;
    }

    .btn-primary:hover {
      background: linear-gradient(to right, #5a67d8, #6b46c1);
    }

    .form-footer {
      font-size: 13px;
      margin-top: 18px;
    }

    .form-footer a {
      color: #667eea;
      text-decoration: none;
      font-weight: bold;
    }

    .form-footer a:hover {
      text-decoration: underline;
    }

    .alert {
      font-size: 14px;
      padding: 10px;
      margin-bottom: 15px;
    }

    /* Animasi bola-bola */
    .balls-canvas {
      width: 100%;
      height: 100%;
      display: block;
      position: absolute;
      top: 0; left: 0;
      z-index: 1;
    }
    .anim-content {
      position: absolute;
      z-index: 2;
      width: 100%;
      top: 0; left: 0;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #fff;
      letter-spacing: 1px;
      pointer-events: none;
      text-shadow: 0 2px 12px rgba(0,0,0,0.13);
    }
    .anim-content h1 {
      font-size: 2.1rem;
      font-weight: 700;
      margin-bottom: 10px;
      letter-spacing: 2px;
    }
    .anim-content p {
      font-size: 1.1rem;
      font-weight: 400;
      opacity: 0.9;
    }
  </style>
</head>

<body>

  <div class="main-container">
    <!-- Kotak Kiri: Animasi -->
    <div class="left-anim">
      <canvas class="balls-canvas"></canvas>
      <div class="anim-content">
        <h1>SISFO SARPRAS</h1>
        <p>Selamat Datang!</p>
      </div>
    </div>
    <!-- Kotak Kanan: Form Login -->
    <div class="right-form">
      <h2 class="form-title">Login</h2>
      <h5 class="form-subtitle">Silakan masuk ke akun Anda</h5>

      <!-- Alert Success -->
      @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif

      <!-- Alert Error -->
      @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('actionlogin') }}" method="post">
        @csrf

        <div class="form-group">
          <i class="fa fa-envelope"></i>
          <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
        </div>

        <div class="form-group">
          <i class="fa fa-lock"></i>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          <i class="fa fa-eye toggle-password" id="togglePassword"></i>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>

        <div class="form-footer">
          Belum punya akun? <a href="{{ route('register') }}">Register</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Show/Hide Password -->
  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  </script>

  <!-- Animasi Bola-bola Bergerak -->
  <script>
    // Simple animated balls
    const canvas = document.querySelector('.balls-canvas');
    const ctx = canvas.getContext('2d');
    let balls = [];
    function resizeCanvas() {
      canvas.width = canvas.offsetWidth;
      canvas.height = canvas.offsetHeight;
    }
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();

    function randomColor() {
      const colors = ['#fff', '#e0e7ff', '#c3aed6', '#a3cef1', '#667eea', '#764ba2', '#7f53ac'];
      return colors[Math.floor(Math.random() * colors.length)];
    }
    function createBalls(n) {
      balls = [];
      for (let i = 0; i < n; i++) {
        balls.push({
          x: Math.random() * canvas.width,
          y: Math.random() * canvas.height,
          r: 18 + Math.random() * 22,
          dx: (Math.random() - 0.5) * 1.6,
          dy: (Math.random() - 0.5) * 1.6,
          color: randomColor(),
          alpha: 0.4 + Math.random() * 0.5
        });
      }
    }
    function animateBalls() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      for (let ball of balls) {
        ctx.globalAlpha = ball.alpha;
        ctx.beginPath();
        ctx.arc(ball.x, ball.y, ball.r, 0, Math.PI * 2);
        ctx.fillStyle = ball.color;
        ctx.fill();
        ball.x += ball.dx;
        ball.y += ball.dy;
        if (ball.x < -ball.r) ball.x = canvas.width + ball.r;
        if (ball.x > canvas.width + ball.r) ball.x = -ball.r;
        if (ball.y < -ball.r) ball.y = canvas.height + ball.r;
        if (ball.y > canvas.height + ball.r) ball.y = -ball.r;
      }
      ctx.globalAlpha = 1;
      requestAnimationFrame(animateBalls);
    }
    function startAnim() {
      resizeCanvas();
      createBalls(window.innerWidth < 700 ? 8 : 14);
      animateBalls();
    }
    startAnim();
    window.addEventListener('resize', startAnim);
  </script>
</body>
</html>
