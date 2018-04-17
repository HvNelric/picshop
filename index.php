<?php
    require_once __DIR__ . '/include/init.php';

    include __DIR__ . '/layout/top.php';

    $query = 'SELECT * FROM photo';
    $stmt = $pdo->query($query);
    $photos = $stmt->fetchAll();

?>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> <!-- SLIDER -->
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" style="height:700px">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/Bolga_0004-min.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/Bolga_0020-min.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/DSC_0038-min.jpg" alt="Third slide">
            </div>
        </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
    </div> <!-- /SLIDER -->

    <h1 class="text-center text-dark">Get inspired with our best photos</h1>

    <div class="row p-0"> <!-- TOP -->
        <div class="col-6 pr-1">
            <div class="haut-gauche">
                <div class="row no-gutters d-flex align-items-center">
                    <div class="col-6 p-5">
                        <h3 class="text-white">best seller #1</h3>
                        <div class="text-white haut-titre">
                            <strong>Yellow flowers</strong>
                        </div>
                        <a class="nav-link text-white" href="">+ more info</a>
                    </div>
                    <div class="col-6 p-5">
                        <div class="haut-img-cont">
                            <img class="w-100" src="img/DSC_0434-min.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        <div class="col-6 pl-1">
            <div class="haut-droit">
               <div class="row no-gutters d-flex align-items-center">
                    <div class="col-6 p-5">
                        <h3 class="text-white">best seller #2</h3>
                        <div class="text-white haut-titre">
                            <strong>Ridi market</strong>
                        </div>
                        <a class="nav-link text-white" href="">+ more info</a>
                    </div>
                    <div class="col-6 p-5">
                        <div class="haut-img-cont">
                            <img class="w-100" src="img/bolga_0017.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /TOP -->
    <div class="container">
            <h2 class="text-center text-dark">Premium stock photography from PicShop</h2>
            <div class="row no-gutters pb-5"> <!-- CARD -->
                <?php
                    foreach($photos as $photo) :
                ?>
                <div class="col-6 col-md-4 p-2">
                    <div class="card">
                        <?php
                                 $src = (isset($photo['url']))
                                        ? $photo['url']
                                        : PHOTO_DEFAULT
                                        ;
                            ?>
                        <a href=""><img class="card-img-top" src="<?= $src; ?>" alt="Card image cap"></a>
                        <div class="card-body position-relative">
                            <div class="mycard-price">
                                <h3><?= $photo['prix']; ?>€</h3>
                            </div>
                            <h5 class="card-title"><?= $photo['titre']; ?></h5>
                            <p class="card-text mycard-desc"><?= $photo['description']; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a class="nav-link text-info pl-0" href="">+ more info</a>
                                <a href="#" class="btn btn-info">ajouter au panier</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    endforeach;
                ?>
            </div><!-- /CARD -->
    </div>





























</div>
<?php
    include __DIR__ . '/layout/bottom.php';
?>