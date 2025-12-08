<?php

class Booking {
   public function __construct(
      public int $id,
      public int $roomId,
      public int $userId,
      public string $date,
      public string $startTime,
      public string $endTime
   ){}
}
