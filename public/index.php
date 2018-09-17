<?php

require_once '../vendor/autoload.php';
require_once '../database.php';

$recaptchaSecret = $_SERVER['RECAPTCHA_SECRET'];

session_start();

if ($connect === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$gender_id = "";
$jumper_color_id = "";
$jumper_size_id = "";
$jumper_type_id = "";
$name = "";
$lastname = "";
$street = "";
$town = "";
$mobile = "";
$buyer_city_id = "";

$_SESSION['message'] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptcha = new \ReCaptcha\ReCaptcha($recaptchaSecret);
    $response = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

    if ($response->isSuccess()) {
        $gender_id = mysqli_real_escape_string($connect, $_REQUEST["gender"]);
        $jumper_color_id = mysqli_real_escape_string($connect, $_REQUEST["color"]);
        $jumper_size_id = mysqli_real_escape_string($connect, $_REQUEST["size"]);
        $jumper_type_id = mysqli_real_escape_string($connect, $_REQUEST["type"]);
        $name = mysqli_real_escape_string($connect, $_REQUEST["name"]);
        $lastname = mysqli_real_escape_string($connect, $_REQUEST["lastname"]);
        $street = mysqli_real_escape_string($connect, $_REQUEST["street"]);
        $town = mysqli_real_escape_string($connect, $_REQUEST["town"]);
        $mobile = mysqli_real_escape_string($connect, $_REQUEST["mobile"]);
        $buyer_city_id = mysqli_real_escape_string($connect, $_REQUEST["city"]);

        $sql = "INSERT INTO `orders` (`jumper_id`, `jumper_color_id`, `jumper_gender_id`, `jumper_size_id`, `buyer_name`, `buyer_lastname`, `buyer_address_1`, `buyer_address_2`,  `mobile`, `city_id`) VALUES
     ($jumper_type_id, $jumper_color_id, $gender_id, $jumper_size_id, '$name', '$lastname', '$street', '$town', '$mobile', $buyer_city_id)";

        if (mysqli_query($connect, $sql)) {
            header("Location: index.php");
            exit;
        } else {
            $_SESSION['message'] = 'Netinkami duomenys. Užsakyti nepavyko.';
        }
    } else {
        $_SESSION['message'] = 'Nepatvirtinote, kad esate ne robotas.';
    }
}

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

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Nfq akademija </title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<header class="jumbotron bg-success text-center text-white">
    <div class="content">
        <div class="container">
            <h1> Mes už Lietuvą</h1>
            <h2> Būk Lietuvis ir palaikyk savo vyrų rinktinę</h2>
        </div>
    </div>
