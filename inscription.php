<?php
    require_once __DIR__ . '/include/init.php';

    include __DIR__ . '/layout/top.php';

    $prenom = $nom = $email = '';
    $errors = [];

    if(!empty($_POST)) {
        sanitizePost();
        extract($_POST);
        
        if(empty($_POST['prenom'])) {
            $errors[] = 'Le prénom est obligatoire';
        }

        if(empty($_POST['nom'])) {
            $errors[] = 'Le nom est obligatoire';
        }

        if(empty($_POST['email'])) {
            $errors[] = "L'email est obligatoire";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'email n'est pas valide";
        } else {
            $query = 'SELECT count(*) FROM user WHERE email = :email';
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':email', $_POST['email']);
            $stmt->execute();
            $nb = $stmt->fetchColumn();

            if($nb != 0) {
                $errors[] = 'Il existe déjè un utilisateur avec cet email';
            }
        }

        if(empty($_POST['mdp'])) {
            $errors[] = 'Le mot de passe est obligatoire';
        } elseif (!preg_match('/^[a-zA-Z0-9_-]{6,20}$/', $_POST['mdp'])) {
            $errors[] = 'Le mot de passe doit faire entre 6 et 20 caractères et ne contenir que des chiffres, des lettres, et les caractères _ et -';
        }

        if($_POST['mdp'] != $_POST['mdp-confirm']) {
            $errors[] = 'Le mot de passe et sa confirmation ne sont pas identiques';
        }

        if(empty($errors)) {
            $query = ' 
INSERT INTO user (
    prenom,
    nom,
    email,
    mdp
) VALUES (
    :prenom,
    :nom,
    :email,
    :mdp
)';
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':prenom', $_POST['prenom']);
            $stmt->bindValue(':nom', $_POST['nom']);
            $stmt->bindValue(':email', $_POST['email']);
            $stmt->bindValue(':mdp', password_hash($_POST['mdp'], PASSWORD_BCRYPT));
            $stmt->execute();

            setFlashMessage('Votre compte est crée');
            header('Location: index.php');
            die;
        }
    }
?>

    <div class="container mt-5">
        <?php    
            if (!empty($errors)) :
        ?>
	    <div class="alert alert-danger">
		    <h5 class="alert-heading">Le formulaire contient des erreurs</h5>
		    <?= implode('<br>', $errors); // implode transforme un tableau en chaîne de caractères ?>
	    </div>
        <?php
            endif;
        ?>
        <div class="row py-5">
            <div class="col-12">
                <form method="post">
                    <div class="form-group">
                        <label>prénom</label>
                        <input name="prenom" value="<?= $prenom ?>" type="text" class="form-control" placeholder="prénom">
                    </div>
                    <div class="form-group">
                        <label>Nom</label>
                        <input name="nom" value="<?= $nom ?>" type="text" class="form-control" placeholder="nom">
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input name="email" value="<?= $email ?>" type="email" class="form-control" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label>password</label>
                        <input name="mdp" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>confirmation password</label>
                        <input name="mdp-confirm" type="password" class="form-control">
                    </div>  
                    <div class="form-btn-group text-right">
		                <button type="submit" class="btn btn-info">Inscrire</button>
	                </div>     
                </form>
            </div>
        </div>
    </div>