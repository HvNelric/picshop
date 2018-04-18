<?php
    require_once __DIR__ . '/include/init.php';
    include __DIR__ . '/layout/top.php';

    $query = 'SELECT * FROM photo WHERE pkid =' . $_GET['id'];
    $stmt = $pdo->query($query);
    $photo = $stmt->fetch();
?>
    <div class="container-fluid p-0 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <img class="myImg" src="<?= $photo['url']; ?>" alt="">
                </div>
            </div>
            <div class="row myDetail p-2">
                <div class="col-4">
                    <h5 class="text-info"><?= $photo['titre']; ?></h5>
                </div>
                <div class="col-7 text-white">
                    <p><?= $photo['description']; ?></p>
                </div>
                <div class="col-1 d-flex justify-content-center align-items-center price">
                    <h3><?= $photo['prix'] ?></h3>
                </div>
            </div>
        </div>
    </div>

