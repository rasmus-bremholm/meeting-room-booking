<?php

require_once __DIR__.'/booking.php';
require_once __DIR__.'/jsonFile.php';

class BookingManager {
   private JsonFile $store;

   public function __construct( string $filePath){
      $this->store = new JsonFile($filePath);
   }

   public function all(): array {return $this->store->read();}

   public function findBookingById(int $id): ?array{
      foreach($this->all() as $b){
         if($b['id'] === $id) return $b;
      }
      return null;
   }

   public function findBookingByUserId(int $userId): array{

      $bookings  = $this->all();
      $userBookings = [];

      foreach($bookings as $b){
         if($b['userId'] === $userId){
            $userBookings[] = $b;
         }
         return $userBookings;
      }
   }


   public function addBooking(booking $booking){
      $bookings = $this->all();
      $maxId = 0;

      foreach($bookings as $b){
         if($b['id'] > $maxId) $maxId = $b['id'];
      }
      $newId = $maxId + 1;

      $bookings[] = [
         'id' =>$newId,
         'roomId'=>$booking->roomId,
         'userId'=>$booking->userId,
         'date'=>$booking->date,
         'startTime'=>$booking->startTime,
         'endTime'=>$booking->endTime,
      ];
      $this->store->write($bookings);
   }


   public function deleteBooking(int $id){
      $bookings = $this->all();

      foreach($bookings as $index => $b){
         if($b['id'] === $id){
            unset($bookings[$index]);
            break;
         }
      }
      $bookings = array_values($bookings);
      $this->store->write($bookings);
   }

}
