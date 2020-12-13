<nav class="navbar">
        <div class="nav_icon" onclick="toggleSidebar()">
          <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="navbar__left">
          <a href="#">Eggs</a>
          <a href="#">Birds</a>
          <a class="active_link" href="feedSummary.php">Feed</a>
        </div>
        <div class="navbar__right">
          <!-- <a href="#"> -->
            <h1 style="font-size: 15px; color: green; color: #2e4a66; margin-right: 10px;"><?php echo 'Logged in as ' . $_SESSION["Username"]; ?></h1>
          <!-- </a> -->
        </div>
      </nav>