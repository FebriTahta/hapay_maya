<?php 
  // Ambil halaman aktif dari parameter URL
  $page = isset($_GET['page']) ? $_GET['page'] : '';

  // Tentukan menu layanan terbuka jika salah satu submenu aktif
  $menuLayananOpen = in_array($page, ['data', 'data-xx', 'data-yy']) ? 'menu-open' : '';
  $menuLayananActive = in_array($page, ['data', 'data-xx', 'data-yy']) ? 'active' : '';
?>

<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="index.php?page=dashboard" class="nav-link <?= ($page == 'dashboard') ? 'active' : ''; ?>">
        <i class="nav-icon fas fa-th"></i>
        <p>Dashboard <span class="right badge badge-danger">New</span></p>
      </a>
    </li>
    
    <li class="nav-item <?= $menuLayananOpen; ?>">
      <a href="#" class="nav-link <?= $menuLayananActive; ?>">
        <i class="nav-icon fas fa-user"></i>
        <p>
          Layanan
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="index.php?page=client" class="nav-link <?= ($page == 'client') ? 'active' : ''; ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Client</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=data-xx" class="nav-link <?= ($page == 'data-xx') ? 'active' : ''; ?>">
            <i class="far fa-circle nav-icon"></i>
            <p>Data Tagihan</p>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a href="logout.php" class="nav-link text-red">
        <i class="nav-icon fas fa-power-off"></i>
        <p>Logout</p>
      </a>
    </li>
  </ul>
</nav>