<?php
    require_once __DIR__ . '/include/init.php';
    include __DIR__ . '/layout/top.php';
    adminSecurity();
    $titre = $desc = $prix = $image ='';
    $errors = [];

    $query = 'SELECT * FROM photo WHERE pkid =' . $_GET['id'];
    $stmt = $pdo->query($query);
    $photo = $stmt->fetch();
    var_dump($photo);

    $queryCat = 'SELECT * FROM categorie';
    $stmt = $pdo->query($queryCat);
    $categories = $stmt->fetchAll();

    // modification photo
    if(isset($_POST['btn-modif'])) {
        $queryModif = <<<EOS
    UPDATE photo SET
    titre = :titre,
    description = :desc,
    prix = :prix,
    fk = :cat
    WHERE pkid = :id
EOS;

        $stmt = $pdo->prepare($queryModif);
        $stmt->bindValue(':titre', $_POST['titre']);
        $stmt->bindValue(':desc', $_POST['desc']);
        $stmt->bindValue(':prix', $_POST['prix']);
        $stmt->bindValue(':cat', $_POST['cat']);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();

        setFlashMessage('Photo modifiée');
        header('Location: page-admin.php');
        die;
    }
    
?>

<div class="container">
    <div class="row pb-5">
        <div class="col-12">
            <h2 class="bg-info text-center text-white p-2 mt-5">Modification Photo</h2>
            <form class="bg-light rounded table-bordered p-5" method="post">
                <div class="form-group">
                    <label>Titre</label>
                    <input class="form-control" type="text" name="titre" value="<?= $photo['titre'] . $titre; ?>">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="desc" value="<?= $photo['description'] . $desc; ?>" row="5"></textarea>
                </div>
                <div class="form-group">
                    <label>Prix</label>
                    <input class="form-control" type="text" name="prix" value="<?= $photo['prix'] . $prix; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select class="form-control" name="cat">
                        <?php
                            foreach($categories as $categorie) :
                        ?>
                        <option value="<?= $categorie['pk_id'] ?>"><?= $categorie['nom'] ?></option>
                        <?php
                            endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group text-right">
                    <a class="btn btn-primary" href="page-admin.php">Retour page Admin</a>
                    <button class="btn btn-info" name="btn-modif">Modifier</button>
                </div>
                <div class="form-group pt-3">
                   <img class="img-thumbnail" src="<?= $photo['url']; ?>" style="width:100%" alt="">
                </div>
            </form>
        </div>
    </div>
</div>
