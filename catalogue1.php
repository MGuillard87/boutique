<?php
include('catalogue_fonction.php');
$liste_articles = [
    ["image"=>"images/chapeau_chat.jpg", "name"=>"Chapeau", "price"=>10],
    [ "image"=>"images/pull_cerf.jpg", "name"=>"Pull", "price"=>5],
    ["image"=> "images/nounours.jpg", "name"=>"Nounours", "price"=>1500]
];
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
    <?php
    afficheArticle($liste_articles);
    ?>

</div>
</body>
</html>
