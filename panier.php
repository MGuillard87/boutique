<?php
//var_dump($_POST);
// On démarre la session AVANT d'écrire du code HTML
// Inclusion de la page booter.php qui va contenir la fonction session_start() ET inclure les fonctions et LANCER LA BDD via un fichier pour les utiliser dans ce fichier
include('booter.php');

// connection à la BDD
$bdd = connectionBdd();
//foreach ($liste_articles as $clef=> $produits){
//    var_dump($clef);
//   var_dump( $produits);
//    foreach ($produits as $clefs=> $quantites){
//        var_dump($clefs);
//        var_dump( $quantites);
//    }
//}
//die();
// créer quelques variables de session dans $_SESSION
if (!empty($_POST)) {
    $_SESSION = $_POST;
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
        <div class="col-sm-12">
            <h1>Panier</h1>
        </div>
    </div>
    <form method="post" action="commande.php">
        <?php
        ;
        // Toujours vérifier que les informatons utilisées existent: var_dump très utile dans ce cas
        //var_dump($liste_articles)

        // affichage des variables nommées plus haut
        // création de la foreach for pour afficher chaque article avec sa photo, son prix et son nom
        try {
        //Toujours vérifier que les informatons utilisées existent et que les variables contiennent des données
        //            var_dump($_POST);
        // Si $_POST contient une/des données: la case est cochée et on peut afficher les articles

        // On va boucler dans la superVariable $_POST pour aller chercher l'information/donnée qui nous intéresse
        // Création de la variable sum pour calculer le total panier
        // affiche le panier pour la première fois
        $sumTotal = 0;

        if (!empty($_SESSION)) {
            foreach ($_SESSION['products'] as $key => $selective) {
                $idDentique = $bdd->query('SELECT * FROM product WHERE idProduct=' . $key);
                while ($productBasket = $idDentique->fetch()) {

                    // apppel de la fonction permettant de retourner le total du panier
                    if (isset($_SESSION['quantities'][$productBasket['idProduct']])) {
                        $quantiProduct = $_SESSION['quantities'][$productBasket['idProduct']];
                    } else {
                        $quantiProduct = 0;
                    }
                    $priceProduct = $productBasket['price'];
                    $sumTotal = totalPanier($sumTotal, $priceProduct, $quantiProduct)// le calcul se fait avec une fonction

                    ?>
                    <div class="row panier">
                        <div class="col align-self-center">
                            <img src="images/<?php echo htmlspecialchars($productBasket['image']); ?>" width="300"
                                 class="rounded corners img-fluid" alt="produit du panier ">

                        </div>

                        <div class="col align-self-center">
                            <h2><?php echo $productBasket['productName'];; ?></h2>
                        </div>

                        <div class="col align-self-center">
                            <h2><?php echo $productBasket['price'] . " euros"; ?> </h2>
                        </div> <?php

                        ?>
                        <div class="col align-self-center">
                            <input type="hidden" name="products[<?php echo $productBasket['idProduct'] ?>]" id="case"
                                   value=""/>
                            <input type="number" name="quantities[<?php echo $productBasket['idProduct'] ?>]" min=1
                                   value="<?php echo $quantiProduct ?>"/><br>
                            <label for="case">Quantité</label>
                            <div class="col-sm-12 ">
                                <input type="submit" value="Supprimer cet article"/>
                            </div>
                        </div>
                    </div>
                    <?php

                }
            }
        }
        $idDentique->closeCursor();
        // Affichage du total panier
        ?>
        <div class="row">
            <div class="col-sm-12 ">
                <h1>Total commande: <?php echo($sumTotal); ?> euros</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 ">
                <input type="submit" value="confirmer la commande"/>
            </div>
        </div>
    </form>

    <?php


    //    }
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
    ?>

</body>
</html>

