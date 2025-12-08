<?php
   require_once __DIR__ . '/includes/auth.php';
   require_once __DIR__ . '/classes/BookingManager.php';
   require_once __DIR__ . '/classes/RoomManager.php';
   $pageTitle = "Dashboard";
   $pageHeading = "Dashboard";
   require_once __DIR__ . '/includes/header.php';
   
   <link rel="stylesheet" href="/assets/styles/dashboard.css">

   $bookingManager = new BookingManager(__DIR__ . '/data/bookings.json');
   $roomManager = new RoomManager(__DIR__ . '/data/rooms.json');
   $userBookings = $bookingManager->findBookingByUserId($_SESSION['user']['id']);
   ?>

   <main class="app">
      <div class="dashboard-container">
         <div id="my-bookings">
            <h2>Mina Bokningar</h2>
            <?php if (empty($userBookings)): ?>
               <p>Du har inga bokningar!</p>
            <?php else: ?>
               <?php foreach($userBookings as $booking): ?>
                  <?php $room = $roomManager->findRoomById($booking['roomId']); ?>
                  <div class="booking-item">
                     <p><?= $room['name'] ?></p>
                     <p><?= $booking['date'] ?></p>
                     <p><?= $booking['startTime'] ?> - <?= $booking['endTime'] ?></p>
                  </div>
               <?php endforeach; ?>
            <?php endif; ?>
         </div>
         <div id="new-booking">
            <a class="boka-nytt-button" href="rooms.php">Boka Nytt</a>
         </div>
      </div>
   </main>

   <?php require_once __DIR__ . '/includes/footer.php'; ?>
