<?php 
    require_once(__DIR__ . '/../../config/database.php');
    

   $sql = $pdo -> prepare ("SELECT i.title FROM item as i WHERE i.title LIKE ?");
   $sql -> bindValue(1, '%' .$_POST['title']. '%');
   $sql -> execute();

   $rows = $sql -> fetchall(PDO::FETCH_ASSOC);

   $json = [];

   foreach($rows as $r){
      $json [] = $r['title'];
   }

   echo json_encode($json);

   exit();
?>


