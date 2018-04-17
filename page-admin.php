 <?php

    require_once __DIR__ . '/include/init.php';
    include __DIR__ . '/layout/top.php';

    // include __DIR__ . 'upload.php';
    adminSecurity();

    $titre = $desc = $prix = $urlActuel = '';
    $errors = [];
    
    // selection photos
    $query = 'SELECT * FROM photo';
    $stmt = $pdo->query($query);
    $photos = $stmt->fetchAll();

    if(isset($_POST['btn-ajout'])) {

        if(!empty($_POST)) {
            sanitizePost();
            extract($_POST);
            
            if(empty($_POST['titre'])) {
                $errors[] = 'Un titre est obligatoire';
            }

            if(empty($_POST['desc'])) {
                $errors[] = 'Une description est obligatoire';
            }
            
            if(empty($_POST['prix'])) {
                $errors[] = 'Un prix est obligatoire';
            }

            if(empty($_POST['cat'])) {
                $errors[] = 'Vous devez choisir une catégorie';
            }

            if(!empty($_FILES['image']['tmp_name'])) {

                if($_FILES['image']['size'] > 1000000) {
                    $errors[] = 'La photo ne doit pas faire plus de 1Mo';
                }

                $allowedMimeTypes = [
                    'image/png',
                    'image/jpeg',
                    'image/gif'
                ];

                if(!in_array($_FILES['image']['type'], $allowedMimeTypes)) {
                    $errors[] = 'La photo doit etre au format PNG, JPEG, GIF';
                }
            
        

                if(empty($errors)) {
                    if(!empty($_FILES['image']['tmp_name'])) {
                        $target_dir = "imgup/";
                        $target_file = $target_dir . basename($_FILES["image"]["name"]);
                       
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    }
                
                
                    $queryAjout = <<<EOS
INSERT INTO photo (
    titre,
    description,
    prix,
    url,
    fk
) VALUES (
    :titre,
    :desc,
    :prix,
    :url,
    :cat
)
EOS;
                $stmt = $pdo->prepare($queryAjout);
                $stmt->bindValue(':titre', $_POST['titre']);
                $stmt->bindValue(':desc', $_POST['desc']);
                $stmt->bindValue(':prix', $_POST['prix']);
                $stmt->bindValue(':url', $target_file);
                $stmt->bindValue(':cat', $_POST['cat']);
                $stmt->execute();

                setFlashMessage('photo ajoutée');
            }
        }
    }
}

    //delete photo
    if(isset($_POST['btn-del'])) {
        $queryDelPhoto = 'SELECT url FROM photo WHERE pkid =' . $_POST['del-id'];
        $stmt = $pdo->query($queryDelPhoto);
        $urlDel = $stmt->fetchColumn();

        if(!empty($urlDel)) {
            unlink($urlDel);
        }
        
        $queryDel = 'DELETE FROM photo WHERE pkid =' . $_POST['del-id'];
        $pdo->exec($queryDel);

        setFlashMessage('Photo supprimée');
    }
?>


<div class="container">
    <?php
        if (!empty($errors)) :
    ?>
	<div class="alert alert-danger">
		<h5 class="alert-heading">Le formulaire contient des erreurs</h5>
		<?= implode('<br>', $errors); ?>
	</div>
    <?php
        endif;
    ?>
    <div class="row pb-5">
        <div class="col-12 mt-5"> <!-- AJOUT PHOTO -->
            <h2 class="bg-info mt-5 p-2 text-center text-white">Ajout photos</h2>
            <form  method="post" class="bg-light p-5 rounded table-bordered" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Titre :</label>
                    <input name="titre" value="<?= $titre; ?>" type="text" class="form-control" placeholder="prénom">
                </div>
                <div class="form-group">
                    <label>Description :</label>
                    <textarea rows="5"  name="desc" value="<?= $desc; ?>" type="text" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Prix :</label>
                    <input name="prix" value="<?= $prix; ?>" type="text" class="form-control" placeholder="prix">
                </div>
                <div class="form-group">
		            <div class="row d-flex align-items-center">
		                <div class="col-12 col-md-6">
		                    <label>Télécharger votre photo :</label>
        		            <input class="text-left" type="file" name="image" value="<?= $urlActuel; ?>">
                            <?php
                               $src = (!empty($_FILES['image']['tmp_name']))
                                    ? $target_file  
                                    : PHOTO_DEFAULT
                                    ;
                            ?>
		                </div>
                        <div class="col-12 col-md-6">
                            <img class="img-fluid img-thumbnail text-right" src="<?= $src; ?>" alt="">
                        </div>
		            </div>
                </div>
                <div class="form-group">
                    <label>Catégorie :</label>
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
                <div class="form-btn-group text-right">
		            <button name="btn-ajout" type="submit" class="btn btn-info">Ajouter</button>
		        </div>
            </form>
        </div><!-- /AJOUT PHOTO -->
        <div class="col-12 mt-5"> <!-- LISTE PHOTO -->
            <h2 class="bg-info mt-5 p-2 text-center text-white">liste photos</h2>
            <table class="table table-borderless table-active rounded">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Url</th>
                        <th scope="col">Fkey</th>
                        <th scope="col">Modifier / Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // selection photos
                        $query = 'SELECT * FROM photo';
                        $stmt = $pdo->query($query);
                        $photos = $stmt->fetchAll();

                        foreach ($photos as $photo) :
                    ?>
                    <tr>
                        <td><strong><?= $photo['pkid']; ?></strong></td>
                        <td><?= $photo['titre']; ?></td>
                        <td><?= $photo['prix']; ?></td>
                        <td><?= $photo['url']; ?></td>
                        <td><?= $photo['fk']; ?></td>
                        <td class="text-right">
                            <a class="btn btn-info mr-1" href="modif-photos.php?id=<?= $photo['pkid']; ?>">Modifier</a>
                            <form class="d-inline" method="post">
                                <input type="hidden" name="del-id" value="<?= $photo['pkid']; ?>">
                                <button name="btn-del" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>     
                    </tr>
                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>
        </div><!-- /LISTE PHOTO -->
    </div>
</div>