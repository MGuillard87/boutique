<?php
// fonction 'include' pour faire appel au fonction d'affiche d'article
include ("catalogue_fonction.php");

// Variable 'erreurs' pour contrôler les conditions lorsqu'il y a des erreurs
$erreurs = true;

// variable "nom" pour mettre en place la première condition vérifiant si $_POST existe
$nom="";

// variable erreur pour chaque champ du formulaire qui affiche les erreurs
$errnom="";
$errimg="";
$errprix="";


try {

    if (isset($_POST['nom_article'])) {
        $nom = $_POST['nom_article'];
// vérification du champ prix à effectuer avec  la fonction int_nemric(), puis voir si la valeur donner est supérieure à 0
        if(!filter_var($_POST['prix_article'], FILTER_VALIDATE_INT) !== false){
            $errprix = "Vous n'avez pas entré de prix ";
        }

        else{
            //Test 1:  Tester si le fichier a bien été envoyé et s'il n'y a pas d'erreur
            if (isset($_FILES['photo_article']) AND $_FILES['photo_article']['error'] == 0) {
                // Testons si le fichier n'est pas trop gros
                if ($_FILES['photo_article']['size'] <= 1000000) {
                    // Test 2: Tester si l'extension est autorisée: interdire à tout prix que les gens puissent envoyer des fichiers PHP, sinon ils pourraient exécuter des scripts sur notre serveur
                    $infosfichier = pathinfo($_FILES['photo_article']['name']);
                    $extension_upload = $infosfichier['extension'];
                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                    if (in_array($extension_upload, $extensions_autorisees)) {
                        // Si extension autorisée: on peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['photo_article']['tmp_name'], 'images/' . basename($_FILES['photo_article']['name']));
                        echo "Votre article a bien été ajouté !";
                    } else {
                        // Si l'extension n'est pas autorisée: on ne valide pas le fichier et on envoie le client vers une page d'erreur
                        $errimg =  "L'extension du fichier n'est pas pris en compte par notre site";
                        $erreurs = false;
                    }
                }
            }
        }
    }
} catch(Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Boutique</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php if ($erreurs==false || !isset($_POST['nom_article'])) { ?>
    <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <h1>Création d'un article</h1>
        </div>
        <form action="addArticleFinale.php" method="post" enctype="multipart/form-data">
            <p><label>l'image de l'article : <input type="file" name="photo_article" required /></label><?=$errimg ?></p>
            <p><label>Le nom de l'article : <input type="text" name="nom_article" required placeholder="Nom de l'article" value="<?=$nom ?>"/></label></p>
            <p><label>Le prix de l'article : <input type="number" name="prix_article" min=1 required placeholder="Prix en Euros"/></label><?=$errprix ?></p>
            <p><input type="submit" value="Envoyer l'article"></p>
        </form>
      </div>
    </div>
    <?php }
    else {

        afficheArt($_POST['nom_article'], $_POST['prix_article'], basename($_FILES['photo_article']['name']));?>
        <div class="row">
        <p>Pour ajouter un nouvel article <a href="addArticleFinale.php">cliquez ici</a></p>
    </div>


  <?php  } ?>

