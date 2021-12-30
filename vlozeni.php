<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vložení do formuláře</title>
</head>

<body>
    <?php
    require 'config.php';
    // $url = 'localhost';
    // $jmeno = 'Radek';
    // $heslo = 'RadekHeslo';
    // $db = 'otuzilci';

    if (isset($_POST['nick'])) {

        if (!($con = mysqli_connect($url, $jmeno, $heslo, $db))) {
            die("Nelze se pripojit k DB serveru! </body></html>");
        }
        if (!(mysqli_query($con, "SET NAMES 'utf8'"))) {
            die("Nastaveni znakove sady se nezdarilo! </body></html>");
        }
        if (mysqli_query($con, "INSERT INTO hlavni (nickname, email, klidna_voda, tekouci_voda, sprcha, sauna, id_jezero, id_reka, text) VALUES ('" .
            addslashes($_POST['nick']) . "', '" .
            addslashes($_POST['email']) . "', '" .
            addslashes($_POST['klidna']) . "', '" .
            addslashes($_POST['tekouci']) . "', '" .
            addslashes($_POST['sprcha']) . "', '" .
            addslashes($_POST['sauna']) . "', '" .
            addslashes($_POST['jezero']) . "', '" .
            addslashes($_POST['reka']) . "', '" .
            addslashes($_POST['text']) . "') ")) {
            echo "Uspesne vlozeno";
        } else {
            echo "Nelze provest dotaz!" . mysqli_error($con);
        }
        mysqli_close($con);
    }

    ?>

</body>

</html>