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
} ?>
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
            <h1>récapitulatif de commande</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h1></h1>
        </div>
    </div>
<?php
$sumTotal = 0;

    if (!empty($_SESSION)) { ?>
<?php
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
                    <div>
                        <p><?php echo "Vous avez commandé ".$_SESSION['quantities'][$productBasket['idProduct']]." ".$productBasket['productName']. " à ".$productBasket['price'];?></p>
                    </div>
                </div>

                <?php
                }
        }
    }     ?>
        <div class="row panier">
            <div>
                <p><?php echo "Le total de votre commande est de ". $sumTotal. " euros"; ?> </p>
            </div>
        </div>
    </body>
</html>
