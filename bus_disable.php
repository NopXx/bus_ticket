<?php
    require("db/conn.php");
    if (!empty($_GET['bus_id'])) {
        $sql_select = 'SELECT bus_status FROM bus WHERE bus_id = ' . $_GET['bus_id'];
        $query = mysqli_query($conn, $sql_select);
        $data = mysqli_fetch_assoc($query);
        $data_num = mysqli_num_rows($query);
        if ($data_num != 0) {
            if ($data['bus_status'] == 0) {
                $sql_update = 'UPDATE bus SET bus_status = 1 where bus_id = '.$_GET['bus_id'];
                $result = mysqli_query($conn, $sql_update);
                echo '<script>window.history.go(-1)</script>'; 
            } else {
                $sql_update = 'UPDATE bus SET bus_status = 0 where bus_id = '.$_GET['bus_id'];
                $result = mysqli_query($conn, $sql_update);
                echo '<script>window.history.go(-1)</script>';
            }
        } else {
            echo '<script>alert("ไม่มีข้อมูลที่ส่งมา")</script>';
            echo '<meta http-equiv="refresh" content="0; url=index.php">';
        }
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php">';
    }

?>
