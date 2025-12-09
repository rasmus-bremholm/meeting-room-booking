<?php
   $userToEdit = $userManager->findUserById($editUserId);

   if(!$userToEdit){
      header('Location: people.php');
      exit;
   }

?>
<link rel="stylesheet" href="/assets/styles/form.css">
<link rel="stylesheet" href="/assets/styles/buttons.css">
<div class="form-container">
   <h3>Redigera Användare</h3>
   <form method="POST" class="user-form">
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="userId" value="<?= $userToEdit['id'] ?>">

      <label for="name">Namn: </label>
      <input type="text" name="name" id="name" value="<?= $userToEdit['name'] ?>">
      <label for="username">Användarnamn: </label>
      <input type="text" name="username" id="username" value="<?= $userToEdit['username'] ?>">
      <label for="password">Lösenord: </label>
      <input type="text" name="password" id="password">
      <div class="button-group">
         <button type="submit" class="btn-main">Spara</button>
         <a href="people.php" class="btn-error">Avbryt</a>
      </div>

   </form>
</div>
