<?php require_once 'Config/SetSession.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once 'Templates/Header.php'; ?>
	<title><?= ucwords($data['table']) ?></title>
</head>
<body>
   <?php require_once 'Templates/Navbar.php'; ?>
   
   <!-- Content -->

   <section class="container my-3">
   	<!-- Get header -->
      <?php require_once 'Views/GetHeader.php' ?>

      <!-- Get tabla -->
      <?php require_once 'Views/GetTable.php' ?>
      
   </section>

   <!-- /Content -->
   <?php require_once 'Templates/Footer.php'; ?>
</body>
</html>