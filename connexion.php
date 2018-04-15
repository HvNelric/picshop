<?php
    require_once __DIR__ . '/include/init.php';

    include __DIR__ . '/layout/top.php';

    $email = '';
    $errors = [];

    if(!empty($_POST)) {
        sanitizePost();
        extract($_POST);
        
        if(empty($_POST['email'])) {
            $errors[] = "L'email est obligatoire";
        } 

        if(empty($_POST['mdp'])) {
            $errors[] = 'Le mot de passe est obligatoire';
        }

        if(empty($errors)) {
            $query = 'SELECT * FROM user WHERE email = :email';
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':email', $_POST['email']);
            $stmt->execute();

            $user = $stmt->fetch();
            echo '<pre>';
            var_dump($user['email']);
            var_dump($_POST['email']);
            echo '</pre>';

            if(!empty($user)) {
                if(password_verify($_POST['mdp'], $user['mdp'])) {
                    $_SESSION['user'] = $user;

                    if($_SESSION['user']['role'] == 'vip') {
                        header('Location: page-vip.php');
                        die;
                    }

                    if($_SESSION['user']['role'] == 'admin') {
                        header('Location: page-admin.php');
                        die;
                    }

                    if ($_SESSION['user']['role'] == 'normal') {
                        header('Location: index.php');
                        die;
                    }
                } 
                $errors[] = 'MDP incorrecte';
            }
            $errors[] = 'Email incorrecte';   
        }
    }
?>
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
    <div class="container">
        <div class="row">
            <div class="col-12 m-5 p-5">
                <form class="mt-5" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                            </div>
                            <input name="email" value="<?= $email; ?>" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input name="mdp" type="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-info">Valider</button>
                </form>
            </div>
        </div>
    </div>