<?php
$id = $_GET['id'];
echo "id : " . $id;
echo "<br>";
include('conn.php');
echo "<br>";
$sql = "DELETE  FROM myuser WHERE id={$id}";
$query = mysqli_query($conn, $sql);
if (!$query) {
    echo " no delete";
} else {
    echo " delete";
    header('location:display.php');
}
