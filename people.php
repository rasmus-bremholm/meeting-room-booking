<?php

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/classes/userManager.php';
$pageTitle = "Personer";
require_once __DIR__ . '/includes/header.php';

$userManager = new UserManager(__DIR__ . '/data/users.json');

$showAddForm = isset($_GET['action']) && $_GET['action'] === 'add';
$showEditForm = isset($_GET['action']) && $_GET['action'] === 'edit';
$editUserId = isset($_GET['id']) ? $_GET['id'] : null;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
   $action = $_POST['action'] ?? '';

   if($action === 'delete') {
      $userId = (int)$_POST['userId'];
      $userManager->deleteUser($userId);
      header('Location: people.php');
      exit;
   }
   if($action === 'edit') {
      $userId = (int)$_POST['userId'];
      header('Location: people.php?action=edit&id='.$userId);
      exit;
   }
   if($action === 'update'){
      $userId = (int)$_POST['userId'];
      $data = [
         'name' => $_POST['name'],
         'username' => $_POST['username'],
         'password' => $_POST['password'] ?? ''
      ];
      $userManager->updateUser($userId, $data);
      header('Location: people.php');
      exit;
   }
}

$users = $userManager->all();
?>
<link rel="stylesheet" href="/assets/styles/people.css">
<main class="app">
   <h2>Personer</h2>
      <?php if($showAddForm): ?>
         <?php require __DIR__ . '/includes/forms/add-user-form.php'; ?>
      <?php elseif ($showEditForm): ?>
         <?php require __DIR__ . '/includes/forms/edit-user-form.php'; ?>
      <?php endif; ?>
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
      <a class="person" id="add-new" href="people.php?action=add"><span class="material-symbols-outlined">add</span>Lägg till ny användare</a>
   </div>
</main>
