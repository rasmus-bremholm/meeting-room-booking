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
      $date = $_POST['date'];
      $timeSlot = $_POST['timeSlot'];

      // Hitta detta på nätet...
      list($startTime, $endTime) = explode('-', $timeSlot);

      $booking = new Booking(
         id: 0,
         roomId: $roomId,
         userId: $_SESSION['user']['id'],
         date: $date,
         startTime: $startTime,
         endTime: $endTime
      );

      $bookingManager->addBooking($booking);
      header('Location: dashboard.php');
      exit;
   }

   if($action === 'cancelBooking'){
     $bookingId = (int)$_POST['bookingId'];
     $bookingManager->deleteBooking($bookingId);
     header('Location: room-detail.php?id=' . $roomId);
     exit;
   }
}
?>
<link rel="stylesheet" href="/assets/styles/room-details.css">
<main class="app" id="room-details-wrapper">
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
   <section class="bookings-list">
      <h3>Befintliga Bokningar</h3>
      <?php if(empty($roomBookings)): ?>
         <p>Inga Bokningar!</p>
      <?php else: ?>
         <?php foreach ($roomBookings as $booking): ?>
            <?php $bookedUser = $userManager->findUserById($booking['userId']); ?>
            <div class="booking-container">
               <p>Datum: <?= $booking['date'] ?></p>
               <p>Tid: <?= $booking['startTime'] ?> - <?= $booking['endTime'] ?></p>
               <p>Bokad av: <?= $bookedUser['name'] ?? "Anonym" ?></p>
                <form method="POST" style="display: inline">
                        <input type="hidden" name="action" value="cancelBooking">
                        <input type="hidden" name="bookingId" value="<?= $booking['id'] ?>">
                        <button type="submit" class="btn-error">
                           <span class="material-symbols-outlined">delete</span> Avboka
                        </button>
                     </form>
            </div>
            <hr>
         <?php endforeach; ?>
         <?php endif; ?>
   </section>
   <hr>
   <section>
      <?php if($showBookingForm):?>
         <div class="form-controller">
            <h3>Boka <?= $room['name'] ?></h3>
            <form method="POST" class="form-controller">
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
               <button type="submit" class="btn-main">Boka Rum</button>
               <a href="room-detail.php?id=<?= $room['id']?>" class="btn-error">Avbryt</a>
            </form>
         </div>
      <?php endif; ?>
   </section>
</main>

 <?php require_once __DIR__ . '/includes/footer.php'; ?>
