<?php
include('fonction_bdd.php');

// Appel de la fonction qui permet de se connecter à MySQL
$bdd = connectionBdd();

// Si tout va bien, on peut continuer

// Requête numéro 2
// On récupère tout le contenu de la table product
$listeProduits = $bdd->query('SELECT * FROM product');

// On affiche chaque entrée une à une
while ($donnees = $listeProduits->fetch())

{
   ?>
    <h1><strong>Produit n°</strong><?php echo $donnees['idProduct']; ?>: <?php echo $donnees['productName']; ?></h1>
        <p> prix: <?php echo $donnees['price'];?></p>
        <p> Description du produit : <?php echo $donnees['description'];?></p>
        <p> photo du produit : <?php echo $donnees['image'];?></p>
        <p> Catégorie du produit: <?php echo $donnees['idCategory'];?></p>
    <?php
}
// Termine le traitement de la requête
$listeProduits->closeCursor();

// Requête numéro 2
// Récupération de la liste des commandes créées depuis les 10 derniers jours
$listeCommandAncien = $bdd->query('SELECT * FROM orders 
                                            WHERE DATEDIFF(CURRENT_DATE, date) <= 10');
// On affiche chaque entrée une à une
while ($donnees = $listeCommandAncien->fetch())

{
    ?>
    <h1><strong>Commande n°</strong>: <?php echo $donnees['idOrder']; ?></h1>
    <p> Date de la commande: <?php echo $donnees['date'];?></p>
    <p> commande faite par le client n°<?php echo $donnees['idClient'];?></p>
    <?php
}
$listeCommandAncien->closeCursor();

// Requête numéro 3
// Récupération de la liste des produits (nom, quantité et prix unitaire nécessaire) de la commande 1
$listeProduiCom1 = $bdd->query('SELECT productName, price, quantity 
                                            FROM product 
                                            INNER JOIN orderproduct ON orderproduct.idProduct = product.idProduct 
                                            INNER JOIN orders ON orderproduct.idOrder = orders.idOrders 
                                            WHERE idOrders = 1');
//var_dump($listeProduiCom1);
// On affiche chaque entrée une à une
while ($donnees = $listeProduiCom1->fetch())

{
    ?>
    <h1><strong>Commande n° CMD001</strong></h1>
    <p> Nom du produit: <?php echo $donnees['productName'];?></p>
    <p> prix du produit: <?php echo $donnees['price'];?></p>
    <p> quantité:<?php echo $donnees['quantity'];?></p>
    <?php
}
$listeProduiCom1->closeCursor();

// Requête numéro 4
// Récupération du Prix total de chaques commandes
$priceTotalCom = $bdd->query('SELECT idOrders, sum(price * quantity) as totalCom
                                            FROM product
                                            INNER JOIN orderproduct ON orderproduct.idProduct = product.idProduct
                                            INNER JOIN  orders On orders.idOrders = orderproduct.idOrder
                                            GROUP BY idOrders');
//var_dump($listeProduiCom1);
// On affiche chaque entrée une à une
?>
   <h1><strong> Les commandes et leur prix total</strong></h1>
   <?php
while ($donnees = $priceTotalCom->fetch())

{
    ?>
    <p> Le prix total de la commande n°<?php echo $donnees['idOrders'];?> est de <?php echo $donnees['totalCom'].' euros';?></p>

    <?php
}
   $priceTotalCom->closeCursor();

   // Requête numéro 5
   // Ajouter un produit avec sa catégorie et sa quantité
//   $insertCom7 = $bdd->exec('INSERT INTO product (productName, description, price, image, stock, avaibility, weight, idCategory)
//VALUES (\'Mug Cochon\',\'Sus scrofa domesticus est une sous-espèce du sanglier sauvage (Sus scrofa). Un mammifère domestique omnivore de la famille des porcins, ou suidés. Appelé porc (du latin porcus) ou cochon ou encore cochon domestique, il est resté proche du sanglier avec lequel il peut se croiser.rique ou quasi-sphérique comme dans le cas des montgolfières.\', 1000, \'mug_cochon.png\', 5, 1, 500, 3)');
//echo "L'article a bien été ajouté";?><!-- <br />-->
<?php
//$insertCom7->closeCursor();

   // Requête numéro 6
   // Ajouter un produit avec sa catégorie et sa quantité
   $supprimArticle = $bdd->query('DELETE FROM product WHERE idProduct=17') ;
   echo "L'article a bien été supprimé";
   



?>

