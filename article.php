<?php
$nom = "peluche"; // création de la variable nom pour l'article
$price = 10; // création de la variable price pour le prix de l'article
$photo = "images/nounours.jpg"; // création de la variable photo pour la photo de l'article
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
                    <h1>Boutique</h1>
                </div>
            </div>
            <div class="row">
                <?php // affichage des variables nommées plus haut ?>
                <div class="col">
                    <img src="<?php echo $photo ?>" class="rounded corners" class= "img-fluid" alt="un ours en peluche">
                </div>
                <div class="col">
                    <h2><?php echo $nom ?></h2>
                </div>
                <div class="col">
                    <h2><?php echo $price." euros" ?></h2>
                </div>
            </div>
        </div>
    </body>
</html>


