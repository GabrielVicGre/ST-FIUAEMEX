<?php

include_once('connectPOO.php');

$verificado = false;
$secretkey = "6LdYZHAjAAAAAENeEpFGfuj2Xpao9KV50ymJMSv9"; 

if (!isset($_POST["g-recaptcha-response"]) || empty($_POST["g-recaptcha-response"])) {
    exit("Debes completar el captcha");
}

# Antes de comprobar usuario y contraseña, vemos si resolvieron el captcha
$token = $_POST["g-recaptcha-response"];
$verificado = verificarToken($token, $secretkey);

# Si no ha pasado la prueba
if ($verificado) {
    //echo "Has completado la prueba :)";
    $user = $_POST['user'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM usuario u INNER JOIN tipo_usuario tu ON
            u.id_tipo_usuario=tu.id_tipo_usuario WHERE 
            u.email like '".$user."' AND u.password like '".$password."'";
    $data = $connection->query($sql);  // ejecuta query
    if($data->num_rows == 1){  // Si encuentra algun registro entonces 
        $usuario = mysqli_fetch_array($data);
        if(isset($_POST["Ingresar"])){
            session_start();
            $_SESSION['usuario'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['tipo_usuario'] = $usuario["tipo"]; 
            $_SESSION['id_usuario'] = $usuario["id_usuario"];
        }  
        $tipoUsuario = $usuario["tipo"];
        switch ($tipoUsuario) {
            case "Administrador":
                header("Location: ../Views/Administrador/index.php");
                break;
            case "Tutor":
                header("Location: ../Views/Tutor/index.php");
                break;
            case "Alumno":
                header("Location: ../Views/Alumno/index.php");
                break;
        }
    }else{  // No encuentra el registro
        header("Location: ../index.php?e");     
    }
} else {
    exit("Lo siento, parece que eres un robot");
}


function verificarToken($token, $claveSecreta){
    # La API en donde verificamos el token
    $url = "https://www.google.com/recaptcha/api/siteverify";
    # Los datos que enviamos a Google
    $datos = [
        "secret" => $claveSecreta,
        "response" => $token,
    ];
    // Crear opciones de la petición HTTP
    $opciones = array(
        "http" => array(
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($datos), # Agregar el contenido definido antes
        ),
    );
    # Preparar petición
    $contexto = stream_context_create($opciones);
    # Hacerla
    $resultado = file_get_contents($url, false, $contexto);
    # Si hay problemas con la petición (por ejemplo, que no hay internet o algo así)
    # entonces se regresa false. Este NO es un problema con el captcha, sino con la conexión
    # al servidor de Google
    if ($resultado == false) {
        # Error haciendo petición
        return false;
    }

    # En caso de que no haya regresado false, decodificamos con JSON
    # https://parzibyte.me/blog/2018/12/26/codificar-decodificar-json-php/

    $resultado = json_decode($resultado);
    # La variable que nos interesa para saber si el usuario pasó o no la prueba
    # está en success
    $pruebaPasada = $resultado->success;
    # Regresamos ese valor, y listo (sí, ya sé que se podría regresar $resultado->success)
    return $pruebaPasada;
}




   
