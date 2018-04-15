<?php
$query = 'SELECT * FROM categorie';
$stmt = $pdo->query($query);
$categoriesMenu = $stmt->fetchAll();
?>

<div class="row">
    <ul>
        <?php
            foreach($categoriesMenu as $categorieMenu):
        ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= RACINE_WEB; ?>categorie.php?id=<?= $categorieMenu['id']; ?>">
                <?= $categorieMenu['nom']; ?>
            </a>
        </li>
        <?php
            endforeach;
        ?>
    </ul>
</div>