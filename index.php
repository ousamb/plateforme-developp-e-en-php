<?php 
    require_once(__DIR__ . '/config/database.php');
    require_once(__DIR__ . '/includes/header.php');
?>

<main role="main">
    <?php if(isset($_SESSION['user_id'])){ ?>
        <p><a class="delete" href="/php/src/user/logout.php">Logout</a></p>

        <p>
          <a class="sign-in" href="/php/src/item/random.php">Random</a>
        </p>

    <?php } else{ ?>
        <p><a class="login" href="/php/src/user/new.php">Creer un compte</a></p>

        <p><a class="sign-in" href="/php/src/user/login.php">Login</a></p>
    <?php } ?>
</main>




