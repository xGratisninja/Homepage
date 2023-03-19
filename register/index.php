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
    <script>
        function ErrorHandling(Message, type) {
            if (type == "text") {
                let EditMessage = 'document.getElementbyId("Errors").innerHTML+=<p style="color:Red;font-weight: bold;">An Error Occured(' + Message + ')</p>'
                return (EditMessage)
            } else if (type == "alert") {
                let EditMessage = 'An Error Occured(' + Message + ')'
                alert(EditMessage)
            }
        }
    </script>
</head>

<body>
    <h1 class="header">Registration</h1>
    <br>
    <div id="Errors"></div><br>
    <div class="Register-form">
        <form action="?register=1" method="post">
            <input autocomplete="off" type="text" size="40" maxlength="27" name="userName" placeholder="Username..." class="FormFeld"><br>
            <input autocomplete="off" type="email" size="40" maxlength="250" name="userEmail" placeholder="E-mail..." class="FormFeld"><br>
            <input autocomplete="off" type="password" size="40" maxlength="250" name="userPassword" placeholder="Password..." class="FormFeld"><br>
            <input class="FormFeldBtn" type="submit" value="Register">
        </form>
    </div>
</body>
<?php
if (isset($_GET['register'])) {
    $UserMadeError = false;
    $username = $_POST['userName'];
    $email = $_POST['userEmail'];
    $password = $_POST['userPassword'];

    // Check if entry fields aren't empty
    if (strlen($password) == 0) {
        echo "<script>
        ErrorHandling('Please enter a Password.<br>','text');
        </script>";
        $UserMadeError = true;
    }

    // Username handling
    if ($username == "") {
        echo "<script>
        ErrorHandling('Please enter an Username.<br>','text');
        </script>";
        $UserMadeError = true;
    } else if (!$UserMadeError) {
        //Check if username is taken
        $statement = $pdo->prepare("SELECT * FROM user_information WHERE userName = :username");
        $result = $statement->execute(array('username' => $username));
        $fetch = $statement->fetch();
        if ($fetch !== false) {
            echo "<script>
            ErrorHandling('Username is already Taken.<br>','text');
            </script>";
            $UserMadeError = true;
        }
    }
    // E-Mail handling
    if (strlen($email) == 0) {
        echo "<script>
        ErrorHandling('Please enter an Email.<br>','text');
        </script>";
        $UserMadeError = true;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //Validating if E-Mail is entered correctly
        echo "<script>
        ErrorHandling('Please enter a correct E-Mail.<br>','text');
        </script>";
        $UserMadeError = true;
    } else if (!$UserMadeError) {
        // Check if E-Mail is taken
        $statement = $pdo->prepare("SELECT * FROM user_information WHERE UserEmail = :userEmail");
        $result = $statement->execute(array('userEmail' => $email));
        $fetch = $statement->fetch();
        if ($fetch !== false) {
            echo "<script>
            ErrorHandling('E-Mail is already Taken.<br>','text')
            </script>";
            $UserMadeError = true;
        }
    }

    if (!$UserMadeError) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $statement = $pdo->prepare("INSERT INTO user_information (UserName, UserPassword, UserEmail) VALUES (:username,:hashedPassword,:email)");
        $result = $statement->execute(array('username' => $username, 'hashedPassword' => $hashedPassword, 'email' => $email));
        if ($result) {
            echo "<script>
            document.getElementbyId('Errors').innerHTML += ErrMessage
            </script>;";
        } else {
            echo "<script>
            ErrorHandling('Error whilst saving into database.<br>','text');
            </script>";
        }
    }
}

?>

</html>