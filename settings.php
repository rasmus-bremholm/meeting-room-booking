<?php
require_once __DIR__ . '/includes/auth.php';
$pageTitle = "User Settings";

require_once __DIR__ . '/includes/header.php';

$userManager = new UserManager(__DIR__ . '/data/users.json');
$user = $_SESSION['user'];
?>

<link rel="stylesheet" href="/assets/styles/settings.css">
<main class="app">
   <h2>Welcome  <?= htmlspecialchars($user['name']) ?>!</h2>
   <section class="user-form">
      <h3>You're Information</h3>
      <div class="info-grid">
         <div class="grid-item"><p><span class="material-symbols-outlined">fingerprint</span>User Id: <?=$user['id'] ?></p></div>
         <div class="grid-item"><p><span class="material-symbols-outlined">person</span>User Id: <?=$user['name'] ?></p></div>
         <div class="grid-item"><p><span class="material-symbols-outlined">id_card</span>UserName: <?=$user['username'] ?></p></div>
         <div class="grid-item"><p><span class="material-symbols-outlined">lock</span>Password: <span id="password">***********</span></p>
            <button class="btn-icon" onclick="togglePassword()"><span class="material-symbols-outlined" id="toggle-icon">visibility</span></button>
         </div>
      </div>
   </section>
</main>

<script>
   // Wooop Javascript in PHP!
   const passwordHash = '<?=$user['passwordHash'] ?>'
   let isVisable = false;

   function togglePassword() {
      const display = document.querySelector('#password');
      const icon = document.querySelector('#toggle-icon');

      if(isVisable) {
         display.textContent = "***********";
         icon.textContent = 'visibility';
      }else {
         display.textContent =passwordHash;
         icon.textContent = 'visibility_off';
      }

      isVisable = !isVisable;
   }
</script>
