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

if(!$room){
   header('Location: rooms.php');
   exit;
}

$roomBookings = $bookingManager->findByRoomId($roomId);

$showBookingForm = isset($_GET['action']) && $_GET['action'] === "book";
?>
