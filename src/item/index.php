<?php
    require_once(__DIR__ . '/../../config/database.php');
    require_once(__DIR__ . '/../../includes/header.php');

    $rows = [];
    if($_GET){
        $stm = $pdo -> prepare("SELECT i.*, AVG(n.note) as moy FROM note as n INNER JOIN item as i ON n.item_id1=i.id WHERE i.title LIKE ? AND i.type = ? AND i.category_id1 = ? GROUP BY n.item_id1");
        $stm -> bindValue(1, '%'.$_GET['title'].'%');
        $stm -> bindValue(2, $_GET['type']);
        $stm -> bindValue(3, $_GET['category']);
        $stm -> execute();

        $rows = $stm -> fetchall(PDO::FETCH_ASSOC);
        
        
    }else{
        $stm = $pdo -> query("SELECT i.*, AVG(n.note) as moy FROM note as n INNER JOIN item as i ON n.item_id1=i.id  GROUP BY n.item_id1");
        $rows = $stm -> fetchall(PDO::FETCH_ASSOC);
        
    }

   $sql = $pdo -> query("SELECT id, name FROM category");
   $categories = $sql ->fetchall(PDO::FETCH_ASSOC);


?>

<main>
    <form action="" method="get" autocomplete="off">
        <div>
            <input type="text" name="title" id="autocomplete" placeholder="search">
        </div>

         <div>
            <select name="category" id="category">
                <?php foreach($categories as $c){ ?>
                  <option value="<?= $c['id']?>"> <?= $c['name']?></option>
                <?php } ?>
            </select>
        </div>

        <div class="flex2">
            <label for="">
                <input type="radio" value="0" name="type" id="type1" class="label_in" required> série
            </label>
            
            <label for="">
                <input type="radio" value="1" name="type" id="type2" class="label_in" >  movie
            </label>
        </div>
        <button type="submit">Valider</button>
    </form>

    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">Description</th>
                <th scope="col">Note</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>

        <tbody> 
            <?php  foreach($rows as $r){ ?>
             <tr>
                <th scope="row"><?= $r['id']?></th>
                <td><?= $r['title']?></td>
                <td><?= ($r['type']==0) ? 'serie' : 'movie' ?></td>
                <td><?= $r['description']?></td>
                <td><?= $r['moy'] ?></td>
                <td><a class="sign-in" href="/php/src/item/note.php?id=<?= $r['id']?>">Noter</a></td> 
                <td><a class="login" href="/php/src/item/show.php?id=<?= $r['id']?>">Voir</a></td>
             </tr>
            <?php  } ?>
        </tbody>
    </table>
    <p><a class="btn-new" href="/php/src/item/new.php">New</a></p>
</main>

