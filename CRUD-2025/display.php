<?php
include('conn.php');
echo "</br>";
$limit = 4;
$page = $_GET['page'];
echo "pages number : " . $page;
echo "</br>";
$offset = ($page - 1) * $limit;
echo "offset  : " . $offset;
// echo "</br>";
$sql = "SELECT * FROM myuser LIMIT {$offset},{$limit} ";
$query = mysqli_query($conn, $sql);
if (!$query) {
    echo "<br>";
    echo "<br>";
    die("no data fetch");
} else {
    echo "<br>";
    echo "<br>";
    echo "data fetch";
}
$total_data_count = mysqli_num_rows($query);
echo "<br>";
echo "<br>";
echo "number of data is present in database: " . $total_data_count;

$rows = $total_data_count;






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME/DISPLAY-PAGE</title>
</head>

<body>
    <center>
        <form action="" method="post" enctype="multipart/form-data">
            <H1>welcome</H1>

            <table style="border: 2px solid black;">

                <tr>
                    <th style="border: 2px solid black;">ID</th>
                    <th style="border: 2px solid black;">USERNAME</th>
                    <th style="border: 2px solid black;">EMAIL</th>
                    <th style="border: 2px solid black;">PASSWORD</th>
                    <th style="border: 2px solid black;">GENDER</th>
                    <!-- <th style="border: 2px solid black;">IAMGES_PATH</th> -->
                    <th style="border: 2px solid black;">IAMGES_PATH</th>
                    <th style="border: 2px solid black;">PROFILE</th>
                    <th style="border: 2px solid black;"> ACTIONS </th>
                </tr>


                <tr>
                    <?php


                    if ($rows > 0) {
                        echo "data hai";
                        while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo $data['password']; ?></td>
                    <td><?php echo $data['gender']; ?></td>





                    <td><?php echo $data['image_path']; ?></td>
                    <td>
                        <img src="IMAGES/<?php echo $data['profile_img']; ?>" alt="" srcset="" height="50">
                    </td>
                    <td><a href="update.php?getid=<?php echo $data['id']; ?>">update</a></td>
                    <td><a href="delete.php?id=<?php echo $data['id']; ?>">delete</a></td>
                </tr>
            <?php

                        }

                        echo "<br>";

                        $sql = "SELECT *FROM myuser ";
                        $query_page_data = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query_page_data) > 0) {
                            $tota_records = mysqli_num_rows($query_page_data);
                            // $limit = 2;
                            $total_pages = ceil($tota_records / $limit);
                            echo " <ul style='display: flex; gap:10px; list-style-type:none; justify-content:center'>";
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<li><a href="display.php?page=' . $i . '">' . $i . '</a></li>';
                            }
                            echo "</ul>";
                        }

            ?>


            </tr>

            </table>


        </form>
    </center>


</body>

</html>




<?php
                    } else {
                        echo "no data found";
                    }
