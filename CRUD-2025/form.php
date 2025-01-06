<?php
include('conn.php');
echo "<br>";

$Errusername = '';
$Erremail = '';
$Errpassword = '';
$Errpassword_length = '';
$Errgender = '';
$Errfile = '';
$Errfile_type = '';
$email = $es = '';
$password = $ep = '';

$username = '';
$email = '';
$password = '';
$gender = '';

if (isset($_POST['submit'])) {
    // echo "<pre>";
    // print_r($_POST);
    // exit;
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    // echo "<br>";
    // echo "<pre>";
    // print_r($_FILES['myfile']);

    if ($_FILES['myfile']['name']) {
        $myfile = $_FILES['myfile']['name'];


        $myfileTmp = $_FILES['myfile']['tmp_name'];
        echo "<br>";
        echo $myfileTmp;
        echo "<br>";

        $upload_path = "./IMAGES/" . $myfile;
        echo "<br>";
        echo "file upload" . $upload_path;
        echo "<br>";

        $move_file_path = move_uploaded_file($_FILES['myfile']['tmp_name'], $upload_path);
        echo "file path : " . $move_file_path;
        echo "<br>";
        echo "<br>";

        // move_uploaded_file($_FILES['myfile']['tmp_name'], $upload_path) || die("no upload");

        $file_ext = strtolower(pathinfo($myfile, PATHINFO_EXTENSION));
        $extensions = array("jpeg", "jpg", "png");
    } else {
        $myfile = '';
    }

    $password_length = strlen($password);

    $password_two = trim($password);
    // $epass = "/^(?=.*\d)(?=.*[A-Za-z])(?=.*[A-Z])(?=.*[a-z])(?=.*[ !#$%&'\(\) * +,-.\/[\\] ^ _`{|}~\"])[0-9A-Za-z !#$%&'\(\) * +,-.\/[\\] ^ _`{|}~\"]{8,50}$/";
    $especial_character = "/[!@#$%]/"; //special character
    $enumber = "/\d/";
    $euppercase = "/[A-Z]/";
    $elowercase = "/[a-z]/";


    $email_two = trim($email);
    $ec = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
    // if (preg_match($ec, $email_two)) {
    //     $es = "ok";
    //     echo $es;
    // } else {
    //     $es = "no ok check email id";
    //     echo $es;
    // }
    echo "<br>";

    if (empty($username)) {
        // echo "<h1 style='color:red;'>please enter the username</h1>";
        $Errusername = "<h1 style='color:red;'>please enter the username</h1>";
        echo "<br>";
    } elseif (empty($email)) {
        // echo "<h1 style='color:red;'>please enter the email</h1>";
        $Erremail = "<h1 style='color:red;'>please enter the email</h1>";
        echo "<br>";
    } elseif (!preg_match($ec, $email_two)) {
        $es = "<h1 style='color:red;'>Invalid email </h1>";
        // echo $es;
    } elseif (empty($password)) {
        // echo "<h1 style='color:red;'>please enter the password</h1>";
        $Errpassword = "<h1 style='color:red;'>please enter the password</h1>";
    } elseif ($password_length < 8) {
        // echo "<h1 style='color:red;'>password must be less than 8</h1>";
        $Errpassword_length = "<h1 style='color:red;'>password must be in 8 digit</h1>";
        echo "<br>";
    } elseif (!preg_match($especial_character, $password_two)) {
        $ep = "<h1 style='color:red;'> 1 special charcter </h1>";
    } elseif (!preg_match($euppercase, $password_two)) {
        $ep = "<h1 style='color:red;'> 1 upercase </h1>";
    } elseif (!preg_match($enumber, $password_two)) {
        $ep = "<h1 style='color:red;'> 1 digit </h1>";
    } elseif (!preg_match($elowercase, $password_two)) {
        $ep = "<h1 style='color:red;'> 1 LOWERCASE </h1>";
    } elseif (empty($gender)) {
        // echo "<h1 style='color:red;'>please choose the gender </h1>";
        $Errgender = "<h1 style='color:red;'>please choose the gender </h1>";
        echo "<br>";
    } elseif (empty($myfile)) {
        // echo "<h1 style='color:red;'>please choose the file </h1>";
        $Errfile = "<h1 style='color:red;'>please choose the file </h1>";
        echo "<br>";
    } elseif (in_array($file_ext, $extensions) === false) {
        // echo "<h1 style='color:red;'>file always png and jpg and jpeg format</h1>";
        $Errfile_type = "<h1 style='color:red;'>file always png and jpg and jpeg format</h1>";
        echo "<br>";
    } else {
        $sql = "INSERT INTO myuser (username,email,password,gender,profile)VALUES('$username','$email','$password','$gender','$upload_path')";
        $query = mysqli_query($conn, $sql);
        if (!$query) {
            echo "no insert";
        } else {
            echo " upload/insert";
            // header('location:display.php');
        }



        echo "<br>";
        echo $username;
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $password;
        echo "<br>";
        echo $gender;
        echo "<br>";
        echo $myfile;
        echo "<br>";
        echo $upload_path;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM - PAGE</title>
</head>

<body>
    <center>
        <h3 style="color: GREEN;"><u>REGISTRATION FORM</u></h3>
        <form action="" method="POST" enctype="multipart/form-data" style="border: 2px solid black; padding-top:20px; padding-bottom:20px;">
            USERNAME: <input type="text" name="uname" placeholder="enter your name" value="<?php echo $username; ?>">
            <br>
            <?php echo $Errusername; ?>
            <br>
            EMAIL: <input type="text" name="email" placeholder="enter your email" value="<?php echo $email; ?>">
            <br>
            <?php echo $Erremail; ?>
            <?php echo $es; ?>

            <br>
            PASSWORD: <input type="text" name="password" placeholder="enter your password" value="<?php echo $password; ?>">
            <br>
            <?php echo $Errpassword; ?>
            <?php echo $Errpassword_length; ?>
            <?php echo $ep; ?>
            <br>
            GENDER: <input type="radio" name="gender" value="male" <?php echo $gender == "male" ? "checked" : "" ?>> male
            <input type="radio" name="gender" value="female" <?php echo $gender == "female" ? "checked" : "" ?>> female
            <br>
            <?php echo $Errgender; ?>
            <br>
            <input type="file" name="myfile">
            <br>
            <?php echo $Errfile; ?>
            <?php echo $Errfile_type; ?>
            <br>
            <input type="submit" name="submit" value="submit">

        </form>
    </center>
</body>

</html>