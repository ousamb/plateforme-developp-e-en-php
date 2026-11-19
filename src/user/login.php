<?php
    require_once(__DIR__ . '/../../config/database.php');

    if($_POST){
        $sql = $pdo -> query("SELECT id, password FROM user WHERE email='".$_POST['email']."'");
        $user = $sql -> fetch(PDO::FETCH_ASSOC);

        if(password_verify($_POST['password'], $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            header("location:../item/index.php");
            exit();
        }
    }
   

    require_once(__DIR__ . '/../../includes/header.php');   
?>    



<main role="main">
    <form action="" method="post">
     <div>
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
     </div>

     <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
     </div>
    <button type="submit">Valider</button>
    </form>
</main>