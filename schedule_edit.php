<?php
session_start();
require("db/conn.php");
if (empty($_SESSION)) {
    echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=index.php">';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>แก้ไขรอบรถ</title>
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

    <!-- ======= Header ======= -->
    <?php
    require("Components/header.php");
    ?>
    <!-- ======= End Header ======= -->

    <!-- ======= Sidebar ======= -->
    <?php
    require("Components/sidebar.php");
    ?>
    <!-- ======= End Sidebar ======= -->

    <!-- ======= Main ======= -->
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
                    <li class="breadcrumb-item">จัดการ</li>
                    <li class="breadcrumb-item active">รอบรถ</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">แก้ไขข้อมูลรอบรถ</h5>
                            <!-- Form -->
                            <?php
                            $sub = '';
                            if (empty($_SESSION) || empty($_GET)) {
                                echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=index.php">';
                            } else {
                                $sql = 'SELECT * from schedule where schedule_id = ' . $_GET["schedule_id"];
                                // echo $sql;
                                $result = mysqli_query($conn, $sql);
                                $data = mysqli_fetch_assoc($result);
                                $data_num = mysqli_num_rows($result);
                                if ($data_num == 0) {
                                    echo '<script>alert("ไม่มีข้อมูลที่ส่งมา")</script>';
                                    echo '<meta http-equiv="refresh" content="0; url=schedule.php">';
                                }
                            }
                            if (!empty($_POST)) {
                                $sql_insert = 'UPDATE schedule SET bus_id = ' . $_POST['bus_id'] . ' , route_id = ' . $_POST['route_id'] . ', departure_date = "' . $_POST['departure_date'] . '", departure_time = "' . $_POST['departure_time'] . '" where schedule_id = ' . $_GET['schedule_id'];
                                // echo $sql_insert;
                                $query = mysqli_query($conn, $sql_insert);
                                $sub = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            แก้ไขข้อมูลสำเร็จ
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                                $sql = 'SELECT * from schedule where schedule_id = ' . $_GET["schedule_id"];
                                // echo $sql;
                                $result = mysqli_query($conn, $sql);
                                $data = mysqli_fetch_assoc($result);
                            }
                            ?>
                            <form class="needs-validation" novalidate method="post">
                                <?= $sub; ?>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">รถบัส</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="bus_id" required>
                                            <option value="">เลือกรถบัส</option>
                                            <?php
                                            $sql1 = 'SELECT * FROM bus where bus_status = 0';
                                            $query1 = mysqli_query($conn, $sql1);
                                            foreach ($query1 as $row) {
                                            ?>
                                                <option value="<?= $row['bus_id'] ?>" <?php if ($data['bus_id'] == $row['bus_id']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $row['bus_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">เลือกรถบัส</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">เส้นทาง</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="route_id" required>
                                            <option value="">เลือกเส้นทาง</option>
                                            <?php
                                            $sql2 = 'SELECT * FROM route';
                                            $query2 = mysqli_query($conn, $sql2);
                                            foreach ($query2 as $row) {
                                            ?>
                                                <option value="<?= $row['route_id'] ?>" <?php if ($data['route_id'] == $row['route_id']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $row['source'] ?> - <?= $row['destination'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">เลือกเส้นทาง</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">วันที่</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="departure_date" class="form-control" id="yourName" value="<?= $data['departure_date']; ?>" required>
                                        <div class="invalid-feedback">ป้อนข้อมูลวันที่</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">เวลา</label>
                                    <div class="col-sm-10">
                                        <input type="time" name="departure_time" class="form-control" id="yourName" value="<?= $data['departure_time']; ?>" required>
                                        <div class="invalid-feedback">ป้อนข้อมูลเวลา</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">แก้ไข</button>
                                    </div>
                                </div>

                            </form>
                            <!-- Form -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ข้อมูลรอบรถ</h5>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">รถบัส</th>
                                        <th scope="col">ต้นทาง - ปลายทาง</th>
                                        <th scope="col">วันที่ - เวลา</th>
                                        <th scope="col">ตัวเลือก</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- php -->
                                    <?php
                                    $sql_select = 'SELECT schedule.*, `bus`.`bus_name`, `route`.`source`, `route`.`destination` FROM schedule 
                                        LEFT JOIN `bus` ON `schedule`.`bus_id` = `bus`.`bus_id` 
                                        LEFT JOIN `route` ON `schedule`.`route_id` = `route`.`route_id`';
                                    $result = mysqli_query($conn, $sql_select);
                                    $i = 1;
                                    foreach ($result as $data) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $data['bus_name']; ?></td>
                                            <td><?= $data['source']; ?> - <?= $data['destination']; ?></td>
                                            <td><?= $data['departure_date']; ?> - <?= $data['departure_time']; ?></td>
                                            <td>
                                                <a href="schedule_edit.php?schedule_id=<?= $data['schedule_id']; ?>" title="แก้ไข" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                <a href="schedule_del.php?schedule_id=<?= $data['schedule_id']; ?>" onclick="return confirm('ต้องการลบข้อมูลนี้ ?')" title="ลบ" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- ======= End Main ======= -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- ======= Footer ======= -->
    <?php
    require("Components/footer.php")
    ?>
    <!-- ======= End Footer ======= -->

</body>

</html>