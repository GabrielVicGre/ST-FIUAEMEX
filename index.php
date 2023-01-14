
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/CSS/login.css">
    <link rel="stylesheet" href="Assets/CSS/inputs.css">
    <link rel="stylesheet" href="Assets/CSS/loginResponsive.css">
    <link rel="icon" href="Assets/Images/iconpages.jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
   
    <main>
        <div class="left-panel shadow-box">
            <div class="logo-container">
                <img id="uaemex-logo" src="Assets/Images/negativo_color_vertical_2_lineas.png" alt="UAEMex Logo">
            </div>
            <div class="logo-container">
                <img id="fi-logo" src="Assets/Images/logoadministracion.png" alt="Facultad de Ingeniería Logo">
            </div>
        </div>
        <div class="login-panel shadow-box">
            <h3 class="titLogin">Sistema de Actividades de <b>Tutoría</b></h3>
            <form action="Config/Ingresar.php" method="POST">
                <div class="imgcontainer">
                    <img class="imgLogin" src="https://icones.pro/wp-content/uploads/2021/02/icone-utilisateur-gris.png" alt="Avatar" class="avatar">
                </div>

                <div class="containerLogin">
                    <label class="labelLogin pt-1 pb-1" for="uname"><b>Usuario:</b></label>
                    <input type="text" placeholder="correo@uaemex.mx" name="user" required>

                    <label class="labelLogin pt-1 pb-1" for="psw" class="pt-3"><b>Contraseña:</b></label>
                    <input type="password" placeholder="Ingresa tu contraseña" name="password" required>

                    <div class="container my-4 text-center">
                        <div class="g-recaptcha" data-sitekey="6LdYZHAjAAAAAAfVYBpi8oH80kZkuJgDOP5WFQaX">
                        </div>
                    </div>

                    <div class="text-center">
                        <input type="submit" class="btnIngresar" name="Ingresar" value="Ingresar">
                    </div>

                    <div class="errorSesion">
                        <?php
                        if (isset($_GET['e'])) {
                            echo "<h5> Usuario/Contraseña Incorrectos</h5>";
                        }
                        ?>
                    </div>
                </div>

            </form>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".errorSesion").fadeOut(1500);
            }, 3000);
        });
    </script>   
</body>

</html>