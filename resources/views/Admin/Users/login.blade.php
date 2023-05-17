<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
</head>
<body class="hold-transition login-page">
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Cứu trợ lũ lụt</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

      <p class="login-box-msg"><b>ĐĂNG NHẬP</b></p>

      @include('admin.alert')
      <form action="/store" method="POST">
        <div class="input-group mb-3">
          <input type="text" name='email' class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name='password' class="form-control" placeholder="Mật khẩu">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-7">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Nhớ mật khẩu
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
          </div>
          <!-- /.col -->
        </div>
        @csrf
      </form>
        <a href="register" class="text-center">Đăng ký tài khoản</a>
    @include('admin.footer')
</div>
</html>
