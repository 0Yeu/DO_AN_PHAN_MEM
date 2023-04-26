<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
</head>
<body class="register-page" style="min-height: 570.781px;">
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<div class="register-box">
    <div class="register-logo">
        <a href="/"><b>Admin</b>LTE</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>
            @include('admin.alert')
            <form action="/create" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Full name" name="tenNguoiDung">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Retype password" name="confirmpass">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                    <!-- /.col -->
                <button type="submit" class="btn btn-primary btn-block">Register</button>
                    <!-- /.col -->
                @csrf
            </form>

            <a href="login" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->
@include('admin.footer')

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>


</body>
</html>
