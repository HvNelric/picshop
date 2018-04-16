<!doctype html>
<html lang="fr">

  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/picshop.css">

    <title>PicShop</title>

  </head>
  <body>
  <?php
    require_once __DIR__ . '/../include/init.php';

    $query = 'SELECT * FROM categorie';
    $stmt = $pdo->query($query);
    $categories = $stmt->fetchAll();

    if(isset($_POST['deco'])) {
      unset($_SESSION['user']);

      header('Location: index.php');
      die;
    }
  ?>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light"> <!-- NAV -->
        <div class="container">
          <a class="navbar-brand mb-0 h1 text-info" href="index.php">Pic<span class="navbar-brand mb-0 h1">Shop</span></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <?php
                foreach($categories as $categorie) :
              ?>
              <li class="nav-item">
                <a class="nav-link" href="categorie.php?id=<?= $categorie['id']; ?>"><?= $categorie['nom']; ?></a>
              </li>
              <?php
                endforeach;
              ?>
            </ul>
            <div class="form-inline my-2 my-lg-0">
              <?php
                if(isUserConnected()) :
              ?>
              <a class="btn btn-info btn-sm my-2 my-sm-0" href="<?= goAdminPage(); ?>"><?= getUserFullName(); ?></a>
              <form method="post">
                <div class="form-group">
                  <button class="btn btn-sm btn-outline-info ml-1" name="deco" href="#">Déconnexion</button>
                </div>
              </form>
              <?php
                else :
              ?>
              <a class="nav-link text-info" href="connexion.php">connexion</a>
              <a class="btn btn-info btn-sm my-2 my-sm-0" href="inscription.php">Inscription</a>
              <?php
                endif;
              ?>
            </div>
          </div>
        </div>
      </nav> <!-- /NAV -->
    </header>

<div class="container-fluid" style="padding:0; overflow:hidden">
