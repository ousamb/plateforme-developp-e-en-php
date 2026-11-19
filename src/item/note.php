<?php 
    require_once(__DIR__ . '/../../config/database.php');
   
 
    if($_POST){
        $sql = "INSERT INTO note (user_id1, item_id1, note, comment) VALUES(?,?,?,?)";
        $pdo  -> prepare($sql) ->execute([$_SESSION['user_id'], $_GET['id'], strip_tags($_POST['note']), strip_tags($_POST['comment'])]);
        header("location: ../item/index.php");
    }
    

    require_once(__DIR__ . '/../../includes/header.php');
?>

<main>
    <form action="" method="post">
     <div>
        <label for="note">Note</label>
        <input type="number" name="note" id="note" max="5" min="0">

        <label for="comment">Comment</label>
        <input type="text" name="comment" id="comment">
        <div>
            <button>Valider</button>
        </div>
     </div>
    </form>
</main>