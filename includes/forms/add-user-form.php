<div class="form-container">
   <h3>Ny Användare</h3>
   <form method="POST">
      <input type="hidden" name="action" value="add">

      <label for="name">Namn: </label>
      <input type="text" name="name" id="name">
      <label for="username">Användarnamn: </label>
      <input type="text" name="username" id="username">
      <label for="password">Lösenord: </label>
      <input type="text" name="password" id="password">

      <button type="submit" class="btn-main">Spara</button>
      <a href="people.php" class="btn-error">Avbryt</a>
   </form>
</div>
