<?php
    $putanja = dirname($_SERVER['REQUEST_URI']);
    $direktorij = getcwd();

    include 'zaglavlje.php';

    if(isset($_GET['odjava'])){
        $veza = new Baza();
        $veza -> spojiDB();
        
        $korisnik_dnevnik =  "'" .$_COOKIE["autenticiran"]."'";
        setcookie("autenticiran", "", time() - (86400 * 2), '/', false);
        $upit = "SELECT * FROM korisnik WHERE korisnicko_ime = " . $korisnik_dnevnik;
        $rezultat = $veza -> selectDB($upit);
        $red = mysqli_fetch_assoc($rezultat);

        $dnevnik_korisnik = $red["korisnik_id"];
        $vrijeme_provodenja = date('Y-m-d H:i:s');
        
        
        
        $dnevnik_upit = "INSERT INTO `dnevnik` VALUES (NULL, 'odjava', '-' , '{$vrijeme_provodenja}', '{$dnevnik_korisnik}', '1')";
        $rezultat2 = $veza->updateDB($dnevnik_upit); 
        $veza->zatvoriDB();
        Sesija::obrisiSesiju();
        header("Location: index.php");

    }

    if(isset($_POST['prihvati'])){
        setcookie("kolacici", 1, time() + (86400 * 2), '/', false);
        header("Location: index.php");

        if (!isset($_COOKIE["kolacici"])){

            echo "<div id='cookie_disclaimer' class='fixed'>
                    <form method='POST' name='prihvati_kolacice' action='#'>
                        <p>Radi kvalitetnijeg rada aplikacije, prihvatite kolačiće!</p>
                        <div id='btn'><input id='kolacici' class='input' type='submit' name='prihvati'
                                value='Prihvaćam!'></div>
                    </div>
                </div>";
        }
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
        <title>Početna stranica</title>
        <link rel="shortcut icon" href="multimedija/vrtic_logo_exp2.png" />
        <meta charset="UTF-8">
        <meta name="author" content="SD">
        <meta name="keywords" content="FOI, WebDiP, zadaća">
        <meta name="description" content="Primjer za meta podatke">
        <link href="css/sdujakovi.css" rel="stylesheet" type="text/css" />
        <link href="css/sdujakovi_prilagodbe.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" media="print" href="CSS/sdujakovi_ispis.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&display=swap" rel="stylesheet"> 
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <script src="JavaScript/Javascript.js"></script>

    </head>

    <?php
        if (!isset($_COOKIE["kolacici"])){

        echo "<div id='cookie_disclaimer' class='fixed'>
                <form method='POST' name='prihvati_kolacice' action='#'>
                    <p>Radi kvalitetnijeg rada aplikacije, prihvatite kolačiće!</p>
                    <div id='btn'><input id='kolacici' class='input' type='submit' name='prihvati'
                            value='Prihvaćam!'></div>
                </div>
            </div>";
    }
    ?>


    <body>
        <header>
            <div class="naslov"><a>Moj vrtić</a></div>
            <div class="pretraga">
                <div class="meni">
                <ul>
                    <li><a href='obrasci/registracija.php'>Registracija</a></li>
                    <li><a href='popisi/popisivrtica.php'>Popis vrtića</a></li>
                    <li><a href='popisi/javnipozivi.php'>Javni pozivi</a></li>
                    <li><a href='dokumentacija.php'>Dokumentacija</a></li>
                    <li><a href='o_autoru.php'>O autoru</a></li>
                    <?php 
                    if(isset($_SESSION['uloga']) && $_SESSION['uloga'] === "1"){
                        echo "<li><a href='$putanja/administrator/administracija.php'>Administracija</a></li>";
                        echo "<li><a href='$putanja/moderator/moderacija.php'>Moderiraj</a></li>";
                    }
                    if(isset($_SESSION['uloga']) && $_SESSION['uloga'] === "2"){
                        echo "<li><a href='$putanja/moderator/moderacija.php'>Moderiraj</a></li>";
                    }
                    ?>
                </ul>
                </div> 
                <div class="prijava_odjava">
                    <?php
                        if(isset($_SESSION['uloga'])){
                            echo '<a id="prijava_odjava" href="index.php?odjava=true">Odjava</a>';
                        }else{
                            echo '<a id="prijava_odjava" href="obrasci/prijava.php">Prijava</a>';
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
            <a href="index.php"><div class="sliding-background"></div></a>
        </div>

        <hr>   

        <div class="sadrzaj"> 
            
            <article><h2>O web aplikaciji: </h2>
            <br>Projektno rješenje prema projektnom zadatku omogućuje korisnicima
             pristup početnoj stranici koja pruža poveznice na stranice za prijavu,
              registraciju, popisa javnih poziva, popisa vrtića, informacija o autoru
               i dokumentaciji. U slučaju da se korisnik prijavi, ovisno o ulogama definiranim
                u projektnom zadatku, korisniku se pruža jedan dodatni link. U slučaju da se
                 prijavi kao administrator, pruža mu se link za administriranjem aplikacijom,
                  u slučaju da se prijavi kao voditelj, omogućuje mu se pristup stranici za
                   moderiranje vrtića.

            </article>
            <br>  
        </div>
        <hr>
        <div class="autor">
            
            <ol id="podaciStudenta">
                <h2>O autoru stranice: </h2>
                <br>
                <li class="tooltip">Autor: Stanko Dujaković</li>
                <li class="tooltip">E-mail: <a style="color: black;"href="mailto:sdujakovi@foi.hr ">sdujakovi@foi.hr</a></li>
                <li class="tooltip">Indeks: 00161314536</li>
                <br>
                <img src="multimedija/index.jpeg" style="border-radius: 50%; width: 20%; padding-top: 10px"
                alt="" /><br><br>
            </ol>
            <br>
        </div>

        
            <footer>
                <address> Kontakt: <a id="l" href="mailto:sdujakovi@foi.hr ">Stanko Dujaković</a><br>
                    <small>&copy; 2020. S. Dujaković</small><br>
                    <a href="http://validator.w3.org/check?url=http://barka.foi.hr/WebDiP/2019/zadaca_01/sdujakovi/index.html"
                        target="_blank">
                    <img src="multimedija/HTML5.png" alt="" width="23" /></a>
                    <a href="http://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2019/zadaca_01/sdujakovi/CSS/sdujakovi1.css"
                        target="_blank">
                    <img src="multimedija/CSS3.png" alt="" width="25" /></a>
                </address>
            </footer>
    </body>
</html>