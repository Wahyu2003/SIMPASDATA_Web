<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive navbar</title>
    <link rel="stylesheet" href="../main/menu.css" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    />
  </head>
  <body>
    <nav class="sidebar">
      <header>
        <div class="image-text">
          <span class="image">
            <img src="logo.png" alt="logo" />
          </span>
          <div class="text header-text">
            <span class="main">Sidebar</span>
            <span class="sub">Component</span>
          </div>
        </div>
        <i class="bx bx-chevron-right toggle"></i>
      </header>

      <div class="menu-bar">
        <div class="menu">
          <ul class="menu-links">
            <li class="search-bar">
              <i class="bx bx-search icons"></i>
              <input type="search" placeholder="Search..." />
            </li>
            <li class="nav-link">
              <a href="#">
                <i class="bx bx-home-alt icons"></i>
                <span class="text nav-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="#">
                <i class="bx bx-bar-chart-alt-2 icons"></i>
                <span class="text nav-text">Revenue</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="#">
                <i class="bx bx-bell icons"></i>
                <span class="text nav-text">Notifications</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="#">
                <i class="bx bx-pie-chart-alt icons"></i>
                <span class="text nav-text">Analytics</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="#">
                <i class="bx bx-heart icons"></i>
                <span class="text nav-text">Likes</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="#">
                <i class="bx bx-wallet-alt icons"></i>
                <span class="text nav-text">Wallets</span>
              </a>
            </li>
          </ul>
        </div>

        <ul class="bottom-content"> <!-- Perbaikan: Gunakan elemen ul untuk memasukkan elemen li -->
          <li class="nav-link">
            <a href="../main/signout.php">
              <i class="bx bx-log-out icons"></i>
              <span class="text nav-text"> Log Out</span>
            </a>
          </li>
          <li class="mode">
            <div class="moon-sun">
              <i class="bx bx-moon icons moon"></i>
              <i class="bx bx-sun icons sun"></i>
            </div>
            <span class="mode-text text">Dark Mode</span>
            <div class="toggle-switch">
              <span class="switch"></span>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <script src="../main/script.js"></script>
  </body>
</html>
