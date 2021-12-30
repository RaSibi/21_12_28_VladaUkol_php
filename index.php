<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Úkol programátor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body>
    <?php
    require 'config.php';
    
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
    <section id="" class="pt-3">
        <ul>
            <li><a href="ScriptVypis.php">Přehled příspěvků na nástěnce</a></li>
            <li> <a href="ScriptVkladani.php">Filtrování, řazení, stránkování</a></li>
        </ul>
        <div class="container text-center mt-5 shadow p-3 mb-5 bg-warning rounded">
            <h2>Nástěnka ostravských otužilců</h2>
            <!-- <form action="index.php" method="POST" id="ContactMe"> -->
            <form action="index.php" method="post" id="ContactMe">
                <div class="form-row pt-5">
                    <div class="form-group col-md-6">
                        <label for="validationDefault01">
                            <h4>Jméno / Přezdívka</h4>
                        </label>
                        <input type="text" class="form-control" id="validationDefault01" value="" name="nick" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="validationDefault02">
                            <h4>Email</h4>
                        </label>
                        <input type="email" class="form-control" name="email" id="validationDefault02" value="" required>
                    </div>
                </div>
                <h3>Zatrhni co praktikuješ</h3>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="klidna" value="1" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Pobyt v klidné ledové vodě
                    </label>
                    <br>
                    <input class="form-check-input" type="checkbox" name="tekouci" value="1" id="defaultCheck2">
                    <label class="form-check-label" for="defaultCheck2">
                        Pobyt v tekoucí ledové vodě
                    </label>
                    <br>
                    <input class="form-check-input" type="checkbox" name="sprcha" value="1" id="defaultCheck3">
                    <label class="form-check-label" for="defaultCheck3">
                        Studené sprchování
                    </label>
                    <br>
                    <input class="form-check-input" type="checkbox" name="sauna" value="1" id="defaultCheck4">
                    <label class="form-check-label" for="defaultCheck4">
                        Pobyt v sauně
                    </label>

                </div>
                <div class="pt-3">
                    <select class="custom-select" name="jezero">
                        <option selected>Vyberte preferované jezero</option>
                        <option value="1">Kališok Starý Bohumín</option>
                        <option value="2">Štěrkovna Hlučín</option>
                        <option value="3">Vrbice Bohumín</option>
                    </select>
                </div>
                <div class="pt-3">
                    <select class="custom-select" name="reka">
                        <option selected>Vyberte preferovanou řeku</option>
                        <option value="1">Odra, splav Svinov</option>
                        <option value="2">Ostravice, splav Vratimov</option>
                        <option value="3">Čeladenka, splav Čeladná</option>
                    </select>
                </div>

                <div class="form-group form-row">
                    <div class="col-md-12 p-3">
                        <label for="validationTextarea">
                            <h4>Příspěvek</h4>
                        </label>
                        <textarea class="form-control is-invalid" id="validationTextarea" placeholder="" name="text" required rows="5">
                        </textarea>

                        <div class="col-md-12 mt-5">
                            <button type="submit" class="btn btn-success btn-lg" name="submit">Vložit</button>
                            <button type="reset" class="btn btn-success btn-lg" name="reset">Reset</button>
                        </div>
                    </div>
                </div>
            </form>



        </div>
    </section>
</body>

</html>