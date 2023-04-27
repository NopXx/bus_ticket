  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>หน้าแรก</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>จัดการ</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="schedule.php">
              <i class="bi bi-circle"></i><span>รอบรถ</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-plus"></i><span>เพิ่มข้อมูล</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="bus_add.php">
              <i class="bi bi-car-front-fill"></i><span>รถบัส</span>
            </a>
          </li>
          <li>
            <a href="route_add.php">
              <i class="bi bi-sign-turn-right"></i><span>เส้นทาง</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Forms Nav -->
    </ul>

  </aside>
  <!-- End Sidebar-->