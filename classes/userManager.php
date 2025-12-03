<?php

require_once __DIR__.'/user.php';
require_once __DIR__.'/jsonFile.php';

class UserManager {
   private JsonFile $store;

   public function __construct(string $filePath){
      $this->store = new JsonFile($filePath);
   }

   public function all(): array {return $this->store->read();}

   public function findUserByUsername(string $username): ?array{
      foreach($this->all() as $u){
         if(strcasecmp($u['username'], $username) === 0) return $u;
      }
      return null;
   }

   public function findUserById(int $id): ?array{
      foreach($this->all() as $u){
         if($u['id'] === $id) return $u;
      };
      return null;

   }
}
