<div class="form-container">
   <h3>Ny Användare</h3>
   <form method="POST">
      <input type="hidden" name="action" value="add">

      <label for="name">Namn: </label>
      <input type="text" name="name" id="name" required>
      <label for="username">Användarnamn: </label>
      <input type="text" name="username" id="username" required>
      <label for="password">Lösenord: </label>
      <input type="password" name="password" id="password" required>

      <button type="submit" class="btn-main">Spara</button>
      <a href="people.php" class="btn-error">Avbryt</a>
   </form>
</div>
