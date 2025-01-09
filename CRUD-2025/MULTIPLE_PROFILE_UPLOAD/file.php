<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MULTIPLE UPLOAD IMAGES</title>
</head>

<body>
    <FORM action="" method="post" enctype="multipart/form-data">
        <input type="file" name="myfile[]" multiple>

        <br>
        <br>
        <input type="submit" name="upload" value="upload">

    </FORM>
</body>

</html>

<?php


if (isset($_POST['upload'])) {

    $fileErr = array();

    if (!isset($_FILES['myfile']) || empty($_FILES['myfile']['name'][0])) {
        echo "<p style='color: red;'>No files selected. Please choose at least one file to upload.</p>";
    } else {
        include('conn.php');
        foreach ($_FILES['myfile']['name'] as $key => $val) {
            // echo $val;
            // exit;
            $myfile_name = $_FILES['myfile']['name'][$key];
            $myfile_type = $_FILES['myfile']['type'][$key];

            $myfile_tmp = $_FILES['myfile']['tmp_name'][$key];
            $myfile_size = $_FILES['myfile']['size'][$key];

            $filename = pathinfo($myfile_name,  PATHINFO_FILENAME) . "_" . time() . "_" . rand();
            $ext = strtolower(pathinfo($myfile_name,  PATHINFO_EXTENSION));
            $myfile = $filename . "." . $ext;
            $extensions_allows = array("jpeg", "jpg", "png", "webp");

            if (in_array($ext, $extensions_allows) === true) {
                echo "<br>";
                move_uploaded_file($_FILES['myfile']['tmp_name'][$key], './UPLOAD_IMG/' . $val);

                // $sql = "INSERT INTO `myfile`(`file_name`, `file_type`, `file_tmp_name`, `file_size`) VALUES ('$myfile_name','$myfile_type','$myfile_tmp','$myfile_size')";
                // $q = mysqli_query($conn, $sql);
                // if (!$q) {
                //     die("no insert data");
                // } else {
                //     echo "file inserted";
                // }
            } elseif ($extensions_allows != $myfile_name) {
                // echo "<br>";
                // echo "this extensions not allowed";
                // // echo "<br>"    . $myfile_name .  "  " . $myfile_type;
                // echo "<br>"    . $myfile_name .  "  " . $myfile_type;


                // echo "<br>";
                array_push($fileErr, $myfile_name);
            } else {
                echo "<br>";
                echo "only png jpeg jpg and webp files";
                echo "<br>";
            }

            // echo $myfile_name;
            // echo "<br>";
            // echo $myfile_type;
        }
        echo "<br>";
        echo "file uploaded";
        echo "<br>";
        if (count($fileErr) > 0) {
            echo implode(", ", $fileErr) . " not supported. only png jpeg jpg and webp files";
        }
    }
}


?>