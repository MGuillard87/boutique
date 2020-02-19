<?php
// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['photo_article']) AND $_FILES['photo_article']['error'] == 0)
{
    // Testons si le fichier n'est pas trop gros
    if ($_FILES['photo_article']['size'] <= 1000000)
    {
       /* // Testons si l'extension est autorisée
        $infosfichier = pathinfo($_FILES['monfichier']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
        if (in_array($extension_upload, $extensions_autorisees))
        { */
            // On peut valider le fichier et le stocker définitivement
            move_uploaded_file($_FILES['photo_article']['tmp_name'], 'images/' . basename($_FILES['photo_article']['name']));
            echo "L'envoi a bien été effectué !";
       /* } */
    }
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
    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <h1>Votre article</h1>
                <p>Affichage de l'article confirmé</p>
            </div>
        </div>
        <div class="row">
            <?php // affichage des variables nommées plus haut ?>
            <div class="col">
                <p><img src="<?php echo 'images/' . basename($_FILES['photo_article']['name']); ?>" alt="Une casquette" /></p>
            </div>
            <div class="col">
                <p><?php echo $_POST['nom_article']; ?></p>
            </div>
            <div class="col">
                <p><?php echo $_POST['prix_article']; ?></p>
            </div>
        </div>
        <div class="row">
            <p>Pour ajouter un nouvel article <a href="addArticle.php">cliquez ici</a></p>
        </div>
    </div>
</body>
</html>