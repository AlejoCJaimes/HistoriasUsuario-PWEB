<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="icon" href="<?php echo constant('URL');?>resources/img/logo.png">


    <!-- Custom styles for this template -->

    <style type="text/css">
    body {
        color: #fff;
        background: #009888;
        margin-top: 185px;
    }

    .form-control {

        min-height: 41px;
        background: #f2f2f2;
        box-shadow: none !important;
        border: transparent;
    }

    .form-control:focus {
        background: #e2e2e2;
    }

    .form-control,
    .btn {
        border-radius: 2px;
    }

    .modal-login .avatar {
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -70px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #60c7c1;
        padding: 15px;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }

    .modal-login .avatar img {
        width: 100%;
    }

    .login-form {
        width: 350px;
        margin: 30px auto;
        text-align: center;
    }

    .login-form h2 {
        margin: 10px 0 25px;
    }

    .login-form form {
        color: #7a7a7a;
        border-radius: 3px;
        margin-bottom: 15px;
        background: #fff;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }

    .login-form .btn {
        font-size: 16px;
        font-weight: bold;
        background: #3598dc;
        border: none;
        outline: none !important;
    }

    .login-form .btn:hover,
    .login-form .btn:focus {
        background: #2389cd;
    }

    .login-form a {
        color: #fff;
        text-decoration: underline;
    }

    .login-form a:hover {
        text-decoration: none;
    }

    .login-form form a {
        color: #7a7a7a;
        text-decoration: none;
    }

    .login-form form a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>

    <div class="login-form">

        <form name="formularioRegistro" method="POST" action="<?php echo constant('URL');?>account/login">
            <div class="avatar">
                <img src="<?php echo constant('URL');?>resources/img/login.png" alt="Avatar">
            </div>

            <h2 class="form-signin-heading text-center">Iniciar sesión</h2>

            <input type="email" name="correo_usuario" class="form-control" placeholder="Correo" required>
            <input type="password" name="clave_usuario" class="form-control" placeholder="Contraseña" required>
            <button type="submit" class="btn btn-lg btn-primary btn-block">Acceder</button>

            <br>
            <?php echo $this->validacion;?>
            <p><a class="olvidaste_contra" href="#">¿Olvidaste tu contraseña?</a></p>
        </form>
        <p class="text-center small">¿No estás registrado? <a
                href="<?php echo constant('URL');?>usuario">Regístrate!</a></p> <!-- /container -->
        <div id="footer">
            <footer class="pt-4 my-md-5 pt-md-5 border-top">
                <div class="row">
                    <div class="col-12 col-md">
                        <img class="mb-2" src="../../assets/brand/bootstrap-solid.svg" alt="" width="24" height="24">
                        <small class="d-block mb-3 text-white">&copy; 2020-I 2020-II</small>
                        <small class="d-block mb-3 text-white"> Desarrollado por JotaMarios</small>

                    </div>
                </div>
        </div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

</html>