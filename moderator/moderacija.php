<?php
    $putanja = dirname($_SERVER['REQUEST_URI'],2);
    $direktorij = dirname(getcwd());
    include '../zaglavlje.php';

    $naziv =""; $mjesecna_cijena=""; $moderator=""; $dodaj_azuriraj = "Dodaj";
    $vrtic = ""; $moderator_id="";
    $v_naziv = "";

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

    //DOHVATI MODERATORA ZA AUTOMATSKO POPUNJAVANJE TABLICE I POLJA

    if($_SESSION["uloga"] !== '1'){
    $veza = new Baza();
    $veza -> spojiDB();
    $korisnik_dnevnik =  "'" .$_COOKIE["autenticiran"]."'";
    $upit = "SELECT * FROM korisnik, vrtic WHERE korisnik.korisnik_id = vrtic.korisnik_id AND korisnicko_ime = " . $korisnik_dnevnik;
    $rezultat = $veza -> selectDB($upit);
    $red = mysqli_fetch_array($rezultat);
    $moderator_id = $red["korisnik_id"];
    $v_naziv = $red['naziv'];
    $moderator =  $red['ime'] . " " . $red['prezime'];

    $upit_vrtic_id = "SELECT * FROM korisnik, vrtic WHERE korisnik.korisnik_id = vrtic.korisnik_id";
    $rezultat = $veza -> selectDB($upit);
    $red = mysqli_fetch_array($rezultat);
    $vrtic_id_a = $red["vrtic_id"];
    $korisnik_id_a = $red["korisnik_id"];
    $veza->zatvoriDB();
    }

    //BRISANJE
    if(isset($_COOKIE["pobrisi"]) && ($_COOKIE["pobrisi"] !== '-1')){
        
        $veza = new Baza();
        $veza -> spojiDB();
        $id = $_COOKIE["pobrisi"];
        setcookie("pobrisi", "-1", false, "/");
        $upit = "DELETE FROM skupina WHERE skupina_id = '{$id}'";
        $rezultat = $veza->updateDB($upit); 

        $korisnik_dnevnik =  "'" .$_COOKIE["autenticiran"]."'";
        $upit2 = "SELECT * FROM korisnik WHERE korisnicko_ime = " . $korisnik_dnevnik;
        $rezultat2 = $veza -> selectDB($upit2);
        $red2 = mysqli_fetch_assoc($rezultat2);

        $dnevnik_korisnik = $red2["korisnik_id"];
        $vrijeme_provodenja = date('Y-m-d H:i:s');
        
        $dnevnik_upit = "INSERT INTO `dnevnik` VALUES (NULL, 'brisanje', 'DELETE FROM skupina WHERE skupina_id = {$id}' , '{$vrijeme_provodenja}', '{$dnevnik_korisnik}', '2')";
        $rezultat3 = $veza->updateDB($dnevnik_upit);     

        $veza->zatvoriDB();
    }

    //AŽURIRANJE
    if(isset($_POST["azuriraj"]) && ($_COOKIE["id"] !== '-1')){
        $veza = new Baza();
        $veza -> spojiDB();
        $id = $_COOKIE["id"];
        setcookie("id", "-1", false, "/");
        $naziv = $_POST["naziv"];
        $mj_cijena = $_POST["mjesecna_cijena"];

        $upit = "UPDATE skupina SET naziv = '{$naziv}', cijena = '{$mj_cijena}' WHERE skupina_id = '{$id}'";
        $rezultat = $veza->updateDB($upit);

        $korisnik_dnevnik =  "'" .$_COOKIE["autenticiran"]."'";
        $upit2 = "SELECT * FROM korisnik WHERE korisnicko_ime = " . $korisnik_dnevnik;
        $rezultat2 = $veza -> selectDB($upit2);
        $red2 = mysqli_fetch_assoc($rezultat2);

        $dnevnik_korisnik = $red2["korisnik_id"];
        $vrijeme_provodenja = date('Y-m-d H:i:s');
        
        $dnevnik_upit = "INSERT INTO `dnevnik` VALUES (NULL, 'ažuriranje', 'UPDATE skupina SET naziv = {$naziv}, cijena = {$mj_cijena} WHERE skupina_id = {$id}' , '{$vrijeme_provodenja}', '{$dnevnik_korisnik}', '2')";
        $rezultat3 = $veza->updateDB($dnevnik_upit);

        $veza->zatvoriDB();
    }

    //DODAVANJE
    if(isset($_POST["dodaj"])){
        $veza = new Baza();
        $veza -> spojiDB();
        $naziv = $_POST["naziv"];
        $mj_cijena = $_POST["mjesecna_cijena"];
        

        $upit = "INSERT INTO `skupina` (`skupina_id`, `naziv`, `cijena`, `vrtic_id`, `korisnik_id`) VALUES (NULL, '{$naziv}', '{$mj_cijena}', '{$vrtic_id_a}', '{$korisnik_id_a}')";
        $rezultat = $veza->updateDB($upit); 

        $korisnik_dnevnik =  "'" .$_COOKIE["autenticiran"]."'";
        $upit2 = "SELECT * FROM korisnik WHERE korisnicko_ime = " . $korisnik_dnevnik;
        $rezultat2 = $veza -> selectDB($upit2);
        $red2 = mysqli_fetch_assoc($rezultat2);

        $dnevnik_korisnik = $red2["korisnik_id"];
        $vrijeme_provodenja = date('Y-m-d H:i:s');
        
        $dnevnik_upit = "INSERT INTO `dnevnik` VALUES (NULL, 'dodavanje', 'INSERT INTO `skupina` (`skupina_id`, `naziv`, `cijena`, `vrtic_id`, `korisnik_id`) VALUES (NULL, {$naziv}, {$mj_cijena}, {$vrtic_id_a}, {$korisnik_id_a})' , '{$vrijeme_provodenja}', '{$dnevnik_korisnik}', '2')";
        $rezultat3 = $veza->updateDB($dnevnik_upit);

        $veza->zatvoriDB();
    }

    //DOHVAĆANJE SVIH PODATAKA
    $veza = new Baza();
    $veza -> spojiDB();

    $upit = "SELECT skupina.skupina_id as s_id, skupina.naziv as s_naziv, skupina.cijena, vrtic.naziv as v_naziv, korisnik.ime as ime, korisnik.prezime as prezime
            FROM skupina, vrtic, korisnik
            WHERE skupina.vrtic_id = vrtic.vrtic_id AND skupina.korisnik_id = korisnik.korisnik_id AND skupina.korisnik_id = '{$moderator_id}'";
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
    <title>Kreiraj skupinu</title>
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
                include 'moderator_meni.php';
            
            
            
            echo "<div class='desni_dio'><h2>Kreiraj skupinu</h2>
            <hr>";
                echo "<form action='moderacija.php' method='POST' ><div class='unos_podataka'>
                    <table>
                    <tr>
                        <td>Naziv skupine</td>
                        <td>Mjesečna cijena</td>
                        <td>Naziv vrtića</td>
                    </tr>
                    <tr>
                        <td><input type='text' id='naziv' name='naziv' placeholder='Naziv' value='{$naziv}'></td>
                        <td><input type='number' id='mjesecna_cijena' name='mjesecna_cijena' placeholder='Cijena' value='{$mjesecna_cijena}'></td>
                        <td><input type='text' id='vrtic'  name='vrtic' placeholder='Vrtić' value='{$v_naziv}'></td>
                    </tr>
                    <tr>
                        <td class='par'>Moderator</td>
                        <td class='par'></td>
                        <td class='par'></td>
                    </tr>
                    <tr>
                        <td><input type='text' name='moderator' placeholder='Moderator' value='{$moderator}'></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
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
        var myArray = <?php echo json_encode($podaci); ?>;

        buildTable(myArray);

        function buildTable(data){
            var table = document.getElementById('body_tablica')
            table.innerHTML = `<tr>
                                <td>ID</td>
                                <td>Naziv Skupine</td>
                                <td>Mjesečna cijena</td>
                                <td>Vrtić</td>
                                <td>Moderator</td>                               
                                <td>Ukloni</td>
                                <td>Uredi</td>
                        </tr>`

            for (var i = 0; i < data.length; i++){
                ime = data[i].ime
                prezime = data[i].prezime

                var row = `<tr >
                                <td>${data[i].s_id}</td>
                                <td>${data[i].s_naziv}</td>
                                <td>${data[i].cijena}</td>
                                <td>${data[i].v_naziv}</td>
                                <td>` + ime + ` ` + prezime + `</td>                                
                                <td class='pobrisi'><a href='#' style='color: #2e95b8; font-size: 17px;'>Pobriši</a></td>
                                <td class='azuriraj'><a href='#' style='color: #2e95b8; font-size: 17px;'>Ažuriraj</a></td></td>
                            </tr>`
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