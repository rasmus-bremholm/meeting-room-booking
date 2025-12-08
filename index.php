<?php
$pageTitle = "Startsida";
$pageHeading = "Startsida";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/classes/userManager.php';
$userManager = new UserManager(__DIR__.'/data/users.json');


$error = '';

if($_SERVER['REQUEST_METHOD'] === "POST"){
   $username = trim($_POST['username'] ?? "");
   $password = $_POST['password'] ?? "";
   $user = $userManager->findUserByUsername($username);

   if($user && password_verify($password, $user['passwordHash'])) {
      // Sätter kaka (userid)
      setcookie('userid', (string)$user['id'],[
         'expires'  => time() + 3600*8,
         'path'     => '/',
         'secure'   => !empty($_SERVER['HTTPS']),
         'httponly' => true,
         'samesite' => 'Lax'
      ]);
      header('Location: dashboard.php'); exit;
   } else {
      $error = 'Felaktigt användarnamn eller lösen';
   }
}
?>

   <main class="app">
      <div class="login-container">
         <h2 style="text-align:center;">LOGGA IN</h2>
            <?php if (isset($_GET['logout'])): ?>
               <div class="logout-message">Du är utloggad, logga in igen</div>
            <?php endif; ?>
            <?php if (isset($_GET['unauthorized'])): ?>
               <div class="error-message">Du har inte behörighet till sidan</div>
            <?php endif; ?>
         <form method="post" id="login-form">
            <label for="username">Användarnamn: </label>
            <input type="text" id="username" name="username">
            <label for="password">Lösenord: </label>
            <input type="password" id="password" name="password">
            <button type="submit">Logga In</button>
         </form>
         <?php if($error): ?><div class="error-container"><p class="error-message"><?= htmlspecialchars($error) ?></p></div><?php endif; ?>

      </div>
   </main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
