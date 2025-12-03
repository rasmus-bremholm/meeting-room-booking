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
   public function updateRoom(int $id, array $data){

      // Kan inte hitta rummet direkt med findById, det skapar en kopia. filtrera istället.
      $rooms = $this->all();

      foreach($rooms as $index => $r){
         if($r['id'] === $id){
            $rooms[$index]['name'] = $data['name'] ?? $r['name'];
            $rooms[$index]['seats'] = $data['seats'] ?? $r['seats'];
            $rooms[$index]['hasTv'] = $data['hasTv'] ?? $r['hasTv'];
            $rooms[$index]['hasSound'] = $data['hasSound'] ?? $r['hasSound'];
            break;
         }
      }

      $this->store->write($rooms);


   }
   public function deleteRoom(int $id){

      $rooms = $this->all();
      // samma sak som update, unset() tar bort??
      foreach($rooms as $index => $r){
         if($r['id'] === $id){
            unset($r);
            break;
         }
      }

      $this->store->write($rooms);

   }
}
