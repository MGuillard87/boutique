<?php
function afficheArticle1() {
    $liste_articles = [
        ["image"=>"images/chapeau_chat.jpg", "name"=>"Chapeau", "price"=>10],
        [ "image"=>"images/pull_cerf.jpg", "name"=>"Pull", "price"=>5],
        ["image"=> "images/nounours.jpg", "name"=>"Nounours", "price"=>1500]
    ]; ?>
<div class="row" >
    <div class="col">
        <img src="<?php  echo $liste_articles[0]["image"]; ?>" width="300" class="rounded corners img-fluid" alt="article à acheter">
    </div>
    <div class="col">
        <h2><?php echo $liste_articles[0]["name"];?></h2>
    </div>
    <div class="col">
        <h2><?php echo $liste_articles[0]["price"]." euros" ; ?> </h2>
    </div>
</div>

<?php };

function afficheArticle2() {
    $liste_articles = [
        ["image"=>"images/chapeau_chat.jpg", "name"=>"Chapeau", "price"=>10],
        [ "image"=>"images/pull_cerf.jpg", "name"=>"Pull", "price"=>5],
        ["image"=> "images/nounours.jpg", "name"=>"Nounours", "price"=>1500]
    ]; ?>
<div class="row" >
    <div class="col">
        <img src="<?php  echo $liste_articles[1]["image"]; ?>" width="300" class="rounded corners img-fluid" alt="article à acheter">
    </div>
    <div class="col">
        <h2><?php echo $liste_articles[1]["name"];?></h2>
    </div>
    <div class="col">
        <h2><?php echo $liste_articles[1]["price"]." euros" ; ?> </h2>
    </div>
</div>
<?php };

    function afficheArticle3() {
    $liste_articles = [
        ["image"=>"images/chapeau_chat.jpg", "name"=>"Chapeau", "price"=>10],
        [ "image"=>"images/pull_cerf.jpg", "name"=>"Pull", "price"=>5],
        ["image"=> "images/nounours.jpg", "name"=>"Nounours", "price"=>1500]
    ]; ?>
<div class="row" >
    <div class="col">
        <img src="<?php  echo $liste_articles[2]["image"]; ?>" width="300" class="rounded corners img-fluid" alt="article à acheter">
    </div>
    <div class="col">
        <h2><?php echo $liste_articles[2]["name"];?></h2>
    </div>
    <div class="col">
        <h2><?php echo $liste_articles[2]["price"]." euros" ; ?> </h2>
    </div>
</div>

<?php }; ?>


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

    <?php
    // affichage des variables nommées plus haut
    // création de la foreach for pour afficher chaque article avec sa photo, son prix et son nom

    afficheArticle1();
    afficheArticle2();
    afficheArticle3();
    ?>
</div>
</body>
</html>

