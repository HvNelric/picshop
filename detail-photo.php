<?php
    require_once __DIR__ . '/include/init.php';
    include __DIR__ . '/layout/top.php';

    $query = 'SELECT * FROM photo WHERE pkid =' . $_GET['id'];
    $stmt = $pdo->query($query);
    $photo = $stmt->fetch();
?>
    <div class="container-fluid p-0 bg-dark">
        <div class="row">
            <div class="col-12">
                <img class="myImg" src="<?= $photo['url']; ?>" alt="">
                <div class="row myDeatail">
                    <div class="col-4">
                        <h5 class="text-info"></h5>
                    </div>
                    <div class="col-5"></div>
                    <div class="col-3"></div>
                </div>
            </div>
        </div>
    </div>

