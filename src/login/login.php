<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/sign.css">
    <title>Sign Up</title>
</head>
<body>
    <?php
    require_once "../MYSQL/conexion.php";

        // Inicializar variables para almacenar mensajes de error
$error = "";

// Procesar el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $consultaEm="SELECT * FROM empleados WHERE username = '$username' AND password = '$password'";
    $resultado = mysqli_query($conn, $sql);
    $EmResult=mysqli_query($conn, $consultaEm);
    // Verificar si se encontró un usuario con las credenciales proporcionadas
    if(mysqli_num_rows($EmResult) == 1)
    {
      session_start();
      $_SESSION['username'] = $username;
      header("Location: ../employed/dashboard-emp.php");
      exit();
    }else{
      $error = "Nombre de usuario o contraseña incorrectos";
    }

    if (mysqli_num_rows($resultado) == 1) {
        // Iniciar sesión y redirigir a la página de inicio
        session_start();
        $_SESSION['username'] = $username;
        header("Location: ../users/index.php"); // Cambiar 'index.php' por la página a la que quieres redirigir
        exit();

    }else if($username =='admin23' && $password =='admin') {
      header("Location: ../admin/dashboard-admin.php");  

    }
    else {
        $error = "Nombre de usuario o contraseña incorrectos";
    }
}

// Cerrar la conexión
$conn->close();
?>

  
    <div class="login-box">
        <p>Login</p>
        <form method="post">
          <div class="user-box">
            <input required="" name="username" type="text">
            <label>Username</label>
          </div>
          <div class="user-box">
            <input required="" name="password" type="password">
            <label>Password</label>
          </div>
          <a href="#">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button type="submit">Submit</button>
          </a>
        </form>
       
        <p>Don't have an account? <a href="./sign.php" class="a2">Sign up!</a>
      <br>
      <br>
      Olvidaste tu contraseña? <a href="./recuperar_pw.php" class="a2"> Recuperala aqui</a>
    </p>
    
      </div>

</body>
</html>