<?php
include('conn.php');
echo "<br>";
echo "<br>";
$id = $_GET['getid'];
echo "id : " . $id;
echo "<br>";
echo "<br>";
$sql = "SELECT * FROM myuser WHERE id={$id}";
$query = mysqli_query($conn, $sql);

$total_data_count = mysqli_num_rows($query);
echo "<br>";
echo "<br>";
echo "number of data is present in database: " . $total_data_count;
$rows = $total_data_count;
if ($rows > 0) {
    echo "<br>";
    echo "data hai";
    $data = mysqli_fetch_assoc($query);

    echo "<br>";
} else {
    echo "<br>";
    echo "data nahi hai";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE-FORM - PAGE</title>
</head>

<body>
    <center>
        <h3 style="color: GREEN;"><u>REGISTRATION FORM</u></h3>
        <form action="" method="POST" enctype="multipart/form-data" style="border: 2px solid black; padding-top:20px; padding-bottom:20px;">

            ID: <input type="text" name="id" value="<?php echo $id; ?>">
            <br>

            <br>

            USERNAME: <input type="text" name="uname" value="<?php echo $data['username']; ?>">
            <br>

            <br>
            EMAIL: <input type="text" name="email" value="<?php echo $data['email']; ?>">
            <br>

            <br>
            PASSWORD: <input type="text" name="password" value="<?php echo $data['password']; ?>">
            <br>


            <br>
            GENDER: <input type="radio" name="gender" value="<?php echo $data['gender']; ?>"> male
            <input type="radio" name="gender" value="<?php echo $data['gender']; ?>"> female
            <br>
            <input type="text" name="gender" value="<?php echo $data['gender']; ?>">
            <br>
            <br>
            <input type="file" name="myfile">
            <br>
            <input type="text" name="file" value="<?php echo $data['profile']; ?>">
            <br>
            <br>
            <input type="submit" name="update" value="update">

        </form>
    </center>
</body>

</html>
<?php

if (isset($_POST['update'])) {

    $username = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "UPDATE myuser set username='$username',email='$email',password='$password' WHERE id={$id}";
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        echo "no update";
    } else {
        echo " updated";
        header('location:display.php');
    }
} else {
    echo "something wrong";
}


?>