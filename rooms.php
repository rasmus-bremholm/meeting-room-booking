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

   if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $action = $_POST['action'] ?? '';
      $roomId = (int)$_POST['roomId'];
   }
   ?>


<link rel="stylesheet" href="/assets/styles/dashboard.css">
<link rel="stylesheet" href="/assets/styles/rooms.css">
<link rel="stylesheet" href="/assets/styles/buttons.css">
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
                  <?php if ($room['hasSound']): ?>
                     <span class="material-symbols-outlined">volume_up</span> Ljudsystem
                  <?php endif; ?>
               </div>
            </div>
            <div class="buttons-container">
               <a href="room-details.php?id=<?=$room['id'] ?>&action=book" class="btn-main"><span class="material-symbols-outlined">event_available</span>Boka</a>
               <form style="display: contents">
                  <input type="hidden" name="roomId" value="<?=$room['id'] ?>">
                  <button class="btn-outlined" type="submit" name="action" value="edit"><span class="material-symbols-outlined">edit</span>Redigera</button>
                  <button class="btn-error" type="submit" name="action" value="delete"><span class="material-symbols-outlined">delete</span>Delete</button>
               </form>
            </div>
         </div>
      <?php endforeach; ?>
   </div>
</main>

 <?php require_once __DIR__ . '/includes/footer.php'; ?>
