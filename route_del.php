<?php

require("db/conn.php");
if (!empty($_GET['route_id'])) {
    $sql_select = 'SELECT * FROM route WHERE route_id = ' . $_GET['route_id'];
    $query = mysqli_query($conn, $sql_select);
    $data = mysqli_fetch_assoc($query);
    $data_num = mysqli_num_rows($query);
    if ($data_num != 0) {
        $sql_del = 'DELETE FROM route where route_id = '.$_GET['route_id'];
        $query = mysqli_query($conn, $sql_del);
        echo '<meta http-equiv="refresh" content="0; url=route_add.php">';
    } else {
        echo '<script>alert("ไม่มีข้อมูลที่ส่งมา")</script>';
        echo '<meta http-equiv="refresh" content="0; url=index.php">';
    }
}

?>