<?php
    $putanja = dirname($_SERVER['REQUEST_URI'],2);
    $direktorij = dirname(getcwd());
    include '../zaglavlje.php';

    $naziv =""; $adresa=""; $moderator=""; $dodaj_azuriraj = "Dodaj";

    $ime = "";
    $prezime = "";

    if(isset($_POST['prihvati'])){
        setcookie("kolacici", 1, time() + (86400 * 2), '/', false);
        header("Location: prijava.php");
    }
        if (!isset($_COOKIE["kolacici"])){

        echo "<div id='cookie_disclaimer' class='fixed'>
                <form method='POST' name='prihvati_kolacice' action='#'>
                    <p>Radi kvalitetnijeg rada aplikacije, prihvatite kolačiće!</p>
                    <div id='btn'><input id='kolacici' class='input' type='submit' name='prihvati'
                            value='Prihvaćam!'></div>
                </div>
            </div>";
    }

    //BRISANJE
    if(isset($_COOKIE["pobrisi"]) && ($_COOKIE["pobrisi"] !== '-1')){
        
        $veza = new Baza();
        $veza -> spojiDB();
        $id = $_COOKIE["pobrisi"];
        setcookie("pobrisi", "-1", false, "/");
        $upit = "DELETE FROM vrtic WHERE vrtic_id = '{$id}'";
        $rezultat = $veza->updateDB($upit); 
        $veza->zatvoriDB();
    }

    //AŽURIRANJE
    if(isset($_POST["azuriraj"]) && ($_COOKIE["id"] !== '-1')){
        $veza = new Baza();
        $veza -> spojiDB();
        $id = $_COOKIE["id"];
        setcookie("id", "-1", false, "/");
        $naziv = $_POST["naziv"];
        $adresa = $_POST["adresa"];
        $dijelovi = explode(" - ", $_POST["moderator"]);
        $korisnik_id = $dijelovi[0];

        $upit = "UPDATE vrtic SET naziv = '{$naziv}', adresa = '{$adresa}', korisnik_id = '{$korisnik_id}' WHERE vrtic_id = '{$id}'";
        $rezultat = $veza->updateDB($upit); 
        $veza->zatvoriDB();
    }

    //DODAVANJE
    if(isset($_POST["dodaj"])){
        $veza = new Baza();
        $veza -> spojiDB();
        $naziv = $_POST["naziv"];
        $adresa = $_POST["adresa"];
        $dijelovi = explode(" - ", $_POST["moderator"]);
        $korisnik_id = $dijelovi[0];

        $upit = "INSERT INTO `vrtic` (`vrtic_id`, `naziv`, `adresa`, `korisnik_id`) VALUES (NULL, '{$naziv}', '{$adresa}', '{$korisnik_id}')";

        $rezultat = $veza->updateDB($upit); 
        $veza->zatvoriDB();
    }

    //POPUNJAVANJE CB
    function popuni(){
        $podaci = '';
        $veza = new Baza();
        $veza -> spojiDB();

        $upit = "SELECT * FROM korisnik WHERE uloga_id = '2'";
        $rezultat = $veza -> selectDB($upit);
        while($red = mysqli_fetch_array($rezultat)){
            $podaci .= '<option value="' .$red["korisnik_id"]. ' - ' .$red["ime"].' '.$red["prezime"]. '">' .$red["korisnik_id"]. ' - ' .$red["ime"].' '.$red["prezime"].'</option>';
        }
        $veza ->zatvoriDB();

        return $podaci;
    }

    //DOHVAĆANJE SVIH PODATAKA
    $veza = new Baza();
    $veza -> spojiDB();

    $upit = "SELECT vrtic.vrtic_id, vrtic.naziv, vrtic.adresa, korisnik.ime as ime, korisnik.prezime as prezime,
            vrtic.korisnik_id as moderator_id  FROM vrtic, korisnik
            WHERE vrtic.korisnik_id = korisnik.korisnik_id";
    $rezultat = $veza -> selectDB($upit);
    $podaci = array();
        while($red = mysqli_fetch_array($rezultat)){
            $podaci[] = $red;
        }
    
    $veza -> zatvoriDB();

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="hr">

<head>
    <title>Dodaj vrtić</title>
    <link rel="shortcut icon" href="../multimedija/logo.png" />
    <meta charset="UTF-8">
    <meta name="author" content="SD">
    <meta name="keywords" content="FOI, WebDiP, zadaća">
    <meta name="description" content="Primjer za meta podatke">
    <link href="../css/sdujakovi.css" rel="stylesheet" type="text/css" />
    <link href="../CSS/sdujakovi_prilagodbe_m.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" media="print" href="../CSS/sdujakovi_ispis.css" type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&display=swap" rel="stylesheet"> 
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../JavaScript/Javascript.js"></script>


