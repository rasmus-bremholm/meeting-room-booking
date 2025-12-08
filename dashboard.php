<?php
   require_once __DIR__ . '/includes/auth.php';
   require_once __DIR__ . '/classes/BookingManager.php';
   require_once __DIR__ . '/classes/RoomManager.php';
   $pageTitle = "Dashboard";
   $pageHeading = "Dashboard";
   require_once __DIR__ . '/includes/header.php';

   $bookingManager = new BookingManager(__DIR__ . '/data/bookings.json');
   $roomManager = new RoomManager(__DIR__ . '/data/rooms.json');
   $userBookings = $bookingManager->findBookingByUserId($_SESSION['user']['id']);
   ?>
   <link rel="stylesheet" href="/assets/styles/dashboard.css">
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
                     <div>
                        <h3><?= $room['name'] ?></h3> <p class="date"><?= $booking['date'] ?></p>
                        <p>Room #<?= $booking['roomId'] ?></p>
                     </div>
                     <hr>
                     <div class="booking-info">
                        <div>
                            <span class="material-symbols-outlined">person</span> <?= $room['seats'] ?> seats
                        </div>
                        <div>
                           <?php if ($room['hasTv']): ?>
                              <span class="material-symbols-outlined">tv</span> TV
                           <?php endif; ?>
                        </div>
                        <div>
                           <?php if ($room['hasSound']): ?>
                              <span class="material-symbols-outlined">volume_up</span> Audio
                           <?php endif; ?>
                        </div>

                     </div>
                     <p><?= $booking['startTime'] ?> - <?= $booking['endTime'] ?></p>
                  </div>
               <?php endforeach; ?>
            <?php endif; ?>
         </div>
         <div id="new-booking">
            <a class="boka-nytt-button" href="rooms.php"><span class="material-symbols-outlined">add</span>Boka Nytt</a>
         </div>
      </div>
   </main>

   <?php require_once __DIR__ . '/includes/footer.php'; ?>
