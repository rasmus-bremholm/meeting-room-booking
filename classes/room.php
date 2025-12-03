<?php

class Room {
   public function __construct(
      public int $id,
      public string $name,
      public int $seats,
      public bool $hasTv,
      public bool $hasSound,
   ){}
}
