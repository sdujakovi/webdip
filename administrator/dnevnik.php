<?php
    $putanja = dirname($_SERVER['REQUEST_URI'],2);
    $direktorij = dirname(getcwd());
    include '../zaglavlje.php';


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

    $radnja = ""; $upit_p = ""; $vrijeme_provodenja = ""; $dodaj_azuriraj = "Dodaj";

    if(isset($_POST["Dodaj"])){
        $veza = new Baza();
        $veza -> spojiDB();
        $radnja = $_POST["radnja"];
        $upit_p = $_POST["upit_p"];
        $vrijeme_provodenja = $_POST["vrijeme_provodenja"];

        $upit = "INSERT INTO dnevnik (dnevnik_id, radnja, upit, datum_vrijeme, korisnik_id, tip_id) VALUES (NULL, '{$radnja}', '{$upit_p}' , '{$vrijeme_provodenja}', '1', '2')";
        $rezultat = $veza->updateDB($upit); 
        $veza->zatvoriDB();
    }


    if(isset($_COOKIE["pobrisi"])){
        
        $veza = new Baza();
        $veza -> spojiDB();
        $id = $_COOKIE["pobrisi"];
        setcookie("pobrisi", "-1", false, "/");
        $upit = "DELETE FROM dnevnik WHERE dnevnik_id = '{$id}'";
        $rezultat = $veza->updateDB($upit); 
        $veza->zatvoriDB();
    }

    if(isset($_POST["Ažuriraj"])){
        $veza = new Baza();
        $veza -> spojiDB();
        $id = $_COOKIE["id_a"];
        setcookie("id_a", "", false, "/");
        $radnja = $_POST["radnja"];
        $upit_p = $_POST["upit_p"];
        $vrijeme_provodenja = $_POST["vrijeme_provodenja"];

        $upit = "UPDATE dnevnik SET radnja = '{$radnja}', upit = '{$upit_p}', datum_vrijeme = '{$vrijeme_provodenja}' WHERE dnevnik_id = '{$id}'";
        $rezultat = $veza->updateDB($upit); 
        $veza->zatvoriDB();
    }
    
    if(isset($_POST["odustani"])){
        setcookie("id", "-1", false, "/");
        $ime = ""; $prezime="";$korisnicko_ime = ""; $email=""; $lozinka=""; $datum ="";$dodaj_azuriraj = "Dodaj";
    }

    if(isset($_COOKIE["id_a"]) && ($_COOKIE["id_a"] !== '-1')){
        if(isset($_POST["odustani"])){
            setcookie("id_a", "-1", false, "/");
            $ime = ""; $prezime="";$korisnicko_ime = ""; $email=""; $lozinka=""; $datum ="";$dodaj_azuriraj = "Dodaj";
        }else{
            $veza = new Baza();
            $veza -> spojiDB();
            $id = "'" . $_COOKIE["id_a"] . "'";
            
            $upit = "SELECT dnevnik_id, radnja, upit, datum_vrijeme, korisnik.ime as ime, korisnik.prezime as prezime,
                 tip.naziv as naziv FROM dnevnik, tip, korisnik WHERE tip.tip_id = dnevnik.tip_id AND dnevnik.korisnik_id = korisnik.korisnik_id
                 AND dnevnik_id = " . $id;
            $rezultat = $veza -> selectDB($upit);
            $red = mysqli_fetch_array($rezultat);
            $radnja = $red["radnja"];
            $upit_p = $red["upit"];
            $vrijeme_provodenja = date('Y-m-d\TH:i:s', strtotime($red["datum_vrijeme"]));

            $dodaj_azuriraj = "Ažuriraj";
            $veza ->zatvoriDB();
        }
    }

    //PRETRAZIVANJE
    if(isset($_POST["naziv_vrtica"])){
        $veza = new Baza();
        $veza -> spojiDB();
        $naziv = "'" . $_POST["naziv_vrtica"] . "'";

        $upit = "SELECT * FROM korisnik WHERE korisnicko_ime LIKE '{$naziv}'";
        $rezultat = $veza -> selectDB($upit);

        if($username == "''"){
            echo 3;
        }else{
            echo mysqli_num_rows($rezultat);
        }

        $veza ->zatvoriDB();
    }else{
        //DOHVAĆANJE SVIH PODATAKA
        $veza = new Baza();
        $veza -> spojiDB();
        $upit = "SELECT dnevnik_id, radnja, upit, datum_vrijeme, korisnik.ime as ime, korisnik.prezime as prezime,
                 tip.naziv as naziv FROM dnevnik, tip, korisnik WHERE tip.tip_id = dnevnik.tip_id AND dnevnik.korisnik_id = korisnik.korisnik_id";
        $rezultat = $veza -> selectDB($upit);
        $podaci = array();
        while($red = mysqli_fetch_array($rezultat)){
            $podaci[] = $red;
        }
        $veza -> zatvoriDB();
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="hr">

<head>
    <title>Dnevnik</title>
    <link rel="shortcut icon" href="../multimedija/logo.png" />
    <meta charset="UTF-8">
    <meta name="author" content="SD">
    <meta name="keywords" content="FOI, WebDiP, zadaća">
    <meta name="description" content="Primjer za meta podatke">
    <link href="../css/sdujakovi.css" rel="stylesheet" type="text/css" />
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
                echo "<form action='dnevnik.php' method='POST' ><div class='unos_podataka'>
                    <table>
                    <tr>
                        <td>Radnja</td>
                        <td>Upit</td>
                        <td>Vrijeme provođenja</td>
                    </tr>
                    <tr>
                        <td><input type='text' id='radnja' name='radnja' placeholder='Naziv radnje' value='{$radnja}'></td>
                        <td><input type='text' id='upit_p' name='upit_p' placeholder='SQL upit' value='{$upit_p}'></td>
                        <td><input type='datetime-local' id='vrijeme_provodenja'  name='vrijeme_provodenja' value='{$vrijeme_provodenja}'></td>
                    </tr>

                    <tr>
                    <td></td>
                    <td></td>
                    <td><input id='gumbovi' type='submit'name='{$dodaj_azuriraj}' placeholder='lozinka' value='{$dodaj_azuriraj}'>";
                    
                    if($dodaj_azuriraj === "Ažuriraj"){
                        echo "<input id='gumbovi' type='submit' name='odustani' value='Završi'>";
                    }
                    echo "</td>
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
                                <td>Radnja</td>
                                <td>Upit</td>
                                <td>Vrijeme provođenja</td>
                                <td>Ime korisnika</td>
                                <td>Tip radnje</td>
                                <td>Ukloni</td>
                                <td>Uredi</td>
                        </tr>`

            for (var i = 0; i < data.length; i++){    
                var id = data[i].dnevnik_id

                var row = `<tr><form action='' method='POST'>
                                <td><input type='hidden' name='id_brisanja' value=` + id + `>${data[i].dnevnik_id}</td>
                                <td>${data[i].radnja}</td>
                                <td>${data[i].upit}</td>
                                <td>${data[i].datum_vrijeme}</td>
                                <td>${data[i].ime}</td>
                                <td>${data[i].naziv}</td>
                                <td class='pobrisi'><a href='#' style='color: #2e95b8; font-size: 17px;'>Pobriši</a></td>
                                <td class='azuriraj'><a href='#' style='color: #2e95b8; font-size: 17px;'>Ažuriraj</a></td>
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