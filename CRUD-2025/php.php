<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV AND PHP FILES</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <P>CSV and PHP FILES</P>
        <input type="file" name="import_file">
        <br>
        <br>
        <input type="submit" name="import" value="import">
        <input type="submit" name="show" value="show">
        <input type="submit" name="export" value="export file">

    </form>

</body>

</html>


<?php
include('conn.php');
if (isset($_POST['import'])) {

    if ($_FILES['import_file']['name']) {
        $filename = explode(".", $_FILES['import_file']['name']);
        echo "<pre>";
        print_r($filename);
        echo "</pre>";

        if ($filename[1] == "csv") {
            $handle = fopen($_FILES['import_file']['tmp_name'], "r");
            while ($data = fgetcsv($handle)) {
                echo "<pre>";
                print_r($data);
                echo "</pre>";

                $sql = "INSERT INTO `csv_data`(`Name`, `Abbreviation`, `Numeric`, `Numeric-2`) VALUES ('" . $data[0] . "', '" . $data[1] . "', '" . $data[2] . "', '" . $data[3] . "')";
                // $sql = "INSERT INTO csv (`date`, `date_two`, `date_char`)VALUES('" . $data[1] . "','" . $data[2] . "','" . $data[3] . "')";
                $query = mysqli_query($conn, $sql);
                if (!$query) {
                    echo "no insert";
                } else {
                    echo "<br>";
                    echo " upload/insert";
                    // header('location:display.php?page=1');
                }
            }
            fclose($handle);
            echo "upload csv files";
        }
    }
}
?>
<?php
if (isset($_POST['show'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <form action="" method="post">
            <table>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>ABBREVIATION</th>
                    <th>NUMERIC</th>
                    <th>NUMERIC-2</th>
                </tr>

                <?php
                $sql = "SELECT * FROM `csv_data`";
                $q = mysqli_query($conn, $sql);
                if (!$q) {
                    echo "no data found";
                } else {
                    echo "data found";
                }
                $get_data_count = mysqli_num_rows($q);
                echo $get_data_count;
                // $get_data = mysqli_fetch_assoc($q);
                while ($get_data = mysqli_fetch_assoc($q)) {
                ?>


                    <tr>
                        <td><?php echo $get_data['id']; ?> </td>
                        <td><?php echo $get_data['Name']; ?> </td>
                        <td><?php echo $get_data['Abbreviation']; ?> </td>
                        <td><?php echo $get_data['Numeric']; ?> </td>
                        <td><?php echo $get_data['Numeric-2']; ?> </td>

                    </tr>

                <?php

                }

                ?>
            </table>

        </form>
    </body>

    </html>
<?php
}
?>





<?php

if (isset($_POST['export'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('id', 'Name', 'Abbreviation', 'Numeric', 'Numeric-2'));
    $sql = "SELECT * FROM csv_data";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
}
?>