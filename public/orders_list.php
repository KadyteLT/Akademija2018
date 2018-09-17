<?php

require_once '../database.php';

function linkTo($parametrai)
{
    $parametrai = array_merge($_GET, $parametrai);
    $mas = array();
    foreach ($parametrai as $key => $value) {
        $mas[] = urlencode($key) . "=" . urlencode($value);
    }
    if (count($mas) > 0) {
        return "orders_list.php?" . implode("&", $mas);
    }
    return "orders_list.php";
}


$results_per_page = 15; // kiek irasu viename psl

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = (int)$_GET['page'];
}
$page = max(1, $page);

$this_page_first_result = ($page - 1) * $results_per_page; // pusliapiavimo pradine reiksme 1 1-1=0


$galimi_laukai = array('id', 'buyer', 'type', 'color', 'size', 'street', 'town', 'city');
if (isset($_GET['laukas']) && in_array($_GET['laukas'], $galimi_laukai)) {
    $rusiavimas = $_GET['laukas'];
} else {
    $rusiavimas = 'id';
}
if (isset($_GET['kryptis']) && $_GET['kryptis'] == 'desc') {
    $kryptis = 'desc';
} else {
    $kryptis = 'asc';
}

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
    orders.buyer_address_1 AS street,
    orders.buyer_address_2 AS town,
    orders.mobile AS mobile, 
    cities.city AS city
FROM
    orders
LEFT JOIN jumpers ON orders.jumper_id = jumpers.id
LEFT JOIN jumper_color ON orders.jumper_color_id = jumper_color.id
LEFT JOIN jumper_gender ON orders.jumper_gender_id = jumper_gender.id
LEFT JOIN jumper_size ON orders.jumper_size_id = jumper_size.id
LEFT JOIN cities ON orders.city_id = cities.id";

$sqlSkaic = "SELECT count(*) as kiekis FROM orders
LEFT JOIN jumpers ON orders.jumper_id = jumpers.id
LEFT JOIN jumper_color ON orders.jumper_color_id = jumper_color.id
LEFT JOIN jumper_gender ON orders.jumper_gender_id = jumper_gender.id
LEFT JOIN jumper_size ON orders.jumper_size_id = jumper_size.id
LEFT JOIN cities ON orders.city_id = cities.id";

// uzklausos selectams filtravimui
$sql_from_jumper_gender = "SELECT id, gender FROM `jumper_gender`";
$sql_from_jumper_color = "SELECT id, color  FROM `jumper_color`";
$sql_from_jumper_size = "SELECT id, size  FROM `jumper_size`";
$sql_from_jumper_type = "SELECT id, type  FROM `jumpers`";
$sql_from_cities = "SELECT id, city  FROM `cities` order by city";


$gender_result = mysqli_query($connect, $sql_from_jumper_gender);
$jumper_color_result = mysqli_query($connect, $sql_from_jumper_color);
$jumper_size_result = mysqli_query($connect, $sql_from_jumper_size);
$jumper_type_result = mysqli_query($connect, $sql_from_jumper_type);
$cities_result = mysqli_query($connect, $sql_from_cities);

$where = [];
if (isset($_GET['gender'])) {
    $where[] = 'orders.jumper_gender_id = ' . mysqli_escape_string($connect, (int)$_GET['gender']);
}
if (isset($_GET['color'])) {
    $where[] = 'orders.jumper_color_id = ' . mysqli_escape_string($connect, (int)$_GET['color']);
}
if (isset($_GET['size'])) {
    $where[] = 'orders.jumper_size_id = ' . mysqli_escape_string($connect, (int)$_GET['size']);
}
if (isset($_GET['type'])) {
    $where[] = 'orders.jumper_id = ' . mysqli_escape_string($connect, (int)$_GET['type']);
}
if (isset($_GET['city'])) {
    $where[] = 'orders.city_id = ' . mysqli_escape_string($connect, (int)$_GET['city']);
}

// cia paieskai

