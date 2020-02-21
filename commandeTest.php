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
            <h1>récapitulatif de commande</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h1></h1>
        </div>
    </div>
<?php
// créer quelques variables de session dans $_SESSION
try {
    if (!empty($_POST)) {
        $_SESSION = $_POST;

    }

    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }

?>



    <?php
    $sumTotal = 0;
    if (!empty($_SESSION)) { ?>
        <?php
        foreach ($_SESSION['products'] as $key => $selective) {
            $idDentique = $bdd->query('SELECT * FROM product WHERE idProduct=' . $key);
            while ($productBasket = $idDentique->fetch()) {

                if (isset($_SESSION['quantities'][$productBasket['idProduct']])) {
                    $quantiProduct = $_SESSION['quantities'][$productBasket['idProduct']];
                } else {
                    $quantiProduct = 0;
                }
                $productName = $productBasket['productName'];
                $priceProduct = $productBasket['price'];

                // apppel de la fonction permettant de retourner le total du panier
                $sumTotal = totalPanier($sumTotal, $priceProduct, $quantiProduct)
                ?>

                <div class="row panier">
                    <div>
                        <p><?php echo "Vous avez commandé ".$quantiProduct." ".$productName. " à ". $priceProduct;?></p>
                    </div>
                </div>

                <?php
            }
        } ?>
        <div class="row panier">
            <div>
                <p><?php echo "Le total de votre commande est de ". $sumTotal. " euros"; ?> </p>
            </div>
        </div>

        <?php
        // Aller sélectionner le numéro de la commande et le modifier pour pouvoir le rentrer dans la table orders
        $numCommand = $bdd->query('SELECT idOrder FROM orders ORDER BY idOrders DESC LIMIT 0,1');
        while ($orders = $numCommand->fetch()) {
            //  echo "le dernier numéro de commande est ". $orders['idOrder'].'<br/>';
            $rest = substr($orders['idOrder'], -3);
            $rest=$rest + 1;}
        // Convertir le calcul précédent en string
        $idOrder = strval($rest);

        // Définition des variables au préalable avant une insertion préparée dans la BDD
        $totalAmount = $sumTotal;
        $idClient = random_int(1,2);
        $debutNomComand='CMD00';

        // Insertion des commandes dans la BDD
        $ordersInsert = $bdd->prepare('INSERT INTO orders (idOrder, totalAmount, idClient) VALUES(:idOrder, :totalAmount, :idClient)');

        $ordersInsert->execute(array(
            'idOrder' => $debutNomComand . $idOrder,
            'totalAmount' => $totalAmount,
            'idClient' => $idClient
        ));
        $ordersInsert->closeCursor();
        echo 'la commande a bien été ajoutée !'. '</br>';

        // Récupération de l'idOrders avec la fonction 'lastInsertID' qui retourne l'identifiant de la dernière ligne insérée
        $idOrders = $bdd->lastInsertId('SELECT idOrder FROM orders ');

        // Définition des variables au préalable avant une insertion préparée dans la BDD
        $quantity =  $_SESSION['quantities'];
        $idProduct = $_SESSION['products'];

        // Insertion des produits commandés dans la BDD
        foreach ($idProduct as $key=>$product) {
            $orderProductInsert = $bdd->prepare('INSERT INTO orderproduct (quantity, idOrders, idProduct) VALUES(:quantity, :idOrders, :idProduct)');

            $orderProductInsert->execute(array(
                'quantity' => $quantity[$key],
                'idOrders' => $idOrders,
                'idProduct' => $key
            ));
        }
    }

    // Finalement, on détruit la session.
    //    session_destroy();
    ?>

</body>
</html>





