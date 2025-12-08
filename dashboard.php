<?php
   require_once __DIR__ . '/includes/auth.php';
   require_once __DIR__ . '/classes/BookingManager.php';
   $pageTitle = "Dashboard";
   $pageHeading = "Dashboard";
   require_once __DIR__ . '/includes/header.php';

   $bookingManager = new BookingManager(__DIR__ . '/data/bookings.json');
   $userBookings = $bookingManager->findBookingByUserId($_SESSION['user']['id']);
   ?>

   <main class="app">
      <div class="dashboard-container">
         <div id="my-bookings">
            <h2>Mina Bokningar</h2>
            <?php if (empty($userBookings)): ?>
               <p>Du har inga bokningar!</p>
            <?php else: ?>
               <?php ?>
            <?php endif; ?>
         </div>
         <div id="new-booking">
            <a class="boka-nytt-button" href="rooms.php">Boka Nytt</a>
         </div>
      </div>
   </main>

   <?php require_once __DIR__ . '/includes/footer.php'; ?>
