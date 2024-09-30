<?php
if(session_status() !== PHP_SESSION_ACTIVE)
{
session_start();
}

if($_SESSION["userloggedin"]==1)
{
  if($_SESSION["staffstatus"]!=0)
  {
    echo "You Dont Have Access to this page";
    die();
  }
}
else
{
  header("Location: http://localhost/TimeTableGenerator/login.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function changesheet(sheet) {
            document.getElementById('pagestyle').setAttribute('href', sheet);
        }
    </script>
    <!-- <script src="./js/login.js"></script> -->
    <script src="https://kit.fontawesome.com/f5126202d4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="./css/dashboard.css">
</head>
<body style="font-size: 100%;">
<button
    id="sidebartoggle"
    class="navbar-toggler"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#sidebarMenu"
    aria-controls="sidebarMenu"
    aria-expanded="false"
    aria-label="Toggle navigation"
    >
    <i class="fas fa-bars"></i>
</button>
<div class="container-fluid d-flex flex-row">
<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a
          href="./dashboard.php"
          class="list-group-item list-group-item-action py-2 ripple active"
          aria-current="true" 
        >
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>My dashboard</span>
        </a>
        <a href="./applications.php" class="list-group-item list-group-item-action py-2 ripple">
          <i class="fa-brands fa-wpforms"></i> <span>Applications</span>
        </a>
        <a href="./queries.php" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fa-solid fa-clipboard-question"></i> <span>Queries</span></a
        >
        <a href="./certificates.php" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fa-solid fa-certificate"></i> <span>My Certificates</span></a
        >
      </div>
    </div>
  </nav>
  <div id="applications-content" class="container d-flex flex-row">
  </div>
</div>
</body>
</html>