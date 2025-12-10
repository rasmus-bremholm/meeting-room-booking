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
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
   <link rel="stylesheet" href="../assets/styles/globals.css">
   <link rel="stylesheet" href="../assets/styles/forms.css">
   <link rel="stylesheet" href="../assets/styles/buttons.css">
</head>
<body>
   <div class="container">
   <header>
      <h1>Boka Mötesrum</h1>

         <nav class="navbar">
            <a href="dashboard.php">Startsida</a>
            <a href="rooms.php">Mötesrum</a>
            <a href="people.php">Personer</a>
            <?php if(isset($_SESSION['user'])):  ?>
            <div class="user-info">
               <?= htmlspecialchars($_SESSION['user']['name']) ?> <span class="material-symbols-outlined">person</span>
               <a href="settings.php"><span class="material-symbols-outlined settings">settings</span></a>
            </div>
            <a href="logout.php"><span class="material-symbols-outlined">logout</span></a>
            <?php endif; ?>
         </nav>
         <hr>
   </header>
