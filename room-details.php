<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/classes/BookingManager.php';
require_once __DIR__ . '/classes/RoomManager.php';
$pageTitle = "Room Details";
require_once __DIR__ . '/includes/header.php';


$roomManager = new RoomManager(__DIR__ . '/data/rooms.json');
$bookingManager = new BookingManager(__DIR__ . '/data/bookings.json');
$userManager = new UserManager(__DIR__ . '/data/users.json');

// Hämtar ID från URL
$roomId = (int)($_GET['id'] ?? 0);
$room = $roomManager->findRoomById($roomId);
$timeSlots = [
   "08:00-10:00",
   "10:00-12:00",
   "13:00-15:00",
   "15:00-17:00"
];

if(!$room){
   header('Location: rooms.php');
   exit;
}

$roomBookings = $bookingManager->findByRoomId($roomId);

$showBookingForm = isset($_GET['action']) && $_GET['action'] === "book";


if($_SERVER['REQUEST_METHOD'] === 'POST') {
   $action = $_POST['action'] ?? '';

   if($action === 'bookRoom'){
      // Do something :S:S:
   }

   if($action === 'cancelBooking'){
      // do Other thing ?
   }
}
?>
<link rel="stylesheet" href="/assets/styles/room-details.css">
<main class="app">
   <h2><?= $room['name']?></h2>
   <section class="room-info-section">
      <h3>Infomation:</h3>
      <p><span class="material-symbols-outlined">person</span>Platser: <?=$room['seats'] ?></p>
      <?php if($room['hasTv']): ?>
         <p><span class="material-symbols-outlined">tv</span>TV: Ja</p>
      <?php endif; ?>
      <?php if($room['hasSound']): ?>
         <p>Ljudsystem: Ja</p>
      <?php endif; ?>
   </section>
   <section>
      <?php if($showBookingForm):?>
         <div class="form-controller">
            <h3>Boka <?= $room['name'] ?></h3>
            <form method="POST">
               <input type="hidden" name="action" value="bookRoom">
               <input type="hidden" name="roomId" value="<?= $room['id'] ?>">

               <label for="date">Datum:</label>
               <input type="date" id="date" name="date" required>

               <label for="timeSlot">Tid:</label>
               <select name="timeSlot" id="timeSlot">
                  <?php foreach ($timeSlots as $slot):?>
                     <option value="<?= $slot ?>"><?= $slot ?></option>
                  <?php endforeach; ?>
               </select>
            </form>
         </div>
      <?php endif; ?>
   </section>
</main>

 <?php require_once __DIR__ . '/includes/footer.php'; ?>
