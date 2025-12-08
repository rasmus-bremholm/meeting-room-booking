<?php
   require_once __DIR__ . '/includes/auth.php';
   require_once __DIR__ . '/classes/BookingManager.php';
   require_once __DIR__ . '/classes/RoomManager.php';
   $pageTitle = "Rooms";
   $pageHeading = "Rooms";
   require_once __DIR__ . '/includes/header.php';

   $bookingManager = new BookingManager(__DIR__ . '/data/bookings.json');
   $roomManager = new RoomManager(__DIR__ . '/data/rooms.json');

   $rooms = $roomManager->all();
   ?>

<link rel="stylesheet" href="/assets/styles/dashboard.css">
<link rel="stylesheet" href="/assets/styles/rooms.css">
<main class="app">
   <h2>Boka Mötesrum</h2>
   <div class="grid-container">
      <?php foreach($rooms as $room): ?>
         <div class="booking-item">
            <div class="room-header">
               <h3><?= $room['name'] ?></h3>
            </div>
            <hr>
            <div class="room-info">
              <div>
                  <span class="material-symbols-outlined">person</span> <?= $room['seats'] ?> seats
               </div>
                <div>
                  <?php if ($room['hasTv']): ?>
                     <span class="material-symbols-outlined">tv</span> TV
                  <?php endif; ?>
               </div>
            </div>
         </div>
      <?php endforeach; ?>
   </div>
</main>

 <?php require_once __DIR__ . '/includes/footer.php'; ?>