</header>
<section>
    <div class="container">
        <div class="container">

            <div>
                <ul class="nav nav-pills">
                    <li class="pl-5">
                        <a href="orders_list.php" class="btn btn-outline-success" role="button" aria-pressed="true">Užsakymai</a>
                    </li>
                </ul>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">

                    <div id="demo" class="carousel slide" data-ride="carousel">

                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            <li data-target="#demo" data-slide-to="0" class="active"></li>
                            <li data-target="#demo" data-slide-to="1"></li>
                            <li data-target="#demo" data-slide-to="2"></li>
                        </ul>

                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img/04.jpg" alt="žalias megztinis su herbu" width="490" height="490">
                            </div>
                            <div class="carousel-item ">
                                <img src="img/03.jpg" alt="Juodas megztinis su herbu" width="490" height="490">
                            </div>
                            <div class="carousel-item">
                                <img src="img/02.jpg" alt="juodas be kišeniu" width="490" height="490">
                            </div>

                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4 text-success">Tai pirmyn!</h2>
                        <p> Mes siūlome vyriškus ir moteriškus sportinius megztinius – tai praktiškas, patogus rūbas.
                            Kadaise megztiniai dažniausiai buvo naudojami sportui, šiandien nešiojami skirtingoms
                            progoms. Tinkamai parink megztinį ir leisk suprasti viesiems, kad palaikai Lietuvą ir
                            Lietuvos
                            sportininkus sunkiose kovose, dėl garbės ir medalio. Pasirink geriausią modelį, kuris
                            atitinka
                            tavo asmeninį stilių.</p>
                    </div>
                </div>
            </div>
        </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-4">
                <h3 class="text-success">Užsisakyk!</h3>
            </div>
        </div>
        <form action="index.php" method="post">
            <div class="row">
                <div class="col-lg-6">
                    <div class="pl-2 pr-2">
                        <h5 class="text-success">Kokio megztinio norėtum?</h5>
                        <div class="alert-danger"><?= $_SESSION['message'] ?></div>
                        <div class="form-group">
                            <label for="gender">Modelis pagal lytį *</label>
                            <select class="form-control" name="gender" required>
                                <option value="" disabled selected hidden>Pasirinkti</option>
                                <?php while ($row = mysqli_fetch_assoc($gender_result)) { ?>
                                    <option value="<?php echo htmlentities($row['id'],
                                        ENT_QUOTES); ?>"><?php echo $row['gender']; ?></option>
                                <?php }; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="color">Spalva *</label>
                            <select class="form-control" name="color" required>
                                <option value="" disabled selected hidden>Pasirinkti</option>
                                <?php while ($row = mysqli_fetch_assoc($jumper_color_result)) { ?>
                                    <option value="<?php echo htmlentities($row['id'],
                                        ENT_QUOTES); ?>"><?php echo $row['color']; ?>
                                    </option>
                                <?php }; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="size">Dydis *</label>
                            <select class="form-control" name="size" required>
                                <option value="" disabled selected hidden>Pasirinkti</option>
                                <?php while ($row = mysqli_fetch_assoc($jumper_size_result)) { ?>
                                    <option value="<?php echo htmlentities($row['id'],
                                        ENT_QUOTES); ?>"><?php echo $row['size']; ?></option>
                                <?php }; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="size">Modelis * </label>
                            <select class="form-control" name="type" required>
                                <option value="" disabled selected hidden>Pasirinkti</option>
                                <?php while ($row = mysqli_fetch_assoc($jumper_type_result)) { ?>
                                    <option value="<?php echo htmlentities($row['id'],
                                        ENT_QUOTES); ?>"><?php echo $row['type']; ?></option>
                                <?php }; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pl-2 pr-2">
                        <h5 class="text-success">Duomenys prekės pristatymui</h5>
                        <div class="form-group">
                            <label for="name">Vardas *</label>
                            <input type="text" class="form-control" name="name" required
                                   value="<?php echo htmlentities($name, ENT_QUOTES); ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Pavardė * </label>
                            <input type="text" class="form-control" name="lastname" required
                                   value="<?php echo htmlentities($lastname, ENT_QUOTES); ?>">
                        </div>
                        <div class="form-group">
                            <label class="m-1" for="gatve">Gatvė/namas/butas: *</label>
                            <input type="text" class="form-control" id="street" name="street" required
                                   value="<?php echo htmlentities($street, ENT_QUOTES); ?>">
                        </div>
                        <div class="form-group">
                            <label for="Miestelis">Miestelis/Kaimas</label>
                            <input type="text" class="form-control" id="Miestelis" name="town"
                                   value="<?php echo htmlentities($town, ENT_QUOTES); ?>">
                        </div>
                        <div class="form-group">
                            <label for="Miestas">Miestas/rajonas *</label>
                            <select class="form-control" id="rajonas" name="city" required>
                                <option value="" disabled selected hidden>Pasirinkti</option>
                                <?php while ($row = mysqli_fetch_assoc($cities_result)) { ?>
                                    <option value="<?php echo htmlentities($row['id'],
                                        ENT_QUOTES); ?>"><?php echo $row['city']; ?></option>
                                <?php }; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Telefonas</label>
                            <input type="text" class="form-control" id="mobile" name="mobile"
                                   value="<?php echo htmlentities($mobile, ENT_QUOTES); ?>">
                        </div>
                        <div class="form-group">
                            <div class="g-recaptcha mb-3" data-sitekey="6LclqHAUAAAAAHF-IhgODogNbWimLcgfLa9dSiLR"></div>
                        </div>
                        <div class="form-group">

                            <button type="submit" class="btn btn-success">Užsakyti</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Footer -->
<footer>
    <div class="container">
        <p class="m-0 text-center text-dark small">Zivile&copy;<?php echo date("Y") ?></p>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
