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
include('conn.php');
if (isset($_POST['upload'])) {

    if ($_FILES['myfile']['name']) {

        foreach ($_FILES['myfile']['name'] as $key => $val) {
            // echo $val;
            // exit;
            $myfile_name = $_FILES['myfile']['name'][$key];

            $filename = pathinfo($myfile_name,  PATHINFO_FILENAME) . "_" . time() . "_" . rand();
            $ext = strtolower(pathinfo($myfile_name,  PATHINFO_EXTENSION));
            $myfile = $filename . "." . $ext;
            $extensions_allows = array("jpeg", "jpg", "png", "webp");
            echo "<br>";
            move_uploaded_file($_FILES['myfile']['tmp_name'][$key], './UPLOAD_IMG/' . $val);
        }
        echo "file uploaded";
    } else {
        $myfile_name = '';
    }
}



?>