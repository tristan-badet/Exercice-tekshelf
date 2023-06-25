<?php

// Connexion à la base de données

$db = new PDO ('mysql:host=localhost;dbname=tekshelf', 'root', '');


// requete pour l'affichage des produits par nom et ordre alphabetique

$queryByProductName = $db->prepare('SELECT * FROM stock ORDER BY nom_du_produit ASC');
$queryByProductName->execute();
$listByProductName = $queryByProductName->fetchall();

// Requete pour l'affichage des produits selon le code bar, plus le code bar a un grand nombre, plus il est bas

$queryByBarCode = $db->prepare('SELECT * FROM stock ORDER BY code_barre ASC');
$queryByBarCode->execute();
$listByBarCode = $queryByBarCode->fetchall();

// Requete de la moyenne des stocks des produits

$avgStockLeft = $db->prepare('SELECT AVG(stock_restant) AS average_stock_left FROM stock');
$avgStockLeft->execute();
$rowAvgStockLeft = $avgStockLeft->fetch();
$displayAvgStockLeft = $rowAvgStockLeft['average_stock_left'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Exercice</title>
</head>
<body>
    <section>
        <div class="container">
            <h1>Affichage des produits par nom du produit</h1>
            <table>
                <tr>
                    <!-- Nom des colonnes du tableau -->
                    <th>ID</th>
                    <th>Nom du produit</th>
                    <th>Marque du produit</th>
                    <th>Code barre</th>
                    <th>Rayon</th>
                    <th>Stock restant</th>
                </tr>
                <!-- Pour chaque produit à l'intérieur de la base de données, le code PHP créé une ligne avec chaque information de la base de données -->
                <?php foreach ($listByProductName as $value) { ?>
                <tr>
                    <td><?php echo $value['id'];?></td>
                    <td><?php echo $value['nom_du_produit'];?></td>
                    <td><?php echo $value['marque_du_produit'];?></td>
                    <td><?php echo $value['code_barre'];?></td>
                    <td><?php echo $value['rayon'];?></td>
                    <td><?php echo $value['stock_restant'];?></td>
                </tr>
               <?php } ?>
            </table>
        </div>
    </section>
    <section>  
        <div class="container">
            <h1>Affichage des produits par code barre croissant</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom du produit</th>
                    <th>Marque du produit</th>
                    <th>Code barre</th>
                    <th>Rayon</th>
                    <th>Stock restant</th>
                </tr>
                <!-- Pour chaque produit à l'intérieur de la base de données, le code PHP créé une ligne avec chaque information de la base de données -->
                <?php foreach ($listByBarCode as $value) { ?>
                <tr>
                    <td><?php echo $value['id'];?></td>
                    <td><?php echo $value['nom_du_produit'];?></td>
                    <td><?php echo $value['marque_du_produit'];?></td>
                    <td><?php echo $value['code_barre'];?></td>
                    <td><?php echo $value['rayon'];?></td>
                    <td><?php echo $value['stock_restant'];?></td>
                </tr>
               <?php } ?>
            </table>
        </div>
    </section>
    <section>
        <div>
            <!-- Affiche la moyenne des stocks -->
            <h1>Moyenne du stock des produits</h1>
            <h4><?php echo $displayAvgStockLeft;?></h4>
        </div>
    </section>
</body>
</html>