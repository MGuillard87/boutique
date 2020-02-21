<?php
// On démarre la session AVANT d'écrire du code HTML
// Inclusion de la page booter.php qui va:  contenir la fonction session_start(), faire la connection à la BDD  ET inclure les fonctions et LANCER LA BDD via un fichier pour les utiliser dans ce fichier
include('booter.php');
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
                <div class="col-sm-12">
                    <h1>Boutique</h1>
                </div>
            </div>
            <form method="post" action="panierTest.php">

                <?php
                // Récupération des 10 derniers produits
                $listeProduits = $bdd->query('SELECT * FROM product ORDER BY idProduct ASC LIMIT 0, 3');

                // Affichage de chaque produit (toutes les données sont protégées par htmlspecialchars)
                // création de la while pour afficher chaque produit avec son nom, sa description, son prix et sa photo
                while ($donnees = $listeProduits->fetch()){
                ?>

                <div class="row">
                    <div class="col">
                      <img src="images/<?php echo htmlspecialchars($donnees['image']) ; ?>"  width="300" class="rounded corners img-fluid" alt="produit à vendre ">
                    </div>

                    <div class="col align-self-center">
                        <?php echo '<h1><strong>' . htmlspecialchars($donnees['productName']) . '</strong> :' . '</h1>';
                         echo '<p>' . htmlspecialchars($donnees['description']) . '</p>'; ?>
                    </div>

                    <div class="col align-self-center"">
                    <?php echo '<p>' . htmlspecialchars($donnees['price']) . ' euros' . '<p>'?>
                    </div>

                    <div class="col align-self-center"">
                        <input type="checkbox"  name="products[<?php echo $donnees['idProduct']?>]"/> <label for="case"></label>
                    </div>
                </div>
        <?php   }
    $listeProduits->closeCursor();
    ?>
                <div class="row-12 align-self-center" >
                    <input type="submit" value="commander"/>
                </div>
            </form>
        </div>
    </body>
</html>