</head>



<body>

<header class="header">
            <div class="naslov"><a>Moj vrtić</a></div>
            <div class="pretraga">
                <div class="meni">
                <?php
                include '../meni.php';
                ?>
                </div> 
                <div class="prijava_odjava">
                    <?php
                        if(isset($_SESSION['uloga'])){
                            echo '<a id="prijava_odjava" href="../index.php?odjava=true">Odjava</a>';
                        }else{
                            echo '<a id="prijava_odjava" href="../obrasci/prijava.php">Prijava</a>';
                        }
                    ?> 
                </div>
                <div class="pretraga-box">
                    <form novalidate id="prijava" method="GET" name="podaci" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <input class="pretraga-tekst" type="text" placeholder="Što želiš tražit?">
                        <button class="pretraga-gumb" type="submit" name="trazi" value=""><i style="margin-top: 15px" class="fas fa-search fa-2x"></i></input>   
                    </form>
                </div>   
            </div>     
        </header>



        <div class="container">
            <a href="../index.php"><div class="sliding-background"></div></a>
        </div>
        
        <div class="sadrzaj_administrator">
            <?php
                include 'administrator_meni.php';
            
            
            
            echo "<div class='desni_dio'>";
                echo "<form action='administracija.php' method='POST' ><div class='unos_podataka'>
                    <table>
                    <tr>
                        <td>Naziv</td>
                        <td>Adresa</td>
                        <td>Moderator</td>
                    </tr>
                    <tr>
                        <td><input type='text' id='naziv' name='naziv' ></td>
                        <td><input type='text' id='adresa' name='adresa' ></td>
                        <td><select name='moderator' id='moderator'>";
                        echo popuni();
                        echo "</select></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td><input id='dodaj' type='submit'name='dodaj' placeholder='lozinka' value='Dodaj'>
                    <input  id='azuriraj' type='submit' name='azuriraj' value='Ažuriraj'></td>
                </tr>
                </table>
                </div>";?>

                <div class="popis">
                    <input id="trazi_naziv" type="text" placeholder="Traži po imenu" autofocus>
                
                    <table style="word-break: break;" id="tablica1" class="tabela" >
                        <tbody id="body_tablica">
                            
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        

        <script>
        var polje1 = <?php echo json_encode($podaci); ?>;
        
        

        buildTable(polje1);

        function buildTable(data){
            var table = document.getElementById('body_tablica')
            table.innerHTML = `<tr>
                                <td>ID vrtića</td>
                                <td>Naziv</td>
                                <td>Adresa</td>
                                <td>Moderator</td>
                                <td>Ukloni</td>
                                <td>Uredi</td>
                                <td style='display:none;'>Moderator id</td>
                            </tr>`

            for (var i = 0; i < data.length; i++){    
                
                var id = data[i].vrtic_id
                var ime = data[i].ime
                var prezime = data[i].prezime


                var row = `<tr><form action='' method='POST'>
                                <td><input type='hidden' name='id_brisanja' value=` + id + `>${data[i].vrtic_id}</td>
                                <td>${data[i].naziv}</td>
                                <td>${data[i].adresa}</td>                                
                                <td>` + ime + ` `+ prezime +`</td>
                                <td class='pobrisi'><a href='#' style='color: #2e95b8; font-size: 17px;'>Pobriši</a></td>
                                <td class='azuriraj'><a style='color: #2e95b8; font-size: 17px;'>Ažuriraj</a></td>
                                <td style='display:none;'>${data[i].moderator_id} - `  + ime + ` `+ prezime +`</td>
                                </form></tr>`
                table.innerHTML += row
            }
        }

    </script>

    <footer>
        <address> Kontakt: <a href="mailto:sdujakovi@foi.hr ">Stanko Dujaković</a><br>
            <small>&copy; 2020. S. Dujaković</small><br>
            <a href="http://validator.w3.org/check?url=http://barka.foi.hr/WebDiP/2019/zadaca_01/sdujakovi/index.html"
                target="_blank">
                <img src="../multimedija/HTML5.png" alt="" width="23" /></a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2019/zadaca_01/sdujakovi/CSS/sdujakovi1.css"
                target="_blank">
                <img src="../multimedija/CSS3.png" alt="" width="25" /></a>
        </address>
    </footer>
</body>

</html>