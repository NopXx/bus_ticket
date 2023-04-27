<?php
session_start();
require("db/conn.php");
if (empty($_SESSION)) {
  echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=login.php">';
}
$sub = '';
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-6">
          <div class="row">

            <!-- ขายตั๋ว Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">ขายตั๋ว</h5>
                  
                  <form class="row g-3 needs-validation" novalidate method="get">
                    <div class="col-md-8">
                      <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" name="schedule_id" aria-label="เลือกเส้นทาง" required>
                          <option value="">เลือกเส้นทาง</option>
                          <?php
                          $sql2 = 'SELECT schedule.*, `bus`.`bus_name`, `route`.`source`, `route`.`destination` FROM schedule 
                          LEFT JOIN `bus` ON `schedule`.`bus_id` = `bus`.`bus_id` 
                          LEFT JOIN `route` ON `schedule`.`route_id` = `route`.`route_id`';
                          $query2 = mysqli_query($conn, $sql2);
                          foreach ($query2 as $row) {
                          ?>
                            <option value="<?= $row['schedule_id'] ?>" <?php if ($row['schedule_id'] == @$_GET['schedule_id']) echo 'selected'; ?>><?= $row['source'] ?> - <?= $row['destination'] ?> : <?= $row['departure_date']; ?> - <?= $row['departure_time']; ?></option>
                          <?php } ?>
                        </select>
                        <label for="floatingSelect">เส้นทาง</label>
                        <div class="invalid-feedback">ป้อนข้อมูลต้นทาง</div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating">
                        <button type="submit" class="btn btn-outline-primary btn-lg">ตรวจสอบ</button>
                      </div>
                    </div>
                  </form>
                  <!-- show detail -->
                  <?php
                  if (!empty($_GET['schedule_id'])) {
                    $sql2 = 'SELECT schedule.*, `bus`.`bus_name`, `route`.`source`, `route`.`destination` FROM schedule 
                          LEFT JOIN `bus` ON `schedule`.`bus_id` = `bus`.`bus_id` 
                          LEFT JOIN `route` ON `schedule`.`route_id` = `route`.`route_id`
                          WHERE schedule.schedule_id = ' . $_GET['schedule_id'];
                    $query2 = mysqli_query($conn, $sql2);
                    $data2 = mysqli_fetch_assoc($query2);
                    
                  ?>
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
                        <div class="col-lg-9 col-md-8"><?= $data2['price']; ?></div>
                      </div>
                    </h6>
                    <hr>
                    <!--  -->
                    <?php
                    if (!empty($_POST)) {
                      $sum_price = $_POST['seat_number'] * $data2['price'];
                      $sql = 'INSERT INTO booking (user_id, schedule_id, seat_number, booking_price) VALUES (' . $_SESSION['id'] . ', ' . $_GET['schedule_id'] . ', ' . $_POST['seat_number'] . ', "' . $sum_price . '")';
                      $query3 = mysqli_query($conn, $sql);
                      $sub = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                          <i class="bi bi-check-circle me-1"></i>
                          ซื้อตั๋วสำเร็จ
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    }
                    ?>
                    <form class="needs-validation" novalidate method="post">
                    <?=$sub;?>
                      <div class="col-md-2">
                        <div class="form-floating">
                          <input type="number" class="form-control" id="floatingZip" name="seat_number" placeholder="จำนวนที่นั่ง" required>
                          <label for="floatingZip">จำนวนที่นั่ง</label>
                          <div class="invalid-feedback">ป้อนจำนวนที่นั่ง</div>
                        </div>
                      </div>
                      <div class="col-md-2 mt-2">
                        <div class="form-floating">
                          <button type="submit" class="btn btn-outline-primary">ซื้อตั๋ว</button>
                        </div>
                      </div>

                    </form>
                  <?php } ?>
                </div>

              </div>
            </div>
            <!-- End ขายตั๋ว Sales -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-6">

          <!-- ยอดขาย Card -->
          <div class="col-xxl-12 col-md-6">
            <div class="card info-card sales-card">

              <div class="card-body">
                <h5 class="card-title">ยอดขาย <span>| ทั้งหมด</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <?php
                    $sql_num = 'select * from booking';
                    $query_num = mysqli_query($conn, $sql_num);
                    $num = mysqli_num_rows($query_num);
                    ?>
                    <h6><?= $num; ?></h6>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- End ยอดขาย Card -->
          <!-- ขายตั๋วล่าสุด -->
          <div class="card">

            <div class="card-body">
              <h5 class="card-title">ขายตั๋วล่าสุด</h5>

              <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">ต้นทาง - ปลายทาง</th>
                    <th scope="col">วันที่ - เวลา</th>
                    <th scope="col">ตัวเลือก</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- php -->
                  <?php
                  $sql_select = 'SELECT `booking`.*, `schedule`.`departure_date`, `schedule`.`departure_time`, `route`.`source`, `route`.`destination`
                  FROM `booking` 
                    LEFT JOIN `schedule` ON `booking`.`schedule_id` = `schedule`.`schedule_id` 
                    LEFT JOIN `route` ON `schedule`.`route_id` = `route`.`route_id`';
                  $result = mysqli_query($conn, $sql_select);
                  $i = 1;
                  foreach ($result as $data) {
                  ?>
                    <tr>
                      <th scope="row"><?= $i; ?></th>
                      <td><?= $data['source']; ?> - <?= $data['destination']; ?></td>
                      <td><?= $data['departure_date']; ?> - <?= $data['departure_time']; ?></td>
                      <td>
                        <a href="export_pdf.php?booking_id=<?=$data['booking_id']?>" title="ปริ้น" class="btn btn-warning"><i class="bi bi-printer"></i></a>
                      </td>
                    </tr>
                  <?php
                    $i++;
                  }
                  ?>
                </tbody>
              </table>

            </div>
          </div><!-- End ขายตั๋วล่าสุด -->


        </div><!-- End Right side columns -->

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