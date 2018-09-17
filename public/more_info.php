<?php

require_once '../database.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    $id = null;
}

if (empty($id)) {
    echo "Reikalingas parametras";
    exit;
}
//užklausa informacijai atspausdinti
$sql = "SELECT
    orders.id AS id,
    CONCAT(
        orders.buyer_name,
        ' ',
        orders.buyer_lastname
    ) AS buyer,
    jumpers.type AS type,
    jumper_color.color AS color,
    jumper_gender.gender AS gender,
    jumper_size.size AS size, 
    
    CONCAT(
      orders.buyer_address_1, 
      ' ',
      orders.buyer_address_2, 
      ' ', 
      cities.city) AS address,
    orders.mobile AS mobile 

FROM
    orders
LEFT JOIN jumpers ON orders.jumper_id = jumpers.id
LEFT JOIN jumper_color ON orders.jumper_color_id = jumper_color.id
LEFT JOIN jumper_gender ON orders.jumper_gender_id = jumper_gender.id
LEFT JOIN jumper_size ON orders.jumper_size_id = jumper_size.id
LEFT JOIN cities ON orders.city_id = cities.id where orders.id=" . $id;
$sql_result = mysqli_query($connect, $sql);

if (mysqli_num_rows($sql_result) == 0) {
    echo 'Rezultato nėra';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Užsakymas</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="jumbotron bg-success text-center text-white">
    <div class="content">
        <div class="container">
            <h1>Užsakymai</h1>
        </div>
    </div>
</header>
<div class="container">

    <div>
        <ul class="nav nav-pills">
            <li class="mb-3">
                <a href="index.php" class="btn btn-outline-success mt-2 mb" role="button" aria-pressed="true">Namai</a>
                <a href="orders_list.php" class="btn btn-outline-success mt-2 ml-1" role="button" aria-pressed="true">Užsakymai</a>
            </li>

        </ul>
    </div>
    <div>
        <?php $row = mysqli_fetch_array($sql_result); ?>
        <h4><strong>Visa informacija apie užsakymą:</strong></h4>
        <p><strong>Pirkėjas </strong><?php echo htmlentities($row['buyer'], ENT_QUOTES); ?></p>
        <p><strong>Užsakymas Nr: </strong><?php echo $row['id']; ?></p>
        <p><strong>Megztinio modelis: </strong><?php echo $row['type']; ?></p>
        <p><strong>Megztinio modelis pagal lytį: </strong><?php echo $row['gender']; ?></p>
        <p><strong>Pristatymo adresas </strong><?php echo htmlentities($row['address'], ENT_QUOTES); ?></p>
        <p><strong>Mobilus telefonas </strong><?php echo htmlentities($row['mobile'], ENT_QUOTES); ?></p>
    </div>
</div>
</body>
</html>