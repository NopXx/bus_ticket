<?php
require('db/conn.php');
$sql_select = 'SELECT `booking`.*, `schedule`.`departure_date`, `schedule`.`departure_time`, `route`.`source`, `route`.`destination`, `bus`.`bus_name` 
                  FROM `booking` 
                    LEFT JOIN `schedule` ON `booking`.`schedule_id` = `schedule`.`schedule_id` 
                    LEFT JOIN `route` ON `schedule`.`route_id` = `route`.`route_id`
                    LEFT JOIN `bus` ON `schedule`.`bus_id` = `bus`.`bus_id`
                WHERE booking_id = ' . $_GET['booking_id'];
// echo $sql_select;
$result = mysqli_query($conn, $sql_select);
$data2 = mysqli_fetch_assoc($result);
echo '<script>window.print()</script>';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>หน้าแรก</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <hr>
    <h6>
        <div class="row">
            <div class="col-lg-2 col-md-2 label ">เส้นทาง</div>
            <div class="col-lg-9 col-md-8"><?= $data2['source'] ?> - <?= $data2['destination'] ?></div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-md-2 label ">ทะเบียนรถ</div>
            <div class="col-lg-9 col-md-8"><?= $data2['bus_name'] ?></div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-md-2 label ">วันที่ - เวลา</div>
            <div class="col-lg-9 col-md-8"><?= $data2['departure_date']; ?> - <?= $data2['departure_time']; ?></div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-md-2 label ">ราคา</div>
            <div class="col-lg-9 col-md-8"><?= $data2['booking_price']; ?></div>
        </div>
    </h6>
    <hr>
</body>

</html>