$searchString = '';
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $searchString = trim($_GET['search']);
    $where[] = "CONCAT(orders.id, CONCAT(orders.buyer_name, ' ', orders.buyer_lastname), size, type, color, city) LIKE '%" . mysqli_escape_string($connect,
            $searchString) . "%'";
}

if (count($where) > 0) {
    $sql .= ' WHERE ' . implode(' AND ', $where);
    $sqlSkaic .= ' WHERE ' . implode(' AND ', $where);
}
$sql .= " ORDER BY " . $rusiavimas . ' ' . $kryptis . " LIMIT " . $this_page_first_result . "," . $results_per_page;

//skaiciavimams
$mysqlResult = mysqli_query($connect, $sqlSkaic);
if ($mysqlResult === false) {
    echo mysqli_error($connect);
}
$row = mysqli_fetch_assoc($mysqlResult);
$number_of_pages = ceil($row['kiekis'] / $results_per_page); // 27/15 = 2

// rezultatams
$mysqlResult = mysqli_query($connect, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Užsakymų sąrašas</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<header class="jumbotron bg-success text-center text-white">
    <div class="content">
        <div class="container">
            <h1> Užsakymai</h1>
        </div>
    </div>
</header>

<section>
    <div class="container">

        <div>
            <ul class="nav nav-pills">
                <li class="mb-3">
                    <a href="index.php" class="btn btn-outline-success mt-2 mb" role="button" aria-pressed="true">Grįžti</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="input-group ">
                <div class="col-lg-12 mb-2">
                    <h3 class="text-success">Filtravimas!</h3>
                    <form action="orders_list.php" method="get" class="form-inline">
                        <div class="form-group mr-2">
                            <select class="form-control" name="gender">
                                <option value="" disabled selected hidden>Modelis pagal lytį</option>
                                <?php while ($row = mysqli_fetch_assoc($gender_result)) { ?>
                                    <option value="<?php echo htmlentities($row['id'],
                                        ENT_QUOTES); ?>"
                                        <?php if (isset($_GET['gender']) && $row['id'] == $_GET['gender']) {
                                            echo 'selected';
                                        } ?>
                                    ><?php echo $row['gender']; ?></option>
                                <?php }; ?>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <select class="form-control" name="color">
                                <option value="" disabled selected hidden>Spalva</option>
                                <?php while ($row = mysqli_fetch_assoc($jumper_color_result)) { ?>

                                    <option value="<?php echo htmlentities($row['id'],
                                        ENT_QUOTES); ?>"
                                        <?php if (isset($_GET['color']) && $row['id'] == $_GET['color']) {
                                            echo 'selected';
                                        } ?>
                                    ><?php echo $row['color']; ?></option>
                                <?php }; ?>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <select class="form-control" name="size">
                                <option value="" disabled selected hidden>Dydis</option>
                                <?php while ($row = mysqli_fetch_assoc($jumper_size_result)) { ?>
                                    <option value="<?php echo htmlentities($row['id'],
                                        ENT_QUOTES); ?>"
                                        <?php if (isset($_GET['size']) && $row['id'] == $_GET['size']) {
                                            echo 'selected';
                                        } ?>
                                    ><?php echo $row['size']; ?></option>
                                <?php }; ?>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <select class="form-control" name="type">
                                <option value="" disabled selected hidden>Modelis</option>
                                <?php while ($row = mysqli_fetch_assoc($jumper_type_result)) { ?>
                                    <option value="<?php echo htmlentities($row['id'],
                                        ENT_QUOTES); ?>"
                                        <?php if (isset($_GET['type']) && $row['id'] == $_GET['type']) {
                                            echo 'selected';
                                        } ?>
                                    ><?php echo $row['type']; ?></option>
                                <?php }; ?>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <select class="form-control" id="rajonas" name="city">
                                <option value="" disabled selected hidden>Miestas</option>
                                <?php while ($row = mysqli_fetch_assoc($cities_result)) { ?>
                                    <option value="<?php echo htmlentities($row['id'],
                                        ENT_QUOTES); ?>"><?php echo $row['city']; ?></option>
                                <?php }; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Filtruoti</button>
                        <a href="orders_list.php" class="btn btn-info mt-2 ml-1" role="button" aria-pressed="true">Atstatyti</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="input-group col-md-5 mb-3">
            <form action="orders_list.php" method="get" class="form-inline">
                <input class="form-control" type="text" name="search"
                       value="<?php echo htmlspecialchars($searchString); ?>">
                <input class="form-control" type="hidden" name="laukas"
                       value="<?php echo htmlentities($rusiavimas); ?>">
                <input class="form-control" type="hidden" name="kryptis"
                       value="<?php echo htmlentities($kryptis); ?>">

                <div class="input-group-append">

                    <button class="btn btn-success ml-2" type="submit">Ieškoti</button>
                    <a href="orders_list.php" class="btn btn-info ml-1" role="button" aria-pressed="true">Valyti</a>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Užs.nr <a href="<?php echo linkTo(["laukas" => "id", "kryptis" => "asc"]); ?>">&#x25B2</a><a
                            href="<?php echo linkTo(["laukas" => "id", "kryptis" => "desc"]); ?>">&#x25BC</th>
                <th>Pirkėjas<a href="<?php echo linkTo(["laukas" => "buyer", "kryptis" => "asc"]); ?>">&#x25B2</a><a
                            href="<?php echo linkTo(["laukas" => "buyer", "kryptis" => "desc"]); ?>">&#x25BC</th>
                <th>Dydis <a href="<?php echo linkTo(["laukas" => "size", "kryptis" => "asc"]); ?>">&#x25B2</a><a
                            href="<?php echo linkTo(["laukas" => "size", "kryptis" => "desc"]); ?>">&#x25BC</th>
                <th>Tipas <a href="<?php echo linkTo(["laukas" => "type", "kryptis" => "asc"]); ?>">&#x25B2</a><a
                            href="<?php echo linkTo(["laukas" => "type", "kryptis" => "desc"]); ?>">&#x25BC</th>
                <th>Spalva <a href="<?php echo linkTo(["laukas" => "color", "kryptis" => "asc"]); ?>">&#x25B2</a><a
                            href="<?php echo linkTo(["laukas" => "color", "kryptis" => "desc"]); ?>">&#x25BC</th>
                <th>Adresas <a href="<?php echo linkTo(["laukas" => "city", "kryptis" => "asc"]); ?>">&#x25B2</a><a
                            href="<?php echo linkTo(["laukas" => "city", "kryptis" => "desc"]); ?>">&#x25BC</th>
                <th>Užsk. informacija</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($mysqlResult)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlentities($row['buyer'], ENT_QUOTES); ?></td>
                    <td><?php echo $row['size']; ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <td><?php echo $row['color']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><a href=more_info.php?id=<?php echo $row['id']; ?> class="btn btn-outline-success m-2 " role="button" aria-pressed="true">Daugiau</a>
                    </td>
                </tr>
            <?php }; ?>
            </tbody>
        </table>
    </div>
    <div>
        <ul class="pagination">
            <?php if ($page != 1) { ?>
                <li class="page-item"><a class="page-link" href="<?php echo linkTo(["page" => $page - 1]); ?>">Atgal</a>
                </li>
            <?php } ?>

            <?php for ($pageNo = 1; $pageNo <= $number_of_pages; $pageNo++) {
                if ($page == $pageNo) {
                    echo '<li class="page-item active" >';
                } else {
                    echo '<li>';
                }
                echo '<a class="page-link" href="' . linkTo(['page' => $pageNo]) . '">' . $pageNo . '</a></li>';
            }
            ?>
            <?php if (($page != $number_of_pages) && ($number_of_pages > 1)) { ?>
                <li class="page-item"><a class="page-link "href="<?php echo linkTo(["page" => $page + 1]); ?>">pirmyn</a></li>
            <?php } ?>
        </ul>
    </div>
    <footer>
        <footer>
            <div class="container">
                <p class="m-0 text-center text-dark small">Zivile&copy;<?php echo date("Y") ?></p>
            </div>
        </footer>
    </footer>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
