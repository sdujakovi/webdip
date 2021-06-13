<?php
    $putanja = dirname($_SERVER['REQUEST_URI']);
    $direktorij = getcwd();

    include 'zaglavlje.php';

    if(isset($_GET['odjava'])){
        Sesija::obrisiSesiju();
    }

    if(isset($_POST['prihvati'])){
        setcookie("kolacici", 1, time() + (86400 * 2), '/', false);
        header("Location: index.php");
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
        <title>Dokumentacija</title>
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
                <?php
                include 'meni.php';
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
            <a href="index.php"><div class="sliding-background"></div></a>
        </div>

 
        <div class="sadrzaj"> 
            <h2>Opis projektnog zadatka</h2>
            <hr>
            <article style="margin-bottom: 40px;">
            <br>Projektni zadatak nam zadaje izradu sustava za upravljanje prijavama u programe dječijih vrtića
                i rangiranje dječijih vrtića prema uspješnosti. Zadatak je omogućiti jednom korisniku (administratoru)
                kreiranje dječijih vrtića i dodjelu moderatora dječijim vrtićima. Administrator nadzire sve funkcionalnosti
                sustava, te ocjenjuje svaki mjesec dječiji vrtić. Dodijeljeni voditelji dječijih vrtića kreiraju skupine, javne pozive,
                te upravljaju popisima prijava i evidencijom dolazaka djece u vrtić. Osim navedenih uloga, razlikujemo i roditelje, registrirane korisnike.
                Njima treba omogućit prijavu djece u vrtić i prihvaćanje prijava. Roditelji nadziru dolaske djece u vrtić i popis računa.
                Svaki korisnik koji nije registriran ima mogućnost pregleda popisa dječijih vrtića, pregleda galerije i pregleda javnih poziva.
            </article>
            <br>  
        </div>

        <div class="sadrzaj"> 
            <h2>Opis projektnog rješenja</h2>
            <hr style="height: 3px;">
            <article style="margin-bottom: 40px;">
            <br>Projektno rješenje prema projektnom zadatku omogućuje korisnicima pristup početnoj stranici koja pruža poveznice na stranice za prijavu,
                registraciju, popisa javnih poziva, popisa vrtića, informacija o autoru i dokumentaciji. U slučaju da se korisnik prijavi, ovisno o ulogama
                definiranim u projektnom zadatku, korisniku se pruža jedan dodatni link. U slučaju da se prijavi kao administrator, pruža mu se 
                link za administriranjem aplikacijom, u slučaju da se prijavi kao voditelj, omogućuje mu se pristup stranici za moderiranje vrtića.
            </article>
            <br>  
        </div>

        <div class="sadrzaj"> 
            <h2>Navigacijski dijagrami</h2>
            <hr style="height: 3px;">
            <br>
            <h3>Neregistrirani korisnik</h3><br>
            <img src="multimedija\navigacijski-neregistrirani.png" width="800">
            <br><br>
            <h3>Registrirani korisnik</h3><br>
            <img src="multimedija\navigacijski-roditelj.png" width="800">
            <br> <br>
            <h3>Voditelj</h3><br>
            <img src="multimedija\navigacijski-voditelj.png" width="800">
            <br><br>
            <h3>Administrator</h3><br>
            <img src="multimedija\navigacijski-administrator.png" width="800">
            <br>    
            <br>    
        </div>

        <div class="sadrzaj"> 
            <h2 >Shema baze podataka</h2>
            <hr style="height: 3px;">
            <img src="multimedija\sdujakovi-ERA.png" width="1200">
            <br>  
            <br>  
        </div>

        <div class="sadrzaj" > 
            <h2 >Popis i opis skripata i direktorija</h2>
            <hr style="height: 3px;">
            <article style="margin-bottom: 40px;">
            <br>Skripte korištene za izradu projekta podijeljene se u nekoliko kategorija. Kategorije preg_match
                prema kojima su podijeljene ovise o vrsti korisnika ali i namjeni skrpite. Tako razlikujemo sljedeće kategorije i direktorije:

                <ol ><br>
                        <li><b>administrator:</b> administracija.php, administrator_meni.php, djeca.php, dnevnik.php, konfiguracija.php, korisnici.php, vrtici.php</li><br>
                        <li><b>moderator:</b> kreiraj_javni_poziv.php, moderacija.php, moderator_meni.php</li><br>
                        <li><b>multimedija:</b> direktorij sa svim multimedijskim sadržajima</li><br>
                        <li><b>baza:</b> WebDiP2019x027.sql</li><br>        
                        <li><b>css:</b> sdujakovi.css</li><br>        
                        <li><b>JavaScript:</b> Javascript.js</li><br>
                        <li><b>obrasci:</b> prijava.php, prijavi_dijete.php, registracija.php</li><br>
                        <li><b>popisi:</b> galerija.php, javnipozivi.php, popisivrtica.php</li><br>
                        <li><b>korijenski direktorij:</b> baza.class.php, captcha.php, dokumentacija.php, index.php, Lemon.otf, meni.php, o_autoru.php, sesija.class.php, zaglavlje.php</li><br>
                </ol>

                U projektu nisu korištene vanjske biblioteke osim fonta za tekst captcha izraza. ovisno o funkcionalnosti
                pojedine skripte dodijeljeni su i nazivi.
            </article>
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