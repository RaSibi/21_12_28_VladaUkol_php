<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Výpis příspěvků</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body>
    <?php
    require 'phpconfig.php';

    $queryUvod = 'SELECT h.nickname, h.email, j.popis AS id_jezero, r.popis AS id_reka, h.klidna_voda, h.tekouci_voda, h.sprcha, h.sauna, text
        FROM hlavni h
        LEFT JOIN jezera j ON h.id_jezero = j.id
        LEFT JOIN reky r ON h.id_reka = r.id';

    if (isset($_POST['filtrname']) && $_POST['filtrname'] != '') {
        $nick = addslashes($_POST['filtrname']);
        $query = $queryUvod . ' WHERE nickname = "' . $nick . '" ';
        //$query = 'SELECT * FROM hlavni WHERE nickname = "' . $nick . '" ';
    } else if (isset($_POST['filtremail']) && $_POST['filtremail'] != '') {
        $email = addslashes($_POST['filtremail']);
        $query = $queryUvod . ' WHERE email = "' . $email . '" ';
    } else if (isset($_POST['radit']) && $_POST['radit'] != '') {
        $razeni = addslashes($_POST['radit']);
        $query = $queryUvod . ' ORDER BY ' . $razeni . ' ';
    } else {
        $query = $queryUvod;
        //$query = 'SELECT h.nickname, h.email, j.popis AS id_jezero, r.popis AS id_reka, text FROM hlavni h
        //LEFT JOIN jezera j ON h.id_jezero = j.id
        //LEFT JOIN reky r ON h.id_reka = r.id';
    }

    if (!($con = mysqli_connect($url, $jmeno, $heslo, $db)))
        die("Nelze se pripojit k DB serveru! </body></html>");

    if (!(mysqli_query($con, "SET NAMES utf8")))
        die("Nastaveni znakove sady se nezdarilo! </body></html>");

    //echo $query;
    if (!($vysledek = mysqli_query($con, $query)))
        die("Nelze provest dotaz! </body></html>");

    //SESSION
    $filtrJmeno = (isset($_SESSION['filtrname'])) ? $_SESSION['filtrname'] : array();
    if (isset($_POST['filtrname'])) {
        $jmeno = htmlspecialchars($_POST['filtrname']);
        $filtrJmeno[count($filtrJmeno)] = $jmeno;
        $_SESSION['filtrname'] = $filtrJmeno;
    }
    $filtrEmail = (isset($_SESSION['filtremail'])) ? $_SESSION['filtremail'] : array();
    if (isset($_POST['filtremail'])) {
        $jmeno = htmlspecialchars($_POST['filtremail']);
        $filtrEmail[count($filtrEmail)] = $jmeno;
        $_SESSION['filtremail'] = $filtrEmail;
    }
    $razeno = (isset($_SESSION['radit'])) ? $_SESSION['radit'] : array();
    if (isset($_POST['radit'])) {
        $jmeno = htmlspecialchars($_POST['radit']);
        $razeno[count($razeno)] = $jmeno;
        $_SESSION['radit'] = $razeno;
    }

    ?>

    <section id="" class="pt-3">
        <ul>
            <li><a href="index.php">Zpět na hlavní formulář</a></li>
            <li><a href="ScriptVypis.php">Přehled příspěvků na nástěnce</a></li>
            <!-- <li> <a href="ScriptVkladani.php">Filtrování, řazení, stránkování</a></li> -->
        </ul>

        <div class="container shadow p-3 mb-5 bg-light rounded text-left mt-5">
            <h1>Přehled příspěvků</h1>
            <form action="">

                <table border="1" cellpadding="10px">
                    <tr>
                        <th>Jméno / Přezdívka</th>
                        <th>Email</th>
                        <th>Praktikování</th>
                        <th>Preferované jezero</th>
                        <th>Preferovaná řeka</th>
                        <th>Příspěvek</th>
                    </tr>

                    <!-- TOHLE SE VYPISUJE V CYKLU WHILE  -->
                    <?php
                    while ($radekDB = mysqli_fetch_array($vysledek)) {
                        $praktiky = '';
                        if ($radekDB['klidna_voda'] == 1) {
                            $praktiky .= "Klidná voda," . "<br>";
                        }
                        if ($radekDB['tekouci_voda'] == 1) {
                            $praktiky .= "Tekoucí voda," . "<br>";
                        }
                        if ($radekDB['sprcha'] == 1) {
                            $praktiky .= "Sprcha," . "<br>";
                        }
                        if ($radekDB['sauna'] == 1) {
                            $praktiky .= "Sauna," . "<br>";
                        }
                        echo "<tr><td>" . htmlspecialchars($radekDB['nickname']) . "</td><td>" . htmlspecialchars($radekDB['email']) . "</td>
                        <td>" . $praktiky . "</td><td>" . htmlspecialchars($radekDB['id_jezero']) . "</td>
                        <td>" . htmlspecialchars($radekDB['id_reka']) . "</td><td>" . htmlspecialchars($radekDB['text']) . "</td></tr>";
                    }
                    mysqli_free_result($vysledek);
                    mysqli_close($con);
                    ?>

                </table>
            </form>
            <br>
        </div>

        <div class="container shadow p-3 mb-5 bg-light rounded text-left mt-5">
            <h3>Filtrování příspěvků</h3>
            <form action="ScriptVypis.php" method="post">
                <input type="text" name="filtrname"> Jméno / Přezdívka <br>
                <input type="text" name="filtremail"> Email <br>
                <hr>
                <button type="submit">Vyhledej</button>
                <button type="reset">Reset</button>
            </form>
        </div>
        <div class="container shadow p-3 mb-5 bg-light rounded text-left mt-5">
            <h3>Řazení příspěvků</h3>
            <form action="ScriptVypis.php" method="post">
                <input type="radio" name="radit" value="nickname"> Jméno / Přezdívka <br>
                <input type="radio" name="radit" value="email"> Email <br>
                <hr>
                <button type="submit">Řadit</button>
            </form>
        </div>

    </section>
</body>

</html>