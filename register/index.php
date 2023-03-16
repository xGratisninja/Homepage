<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=homepage', 'root', '');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<?php
//require '../db_connect.php';
//session_start();
if (isset($_GET['sentForm'])) {
    $username = $_POST['userName'];
    $email = $_POST['userEmail'];
    $password = $_POST['userPassword'];
    //Check for username
    $statement = $pdo->prepare("SELECT * FROM user_information WHERE userName = :username");
    $result = $statement->execute(array('username' => $username));
    $user = $statement->fetch();
    if ($user !== false) {
        echo 'Nutzername bereits vergeben<br>';
        $error = true;
    }
}
?>

<body>
    <h1 class="header">Registrieren</h1>
    <br><br><br>
    <div class="Register-form">
        <form action="?sentForm=1" method="post">
            <input autocomplete="off" type="text" size="40" maxlength="27" name="userName" placeholder="Username..." class="FormFeld"><br>
            <input autocomplete="off" type="email" size="40" maxlength="250" name="userEmail" placeholder="E-mail..." class="FormFeld"><br>
            <input autocomplete="off" type="password" size="40" maxlength="250" name="userPassword" placeholder="Password..." class="FormFeld"><br>
            <input class="FormFeldBtn" type="submit" value="Registrieren">
        </form>
    </div>
</body>

</html>