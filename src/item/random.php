<?php 
    require_once(__DIR__ . '/../../config/database.php');
    require_once(__DIR__ . '/../../includes/header.php');

    $row = [];
    $sql = $pdo -> query("SELECT i.*, AVG(n.note) as moy FROM note as n INNER JOIN item as i ON n.item_id1 = i.id GROUP BY n.item_id1 ORDER BY RAND() LIMIT 1");
    $r = $sql -> fetch(PDO::FETCH_ASSOC);
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
                <th scope="col">Note</th>
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
                <td><a href="/php/src/item/note.php?id=<?= $r['id'] ?>" class="sign-in">Noter</a></td>
             </tr>
        </tbody>
     </table>
    </div>
</main>


