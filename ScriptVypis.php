<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přehled knih</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body>
    <?php
    require 'config.php';

    // if (isset($_POST['jmenoname']) && $_POST['jmenoname'] != '') {
    //     $jmeno = addslashes($_POST['jmenoname']);
    //     $query = 'SELECT * FROM seznam WHERE jmeno = "' . $jmeno . '" ';
    // } else if (isset($_POST['prijmeniname']) && $_POST['prijmeniname'] != '') {
    //     $prijmeni = addslashes($_POST['prijmeniname']);
    //     $query = 'SELECT * FROM seznam WHERE prijmeni = "' . $prijmeni . '" ';
    // } else if (isset($_POST['nazevname']) && $_POST['nazevname'] != '') {
    //     $nazev = addslashes($_POST['nazevname']);
    //     $query = 'SELECT * FROM seznam WHERE nazev = "' . $nazev . '" ';
    // } else if (isset($_POST['isbnname']) && $_POST['isbnname'] != '') {
    //     $isbn = addslashes($_POST['isbnname']);
    //     $query = 'SELECT * FROM seznam WHERE isbn = "' . $isbn . '" ';
    // } else {
    //     $query = 'SELECT * FROM seznam';
    // }
    $query = 'SELECT * FROM hlavni';

    if (!($con = mysqli_connect($url, $jmeno, $heslo, $db)))
        die("Nelze se pripojit k DB serveru! </body></html>");

    if (!(mysqli_query($con, "SET NAMES utf8")))
        die("Nastaveni znakove sady se nezdarilo! </body></html>");


    if (!($vysledek = mysqli_query($con, $query)))
        die("Nelze provest dotaz! </body></html>");

    ?>

    <section id="" class="pt-3">
        <ul>
            <li><a href="index.php">Zpět na hlavní formulář</a></li>
            <li> <a href="ScriptVkladani.php">Filtrování, řazení, stránkování</a></li>
        </ul>

        <div class="container shadow p-3 mb-5 bg-light rounded text-left mt-5">
            <h1>Přehled příspěvků</h1>
            <form action="">

                <table border="1" cellpadding="10px">
                    <tr>
                        <th>Jméno / Přezdívka</th>
                        <th>Email</th>
                        <th>Preferované jezero</th>
                        <th>Preferovaná řeka</th>
                        <th>Příspěvek</th>
                    </tr>

                    <!-- TOHLE SE VYPISUJE V CYKLU WHILE  -->
                    <?php
                    while ($radekDB = mysqli_fetch_array($vysledek)) {
                        echo "<tr><td>" . htmlspecialchars($radekDB['nickname']) . "</td><td>" . htmlspecialchars($radekDB['email']) . "</td><td>" .
                            htmlspecialchars($radekDB['id_jezero']) . "</td><td>" . htmlspecialchars($radekDB['id_reka']) . "</td><td>" .
                            htmlspecialchars($radekDB['text']) . "</td></tr>";
                    }
                    mysqli_free_result($vysledek);
                    mysqli_close($con);
                    ?>

                </table>
            </form>
            <br>

        </div>
    </section>
</body>

</html>