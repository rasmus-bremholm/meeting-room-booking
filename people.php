<?php

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/classes/userManager.php';
$pageTitle = "Personer";
require_once __DIR__ . '/includes/header.php';

$userManager = new UserManager(__DIR__ . '/data/users.json');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
   $action = $_POST['action'] ?? '';

   if($action === 'delete') {
      $userId = (int)$_POST['userId'];
      $userManager->deleteUser($userId);
      header('Location: people.php');
      exit;
   }
}

$users = $userManager->all();
?>
<link rel="stylesheet" href="/assets/styles/people.css">
<main class="app">
   <h2>Personer</h2>
   <div class="grid-container">
      <?php foreach($users as $user): ?>
         <div class="person">
            <h3><?= $user['name'] ?></h3>
            <p>Username: <?= $user['username'] ?></p>
            <form method="POST" class="buttons-container">
               <input type="hidden" name="userId" value="<?= $user['id'] ?>">
               <button type="submit" name="action" value="edit" class="btn-outlined"><span class="material-symbols-outlined">edit</span>Redigera</button>
               <button type="submit" name="action" value="delete" class="btn-error"><span class="material-symbols-outlined">delete</span>Ta Bort</button>
            </form>
         </div>
      <?php endforeach; ?>
      <div class="person" id="add-new"><span class="material-symbols-outlined">add</span>Lägg till ny användare</div>
   </div>
</main>
