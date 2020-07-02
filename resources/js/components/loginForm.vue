<template>
    <div class="login-box">
        <!-- MCU Logo -->
        <div class="login-logo">
            <img src="../../img/MCU.png" style=" width:  150px">
        </div>

        <div class="login-logo">
            <p><b>MCU Ticketing System</b></p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Welcome to MCU Ticketing System</p>

                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                           placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="far fa-user" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">

                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
                <p class="col-8">
                    <a href="#" data-toggle="modal" data-target="#exampleModalCenter">
                        I forgot my password
                    </a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</template>

<script>
    export default {}
</script>
