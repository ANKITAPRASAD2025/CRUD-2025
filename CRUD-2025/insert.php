<?php
include('conn.php');
echo "<br>";


$email = $es = '';


if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $myfile = $_FILES['myfile']['name'];

    $file_ext = end(explode('.', $_FILES['myfile']['name']));
    $extensions = array("jpeg", "jpg", "png");


    $password_length = strlen($password);


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
        echo "<h1 style='color:red;'>please enter the username</h1>";
        echo "<br>";
    } elseif (empty($email)) {
        echo "<h1 style='color:red;'>please enter the email</h1>";
        echo "<br>";
    } elseif (!preg_match($ec, $email_two)) {
        $es = "<h1 style='color:red;'>Invalid email </h1>";
        echo $es;
    } elseif (empty($password)) {
        echo "<h1 style='color:red;'>please enter the password</h1>";
    } elseif ($password_length > 8) {
        echo "<h1 style='color:red;'>password must be less than 8</h1>";
        echo "<br>";
    } elseif (empty($gender)) {
        echo "<h1 style='color:red;'>please choose the gender </h1>";
        echo "<br>";
    } elseif (empty($myfile)) {
        echo "<h1 style='color:red;'>please choose the file </h1>";
        echo "<br>";
    } elseif (in_array($file_ext, $extensions) === false) {
        echo "<h1 style='color:red;'>file always png and jpg and jpeg format</h1>";
        echo "<br>";
    } else {
        echo $username;
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $password;
        echo "<br>";
        echo $gender;
        echo "<br>";
        echo $myfile;
    }









    // $file_name = $_FILES['myfile']['name'];
    // $tmp_name = $_FILES['myfile']['tmp_name'];
    // $file_size = $_FILES['myfile']['size'];
    // $file_ext = end(explode('.', $_FILES['myfile']['name']));
    // $extensions = array("jpeg", "jpg", "png");
    // if (in_array($file_ext, $extensions) === true) {
    //     echo "file uploaded";
    // } else {
    //     echo "no upload";
    // }
}
