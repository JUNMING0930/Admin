<style>
/* Sidebar background and general style */
.sidenav {
  background: linear-gradient(180deg, #005f73, #0a3d3e) !important; /* Dark blue to teal gradient */
  box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.4);
}

/* Sidebar heading and logo */
.sidenav-header .navbar-brand {
  font-size: 1.25rem;
  color: #ffffff;
  font-weight: bold;
  letter-spacing: 1px;
}

.sidenav-header .navbar-brand .ms-1 {
  text-transform: uppercase;
  font-size: 1rem;
}

/* Hover effect for sidebar links */
.nav-link {
  color: #ffffff !important;
  font-size: 1.05rem;
  padding: 15px 20px;
  border-radius: 10px;
  transition: background-color 0.3s ease;
}

.nav-link:hover {
  background-color: #028090 !important; /* Lighter teal for hover effect */
  color: #ffffff !important;
}

/* Sidebar icon size and spacing */
.nav-item i.material-icons {
  font-size: 1.3rem;
  transition: color 0.3s ease;
}

.nav-item:hover i.material-icons {
  color: #ffdf00; /* Yellow color for icons on hover */
}

/* Active link style */
.nav-item.active .nav-link {
  background-color: #ffdf00 !important; /* Yellow background for active item */
  color: #005f73 !important; /* Dark blue text for active item */
}

/* Sidebar separator style */
hr.horizontal.light {
  background-color: #028090;
  height: 1px;
}

/* Adjusting collapse behavior */
.collapse.navbar-collapse.w-auto {
  height: auto;
  overflow: visible;
  max-height: none;
}

/* Media queries for responsiveness */
@media (max-width: 768px) {
  .sidenav {
    width: 250px;
    position: relative;
  }

  .sidenav-header .navbar-brand {
    font-size: 1.1rem;
  }

  .navbar-nav .nav-item {
    margin-bottom: 15px;
  }

  .nav-link {
    font-size: 1rem;
    padding: 10px 15px;
  }
}

.nav-link:hover {
  background-color: #495057 !important;
  color: #ffffff !important;
}

/* Sidebar icon size and spacing */
.nav-item i.material-icons {
  font-size: 1.3rem;
  transition: color 0.3s ease;
}

.nav-item:hover i.material-icons {
  color: #1d9bf0;
}

/* Active link style */
.nav-item.active .nav-link {
  background-color: #1d9bf0 !important;
  color: white !important;
}

/* Sidebar separator style */
hr.horizontal.light {
  background-color: #495057;
  height: 1px;
}

/* Adjusting collapse behavior */
.collapse.navbar-collapse.w-auto {
  height: auto;
  overflow: visible;
  max-height: none;
}

/* Media queries for responsiveness */
@media (max-width: 768px) {
  .sidenav {
    width: 250px;
    position: relative;
  }

  .sidenav-header .navbar-brand {
    font-size: 1.1rem;
  }

  .navbar-nav .nav-item {
    margin-bottom: 15px;
  }

  .nav-link {
    font-size: 1rem;
    padding: 10px 15px;
  }
}
</style>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0">
      <span class="ms-1 font-weight-bold text-white">BIRKENSTOCK ADMIN</span>
    </a>
  </div>

  <hr class="horizontal light mt-0 mb-2">

  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" href="index.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Homepage</span>
        </a>
      </li>
      <?php if($_SESSION['Role'] == 1) : ?>
      <li class="nav-item">
        <a class="nav-link text-white" href="admin.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">supervisor_account</i>
          </div>
          <span class="nav-link-text ms-1">Admin</span>
        </a>
      </li>
      <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link text-white" href="customer.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">groups</i>
          </div>
          <span class="nav-link-text ms-1">Customer</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="categories.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">category</i>
          </div>
          <span class="nav-link-text ms-1">Category</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="products.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">local_mall</i>
          </div>
          <span class="nav-link-text ms-1">Products</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="stocks.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">storefront</i>
          </div>
          <span class="nav-link-text ms-1">Stocks</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="orders.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">receipt_long</i>
          </div>
          <span class="nav-link-text ms-1">Orders</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" onclick="return confirm('Are you sure want to log out?');" href="logout.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">logout</i>
          </div>
          <span class="nav-link-text ms-1">Log Out</span>
        </a>
      </li>
    </ul>
  </div>
</aside>
