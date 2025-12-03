<?php
$pageTitle = "Startsida";
$pageHeading = "Startsida";
require_once __DIR__ . '/includes/header.php';
?>

   <main class="app">
      <div class="login-container">
         <form method="post" id="login-form">
            <label for="username">Användarnamn: </label>
            <input type="text" id="username" name="username">
            <label for="password">Lösenord: </label>
            <input type="password" id="password" name="password">
            <button type="submit">Logga In</button>
         </form>
      </div>
   </main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
