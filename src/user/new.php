<?php
    require_once(__DIR__ . '/../../config/database.php');
    require_once(__DIR__ . '/../../includes/header.php');

    if($_POST){

        if(strlen($_POST['email'] > 7 && strlen($_POST['password']) > 7)){
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                
        $sql = "INSERT INTO user (email,  password) VALUES(?,?)";
        $password = password_hash($_POST['password'], PASSWORD_ARGON2I);
        $stm = $pdo -> prepare($sql) -> execute([$_POST['email'],   $password]);

        if($stm > 0){
            echo "Merci de vous connecter";
        }else{
            echo "Error";
        }

            }
        }

    }

?>    


<main role="main">
    <form action="" method="post">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>


        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" minlenght="8">
        </div>
        <button type="submit">Valider</button>
    </form>
</main>