<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Rasmus Meeting Booking</title>
   <link rel="stylesheet" href="../assets/styles/globals.css">
   <link rel="stylesheet" href="../assets/styles/forms.css">
</head>
<body>
   <div class="container">
   <header>
      <h1>Boka Mötesrum</h1>

         <nav class="navbar">
            <a href="dashboard.php">Startsida</a>
            <a href="rooms.php">Mötesrum</a>
            <a href="users.php">Personer</a>
            <?php if(isset($_SESSION['user'])):  ?>
            <div class="user-info">
               Välkommen <?= htmlspecialchars($_SESSION['user']['name']) ?>
            </div>
            <a href="logout.php">Logout</a>
            <?php endif; ?>
         </nav>
   </header>
