<?php

require_once __DIR__.'/room.php';
require_once __DIR__.'/jsonFile.php';

class RoomManager {
   private JsonFile $store;

   public function __construct(string $filePath){
      $this->store = new JsonFile($filePath);
   }

   public function all(): array {return $this->store->read();}

   public function findRoomById(int $id): ?array{
      foreach($this->all() as $r){
         if($r['id'] === $id) return $r;
      };
      return null;

   }

   public function addRoom(room $room){
      $rooms = $this->all();
      $maxId = 0;

      foreach($rooms as $r){
         if($r['id'] > $maxId) $maxId = $r['id'];
      }
      $newId = $maxId + 1;

      $rooms[] = [
         'id'=>$newId,
         'name'=>$room->name,
         'seats'=>$room->seats,
         'hasTv'=>$room->hasTv,
         'hasSound'=>$room->hasSound
      ];
      $this->store->write($rooms);
   }
   public function updateRoom(int $id, $data):?array{

      // Kan inte hitta rummet direkt med findById, det skapar en kopia. filtrera istället.
      $rooms = $this->all();

      foreach($rooms as $index => $r){
         if($r['id'] === $id){
            //uppdatera nu!
         }
      }

      $this->store->write($rooms);


   }
   public function deleteRoom(int $id):?array{

   }
}
