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

    public function addUser(User $user, string $plainPassword){
      $users = $this->all();
      $maxId = 0;

      foreach($users as $u){
         if($u['id'] > $maxId) $maxId = $u['id'];
      }
      $newId = $maxId + 1;

      $users[] = [
         'id' =>$newId,
         'name'=>$user->name,
         'username'=>$user->username,
         'passwordHash'=>password_hash($plainPassword, PASSWORD_DEFAULT)
      ];
      $this->store->write($users);
   }

      public function updateUser(int $id, array $data){

      $users = $this->all();

      foreach($users as $index => $u){
         if($u['id'] === $id){
            $users[$index]['name'] = $data['name'] ?? $u['name'];
            $users[$index]['username'] = $data['username'] ?? $u['username'];

            //passwörds
            if(!empty($data['password'])){
               $users[$index]['passwordHash'] = password_hash($data['password']. PASSWORD_DEFAULT);
            }
            break;
         }
      }

      $this->store->write($users);
   }

    public function deleteUser(int $id){
      $users = $this->all();

      foreach($users as $index => $u){
         if($u['id'] === $id){
            unset($users[$index]);
            break;
         }
      }
      $users = array_values($users);
      $this->store->write($users);
   }
}
