<?php
session_start();
require("db/conn.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>แก้ไขข้อมูลเส้นทาง</title>
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
          <li class="breadcrumb-item active">เส้นทาง</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <!-- เพิ่มข้อมูลเส้นทาง -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">เพิ่มข้อมูลเส้นทาง</h5>
              <!-- Form -->
              <?php
              $sub = '';
              if (empty($_SESSION) || empty($_GET)) {
                echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=index.php">';
            } else {
                $sql = 'SELECT * from route where route_id = ' . $_GET["route_id"];
                // echo $sql;
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result);
            }
              if (!empty($_POST)) {
                $sql_insert = 'UPDATE route SET source = "'.$_POST['source'].'", destination = "'.$_POST['destination'].'" where route_id = '.$_GET['route_id'];
                // echo $sql_insert;
                $query = mysqli_query($conn, $sql_insert);
                $sub = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            แก้ไขข้อมูลสำเร็จ
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                $sql = 'SELECT * from route where route_id = ' . $_GET["route_id"];
                // echo $sql;
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result);
        }
              ?>
              <form class="needs-validation" novalidate method="post">
                <?=$sub;?>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">ต้นทาง</label>
                  <div class="col-sm-10">
                    <input type="text" name="source" class="form-control" id="yourName" value="<?=$data['source'];?>" required>
                    <div class="invalid-feedback">ป้อนข้อมูลต้นทาง</div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">ปลายทาง</label>
                  <div class="col-sm-10">
                    <input type="text" name="destination" class="form-control" id="yourName" value="<?=$data['destination'];?>" required>
                    <div class="invalid-feedback">ป้อนข้อมูลปลายทาง</div>
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
        <!-- End เพิ่มข้อมูลเส้นทาง -->

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">ข้อมูลเส้นทาง</h5>
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">ต้นทาง</th>
                    <th scope="col">ปลายทาง</th>
                    <th scope="col">ตัวเลือก</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- php -->
                  <?php
                  $sql_select = 'SELECT * FROM route';
                  $result = mysqli_query($conn, $sql_select);
                  $i = 1;
                  foreach ($result as $data) {
                  ?>
                    <tr>
                      <th scope="row"><?= $i; ?></th>
                      <td><?= $data['source']; ?></td>
                      <td><?= $data['destination']; ?></td>
                      <td>
                        <a href="route_edit.php?route_id=<?= $data['route_id']; ?>" title="แก้ไข" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <a href="route_del.php?route_id=<?= $data['route_id']; ?>" onclick="return confirm('ต้องการลบข้อมูลนี้ ?')" title="ลบ" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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