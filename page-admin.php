 <?php

    require_once __DIR__ . '/include/init.php';
    include __DIR__ . '/layout/top.php';
    adminSecurity();

    $titre = $desc = $prix = $photo = '';
    $errors = [];

    $query = 'SELECT * FROM photo';
    $stmt = $pdo->query($query);
    $photos = $stmt->fetchAll();

    if(!empty($_POST)) {
        sanitizePost();
        extract($_POST);
        
        

    }

?>

 <div class="container">
     <div class="row">
         <div class="col-12 mt-5">
             <form method="post">
                <div class="form-group">
                    <label>titre</label>
                    <input name="titre" value="<?= $titre ?>" type="text" class="form-control" placeholder="prénom">
                </div>
                <div class="form-group">
                    <label>description</label>
                    <textarea rows="5"  name="desc" value="<?= $desc ?>" type="text" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Prix</label>
                    <input name="prix" value="<?= $prix ?>" type="text" class="form-control" placeholder="prix">
                </div>
                <div class="form-group">
		            <label>Photo</label>
		            <input class="btn btn-primary" type="file" name="url">
                </div>
                <div class="form-group">
                    <label>Catégorie</label>
                    <select name="cat" class="form-control">
                        <?php
                            $query = 'SELECT * FROM categorie';
                            $stmt = $pdo->query($query);
                            $categories = $stmt->fetchAll();

                            foreach($categories as $categorie) :
                        ?>
                        <option value="<?= $categorie['pk_id']; ?>"><?= $categorie['nom']; ?></option>
                        <?php
                            endforeach;
                        ?>
                    </select>
                </div>
             </form>
         </div>
         <div class="col-12 mt-5">
             <h2 class="text-center">liste photos</h2>
             <table class="table table-borderless table-active">
                <thead class="bg-info text-white">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Titre</th>
                        <th scope="col">prix</th>
                        <th scope="col">url</th>
                        <th scope="col">fkey</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($photos as $photo) :
                    ?>
                    <tr>
                        <td><?= $photo['pkid']; ?></td>
                        <td><?= $photo['titre']; ?></td>
                        <td><?= $photo['prix']; ?></td>
                        <td><?= $photo['url']; ?></td>
                        <td><?= $photo['fk']; ?></td>
                        
                    </tr>
                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>
         </div>
     </div>
 </div>