<?php
    require_once(__DIR__ . '/../../config/database.php');
    require_once(__DIR__ . '/../../includes/header.php');

    $sql = $pdo -> query("SELECT id, name FROM category");
    $categories = $sql -> fetchall(PDO::FETCH_ASSOC);

    if($_POST){
        $filename = "";
         
        if(!empty($_FILES['file'])){
            $targetDirectory = "../uploads";

            $file = $_FILES['file']['name'];    
            $path = pathinfo($file);
            $filename = $path['filename'];  
            $ext = $path['extension'];
            $tmp_name = $_FILES['file'] ['tmp_name'];

            $path_filename_ext = $targetDirectory .$filename. '.' .$ext;

            if(move_uploaded_file($tmp_name, $path_filename_ext)){
                $filename = $filename. '.' .$ext;
            }
        }
            $sql = "INSERT INTO item (title, description, type, duration, category_id1, file) VALUES (?,?,?,?,?,?)";
            $stm = $pdo -> prepare ($sql) -> execute([$_POST['title'], $_POST['description'], $_POST['type'], $_POST['duration'], $_POST['category'], $filename]);
    }

?>

<main>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title">
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>

        <div class="flex2">
            <label for="">
                <input type="radio" value="0" name="type" id="type1" class="label_in"> série
            </label>
            
            <label for="">
                <input type="radio" value="1" name="type" id="type2" class="label_in">  movie
            </label>
        </div>
        
        <div>
            <label for="duration">Duration</label>
            <input type="number" id="duration" name="duration">
        </div>

        <div>
            <label for="">Category</label>  
            <select name="category" id="category">
                <?php foreach($categories as $c){ ?>
                  <option value="<?= $c['id']?>"> <?= $c['name']?></option>
                <?php } ?>
            </select>
        </div>

        <div>
            <label for="file">File</label>
            <input type="file" name="file" id="file">
        </div>
        <button type="submit">Valider</button>
    </form>
</main>

