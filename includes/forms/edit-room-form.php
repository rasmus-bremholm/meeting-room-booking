<?php
$roomToEdit = $roomManager->findRoomById($editRoomId);

if(!$roomToEdit){
   header('Location: rooms.php');
   exit;
}

?>
<div class="form-container">
   <h3>Redigera Rum</h3>
   <form method="POST">
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="roomId" value="<?= $roomToEdit['id'] ?>">

      <label for="name">Rumsnamn:</label>
      <input type="text" name="name" id="name" value="<?= $roomToEdit['name'] ?>" required>

      <label for="steats">Antal Platser:</label>
      <input type="number" name="seats" id="seats" value="<?= $roomToEdit['seats'] ?>" required>

      <label>
         <input type="checkbox" name="hasTv" value="1">TV
      </label>

      <label>
         <input type="checkbox" name="hasSound" value="1">Ljudsystem
      </label>

      <div class="button-group">
         <button type="submit" class="btn-main">Spara</button>
         <a href="rooms.php" class="btn-error">Avbryt</a>
      </div>
   </form>
</div>
