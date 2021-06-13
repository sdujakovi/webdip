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

    $ime = ""; $prezime="";$korisnicko_ime = ""; $email=""; $lozinka=""; $datum ="";$dodaj_azuriraj = "Dodaj";

    if(isset($_POST["Dodaj"])){
        $veza = new Baza();
        $veza -> spojiDB();
        $ime = $_POST["ime_korisnika"];
        $prezime = $_POST["prezime_korisnika"];
        $korisnicko_ime = $_POST["korisnicko_ime_korisnika"];
        $datum = $_POST["datum_rodenja_korisnika"];
        $email = $_POST["email_korisnika"];
        $lozinka = $_POST["lozinka_korisnika"];

        $upit = "INSERT INTO korisnik (korisnik_id, ime, prezime, korisnicko_ime, datum_rodenja, email, lozinka) VALUES (NULL,'{$ime}','{$prezime}','{$korisnicko_ime}','{$datum}','{$email}','{$lozinka}')";
        $rezultat = $veza->updateDB($upit); 
        $veza->zatvoriDB();
    }

    if(isset($_POST["Ažuriraj"])){
        $veza = new Baza();
        $veza -> spojiDB();
        $id = $_COOKIE["id"];
        $ime = $_POST["ime_korisnika"];
        $prezime = $_POST["prezime_korisnika"];
        $korisnicko_ime = $_POST["korisnicko_ime_korisnika"];
        $datum = $_POST["datum_rodenja_korisnika"];
        $email = $_POST["email_korisnika"];
        $lozinka = $_POST["lozinka_korisnika"];

        $upit = "UPDATE korisnik SET ime = '{$ime}', prezime = '{$prezime}', korisnicko_ime = '{$korisnicko_ime}', datum_rodenja = '{$datum}', email = '{$email}', lozinka = '{$lozinka}' WHERE korisnik_id = '{$id}'";
        $rezultat = $veza->updateDB($upit); 
        $veza->zatvoriDB();
    }
    
    /*if(isset($_POST["odustani"])){
        setcookie("id", "-1", false, "/");
        $ime = ""; $prezime="";$korisnicko_ime = ""; $email=""; $lozinka=""; $datum ="";$dodaj_azuriraj = "Dodaj";
    }*/

    if(isset($_COOKIE["id"]) && ($_COOKIE["id"] !== '-1')){
        if(isset($_POST["odustani"])){
            setcookie("id", "-1", false, "/");
            $ime = ""; $prezime="";$korisnicko_ime = ""; $email=""; $lozinka=""; $datum ="";$dodaj_azuriraj = "Dodaj";
        }else{
            $veza = new Baza();
            $veza -> spojiDB();
            $id = "'" . $_COOKIE["id"] . "'";
            
            $upit = "SELECT * FROM korisnik WHERE korisnik_id = " . $id;
            $rezultat = $veza -> selectDB($upit);
            $red = mysqli_fetch_array($rezultat);
            $ime = $red["ime"];
            $prezime = $red["prezime"];
            $korisnicko_ime = $red["korisnicko_ime"];
            $datum = $red["datum_rodenja"];
            $email = $red["email"];
            $lozinka = $red["lozinka"];

            $dodaj_azuriraj = "Ažuriraj";
            $veza ->zatvoriDB();
        }
    }


    //BLOKIRANJE KORISNIKA
    if(isset($_GET["odblokiraj"])){
        $veza = new Baza();
        $veza -> spojiDB();
        $id = $_GET["id"];
        if($_GET["odblokiraj"] === "Blokiraj"){
            $upit = "UPDATE korisnik SET status = '0' WHERE korisnik_id = '{$id}'";
            $rezultat = $veza->updateDB($upit); 
            $veza->zatvoriDB();
        }elseif($_GET["odblokiraj"] === "Aktiviraj"){
            $upit = "UPDATE korisnik SET status = '1' WHERE korisnik_id = '{$id}'";
            $rezultat = $veza->updateDB($upit); 
            $veza->zatvoriDB();
        }
    }

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
        $upit = "SELECT * FROM korisnik";
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
    <title>Korisnici</title>
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
                echo "<form action='korisnici.php' method='POST' ><div class='unos_podataka'>
                    <table>
                    <tr>
                        <td>Ime</td>
                        <td>Prezime</td>
                        <td>Korisničko ime</td>
                    </tr>
                    <tr>
                        <td><input type='text' id='imek' name='ime_korisnika' placeholder='ime' value='{$ime}'></td>
                        <td><input type='text' id='prezimek' name='prezime_korisnika' placeholder='prezime' value='{$prezime}'></td>
                        <td><input type='text' id='korime'  name='korisnicko_ime_korisnika' placeholder='korisničko ime' value='{$korisnicko_ime}'></td>
                    </tr>
                    <tr>
                        <td class='par'>Datum rođenja</td>
                        <td class='par'>E-mail</td>
                        <td class='par'>Lozinka</td>
                    </tr>
                    <tr>
                        <td><input class='unos' type='date' id='datumvrijeme' name='datum_rodenja_korisnika' value='{$datum}'></td>
                        <td><input type='email' id='emailk' name='email_korisnika' placeholder='korisnik@email.com' value='{$email}'></td>
                        <td><input type='text' id='lozinka' name='lozinka_korisnika' placeholder='lozinka' value='{$lozinka}'></td>
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
                                <td>Ime</td>
                                <td>Prezime</td>
                                <td>Korisničko ime</td>
                                <td>Datum rođenja</td>
                                <td>Lozinka</td>
                                <td>Email</td>
                                <td>Status</td>
                                <td>Opcija</td>
                        </tr>`

            for (var i = 0; i < data.length; i++){
                if(data[i].status == 1){
                    var status = "Blokiraj"
                    var id = data[i].korisnik_id
                }else{
                    var status = "Aktiviraj"
                    var id = data[i].korisnik_id
                }

                var row = `<tr >
                                <td>${data[i].korisnik_id}</td>
                                <td>${data[i].ime}</td>
                                <td>${data[i].prezime}</td>
                                <td>${data[i].korisnicko_ime}</td>
                                <td>${data[i].datum_rodenja}</td>
                                <td>${data[i].lozinka}</td>
                                <td>${data[i].email}</td>
                                <td><a href='korisnici.php?odblokiraj=` + status +`&id=`+ id +`' id='odblokiraj' name='odblokiraj'>` + status + `</a></td>
                                <td class='azuriraj'><a href='#' style='color: #2e95b8'>Ažuriraj</a></td>
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