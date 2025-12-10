<div class="form-container">
   <h3>Nytt Rum</h3>
   <form method="POST">
      <input type="hidden" name="action" value="add">

      <label for="name">Rumsnamn:</label>
      <input type="text" name="name" id="name" required>

      <label for="steats">Antal Platser:</label>
      <input type="number" name="seats" id="seats" required>

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
