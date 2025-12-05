<?php
   require_once __DIR__ . '/includes/auth.php';
   $pageTitle = "Dashboard";
   $pageHeading = "Dashboard";
   require_once __DIR__ . '/includes/header.php';

   ?>

   <main class="app">
      <div class="dashboard-container">
         <div id="my-bookings"></div>
         <div id="new-booking"></div>
      </div>
   </main>

   <?php require_once __DIR__ . '/includes/footer.php'; ?>
