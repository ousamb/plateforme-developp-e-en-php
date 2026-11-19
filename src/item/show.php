<?php 
    require_once(__DIR__ . '/../../config/database.php');
    require_once(__DIR__ . '/../../includes/header.php');

    $rows = [];

    $stm = $pdo -> prepare("SELECT i.*, AVG(n.note) as moy FROM note as n INNER JOIN item as i ON n.item_id1 = i.id WHERE i.id = ? GROUP BY n.item_id1");
    $stm -> bindValue(1, $_GET['id']);
    $stm -> execute();
    $r = $stm -> fetch(PDO:: FETCH_ASSOC);


    $stm = $pdo -> prepare("SELECT n.*, u.email FROM note as n INNER JOIN user as u ON n.user_id1 = u.id WHERE n.item_id1 = ?");
    $stm -> bindValue(1, $_GET['id']);
    $stm -> execute();
    $comments = $stm -> fetchAll(PDO::FETCH_ASSOC);
    

?>


<main>
    <div>
    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">Description</th>
                <th scope="col">Moyenne des notes</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>

        <tbody>  
             <tr>
                <th scope="row"><?= $r['id']?></th>
                <td><?= $r['title']?></td>
                <td><?= ($r['type']==0) ? 'serie' : 'movie' ?></td>
                <td><?= $r['description']?></td>
                <td><?= $r['moy'] ?></td>
                <td><a  class="sign-in" href="/php/src/item/note.php?id=<?= $r['id']?>">Noter</a></td>
             </tr> 
        </tbody>
    </table>
    </div>

    <table>
        <h1>Comments</h1>
        <thead>
            <tr>
                <th>User</th>
                <th>Comment</th>
                <th>Note</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($comments as $c){ ?>
                <tr>
                    <td><?= $c['email']?></td>
                    <td><?= $c['comment']?></td>
                    <td><?= $c['note']?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>