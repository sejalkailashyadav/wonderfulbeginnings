<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Cocomelonlearning</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
  
  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
   body, html {
  height: 100%;
  margin: 0;
  font-family: 'Fredoka One', sans-serif;
   }

    .login-container {
      display: flex;
      height: 100vh;
    }

    .login-left {
      background-color: #fff;
      padding: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      flex: 1;
    }
    
    .login-left h2{
        color: #ff4880;
    }

    .login-right {
      background: linear-gradient(107deg, #fff6f9, #ffeef4, #ffd4e1);
      display: flex;
      align-items: center;
      justify-content: center;
      flex: 1;
    }

    .login-right img {
      max-width: 80%;
      height: auto;
    }

    .form-control {
      border-radius: 8px;
      padding: 12px;
    }
    
    .text-user,
    .text-pwd{
        color: #5e2dd8;
    }

    .login-btn {
      background-color: #ff4880;
      border: none;
      padding: 12px;
      width: 100%;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      transition: 0.3s ease-in-out;
    }

    .login-btn:hover {
      background-color: #271344;
    }

    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
      }

      .login-left,
      .login-right {
        flex: unset;
        width: 100%;
        padding: 30px;
      }

      .login-right {
        display: none;
      }
    }
  </style>
</head>
<body>

<div class="login-container">
  <!-- Left: Login Form -->
  <div class="login-left">
    <h2 class="mb-4 text-center">Login to Cocomelon </h2>
    <form method="POST" action="{{ route('doLogin') }}">
      @csrf
      <div class="mb-3">
        <label for="user_name" class="form-label text-user">Username</label>
        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter Username" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label text-pwd">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
      </div>

      <button type="submit" class="login-btn">Login</button>

      @if(session('error'))
      <div class="text-danger text-center mt-3 fw-bold">
        {{ session('error') }}
      </div>
      @endif
    </form>
  </div>

  <!-- Right: Image/Vector -->
  <div class="login-right">
    <img src="https://erp.cocomelonlearning.com/public/login-bg.png" alt="Login Vector">
  </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
