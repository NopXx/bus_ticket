<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>แก้ไขข้อมูลรถบัส</title>
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

    <!-- ========== Main ========= -->
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
                    <li class="breadcrumb-item">แก้ไขข้อมูล</li>
                    <li class="breadcrumb-item active">รถบัส</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <!-- เพิ่มข้อมูลรถบัส -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">เพิ่มข้อมูลรถบัส</h5>
                            <!-- php -->
                            <?php
                            $sub = '';
                            require("db/conn.php");
                            if (empty($_SESSION) || empty($_GET)) {
                                echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=index.php">';
                            } else {
                                $sql = 'SELECT * from bus where bus_id = ' . $_GET["bus_id"];
                                $result = mysqli_query($conn, $sql);
                                $data = mysqli_fetch_assoc($result);
                            }

                            // submit edit
                            if (!empty($_POST)) {
                                if ($data['bus_name'] == $_POST['bus_name']) {
                                    $sql_update = 'UPDATE bus SET bus_name = "' . $_POST['bus_name'] . '", bus_type = "' . $_POST['bus_type'] . '", total_seats =' . $_POST['total_seats'] . ', updated_at = now() where bus_id = ' . $_GET['bus_id'];
                                    // echo $sql_update;
                                    $query = mysqli_query($conn, $sql_update);
                                    $sub = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    แก้ไขข้อมูลสำเร็จ
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                } else {
                                    $sql = 'SELECT count(*) AS num from bus where bus_name = "' . $_POST['bus_name'] . '"';
                                    $result = mysqli_query($conn, $sql);
                                    $data = mysqli_fetch_assoc($result);
                                    if ($data['num'] == 0) {
                                        $sql_update = 'UPDATE bus SET bus_name = "' . $_POST['bus_name'] . '", bus_type = "' . $_POST['bus_type'] . '",total_seats = ' . $_POST['total_seats'] . ', updated_at = now() where bus_id = ' . $_GET['bus_id'];
                                        // echo $sql_update;
                                        $query = mysqli_query($conn, $sql_update);
                                        $sub = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    แก้ไขข้อมูลสำเร็จ
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                    } else {
                                        $sub = '<div class="col-12">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="bi bi-exclamation-octagon me-1"></i>
                                                ไม่สามารถเพิ่มข้อมูลได้ กรุณาเปลี่ยนเลขทะเบียนรถ!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>';
                                    }
                                }
                            }
                            // end submit edit
                            ?>
                            <!-- Form -->
                            <form class="needs-validation" novalidate method="post">
                                <?= $sub ?>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">เลขทะเบียนรถ</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="bus_name" class="form-control" id="yourName" value="<?= $data['bus_name']; ?>" required>
                                        <div class="invalid-feedback">กรุณาป้อนเลขทะเบียนรถ</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">ประเภทรถ</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="bus_type" required>
                                            <option value="">เลือกประเภทรถ</option>
                                            <option value="รถปรับอากาศชั้น 1" <?php if ($data['bus_type'] == 'รถปรับอากาศชั้น 1') {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>รถปรับอากาศชั้น 1</option>
                                            <option value="รถปรับอากาศชั้น 2" <?php if ($data['bus_type'] != 'รถปรับอากาศชั้น 1') {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>รถปรับอากาศชั้น 2</option>
                                        </select>
                                        <div class="invalid-feedback">เลือกประเภทรถ</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">จำนวนที่นั่ง</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="total_seats" value="<?= $data['total_seats']; ?>" required>
                                        <div class="invalid-feedback">ป้อนจำนวนที่นั่ง</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">แก้ไข</button>
                                    </div>
                                </div>

                            </form>
                            <!-- End General Form Elements -->

                        </div>
                    </div>

                </div>
                <!-- End -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ข้อมูลรถบัส</h5>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">เลขทะเบียนรถ</th>
                                        <th scope="col">ประเภทรถ</th>
                                        <th scope="col">จำนวนที่นั่ง</th>
                                        <th scope="col">ตัวเลือก</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- php -->
                                    <?php
                                    $sql_select = 'SELECT * FROM bus';
                                    $result = mysqli_query($conn, $sql_select);
                                    $i = 1;
                                    foreach ($result as $data) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $data['bus_name']; ?></td>
                                            <td><?= $data['bus_type']; ?></td>
                                            <td><?= $data['total_seats']; ?></td>
                                            <td>
                                                <a href="bus_edit.php?bus_id=<?= $data['bus_id']; ?>" title="แก้ไข" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                <?php 
                                                    if ($data['bus_status'] == 0) {
                                                ?>
                                                <a href="bus_disable.php?bus_id=<?= $data['bus_id']; ?>" title="ปิดใช้งาน" class="btn btn-danger"><i class="bi bi-dash-circle"></i></a>
                                                <?php } else { ?>
                                                    <a href="bus_disable.php?bus_id=<?= $data['bus_id']; ?>" title="เปิดใช้งาน" class="btn btn-success"><i class="bi bi-check-circle"></i></a>
                                                <?php } ?>
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
    <!-- ========== End Main ========= -->

    <!-- ======= Footer ======= -->
    <?php
    require("Components/footer.php")
    ?>
    <!-- ======= End Footer ======= -->

</body>

</html>