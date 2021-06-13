<?php
    session_start();
    $putanja = dirname($_SERVER['REQUEST_URI'],2);
    $direktorij = dirname(getcwd());
    include '../zaglavlje.php';

    
    
    if(isset($_POST['prihvati'])){
        setcookie("kolacici", 1, time() + (86400 * 2), '/', false);
        header("Location: registracija.php");
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



    $poruka=""; $ime = ""; $prezime="";$korisnicko_ime = ""; $email=""; $lozinka=""; $datum ="";$greska_lozinka = ""; $greska_kime =""; $greska_email ="";

    if(isset($_POST["user_name"])){
        $veza = new Baza();
        $veza -> spojiDB();
        $username = "'" . $_POST["user_name"] . "'";
        
        $upit = "SELECT * FROM korisnik WHERE korisnicko_ime = " . $username;

        $rezultat = $veza -> selectDB($upit);
        if($username == "''"){
            echo 3;
        }else{
            echo mysqli_num_rows($rezultat);
        }

        $veza ->zatvoriDB();
    }

    if(isset($_POST['registriraj'])){
            
            $poruka = "";
            $ime = $_POST["ime_korisnika"]; $prezime=$_POST["prezime_korisnika"];$korisnicko_ime = $_POST["korisnicko_ime_korisnika"];$email=$_POST["email_korisnika"]; $datum=$_POST["datum_rodenja_korisnika"];
            foreach($_POST as $k => $v){
                
                if(empty($v)){
                    $greska = "Niste popunili sva polja!";
                }elseif($k === "lozinka_korisnika"){

                    $uzorak = '/^(?!.*(.)\1{3})((?=.*[\d])(?=.*[A-Za-z])|(?=.*[^\w\d\s])(?=.*[A-Za-z])).{8,20}$/';
                    if(!preg_match($uzorak, $v)){
                        $greska_lozinka .= "Format lozinke nije valjan!"
                                . "<br>";
                    }elseif($k === "lozinka_korisnika"){
                        if($v !== $_POST["lozinka_ponovljena"]){
                            $greska_lozinka = "Kriva ponovljena lozinka!"
                                    . "<br>";
                        }
                    }    
                }elseif($k === "korisnicko_ime_korisnika"){
                    if((strlen($v) < 3) or (strlen($v > 10)) ){
                        $greska_kime = "Pripazite na duljinu korisničkog imena!"
                                . "<br>";
                    }
                }elseif($k === "email_korisnika"){
                    $uzorak = '/^\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b$/';
                    if(!preg_match($uzorak, $v)){
                        $greska_email = "Format e-maila nije valjan!"
                                . "<br>";
                    }
                }
            }

        if(empty($greska) and empty($greska_lozinka) and empty($greska_kime)){
            //if($_SESSION["captcha"] !== $_POST["captcha"]){
            //    $greska = "Krivi code!!";
            //}else{
                $veza = new Baza();
                $veza->spojiDB();

                $ime = $_POST['ime_korisnika'];
                $prezime = $_POST['prezime_korisnika'];
                $korisnicko_ime =$_POST['korisnicko_ime_korisnika'];
                $lozinka = $_POST['lozinka_korisnika'];
                $lozinkasha1 = sha1($lozinka);
                $email = $_POST['email_korisnika'];
                $datum = $_POST['datum_rodenja_korisnika'];
                
                    
                $upit = "INSERT INTO `korisnik` (`korisnik_id`, `ime`, `prezime`, `korisnicko_ime`, `datum_rodenja`, `lozinka`, `lozinka_sha1`, `email`, `uvjeti`, `zadnja_prijava`, `status`, `uloga_id`) 
                        VALUES (NULL, '{$ime}', '{$prezime}' , '{$korisnicko_ime}', '{$datum}', '{$lozinka}', '{$lozinkasha1}', '{$email}', '2020-04-08 00:00:00' , '2020-04-09 00:00:00', '1', '3')";
                $rezultat = $veza->updateDB($upit);
                $poruka = "Uspješna registracija!";   
                $veza->zatvoriDB();     
        //}
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
    <title>Registracija</title>
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
    <link href="~/content/captcha-plus.css" rel="stylesheet"/>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="~/content/captcha-plus.js" type="text/javascript"></script>
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
        </div>    
    </header>

    <div class="container">
        <a href="../index.php"><div class="sliding-background"></div></a>
    </div>

        

    <div class="sadrzaj">
        <h2>Registriraj se!</h2>
        <hr>
            <form novalidate id="form1" method="POST" name="prijava" action="<?php echo $_SERVER['PHP_SELF'];?>">
                
                <div style="text-align: center; font-size: 18px;">
                    <?php

                    echo    "<br><label for='imek'>Ime</label><br>
                            <input type='text' id='imek' name='ime_korisnika' placeholder='ime' value='{$ime}'><br><br>";

                    echo    "<label for='prezimek'>Prezime</label><br>
                            <input type='text' id='prezimek' name='prezime_korisnika' placeholder='prezime' value='{$prezime}'><br><br>";

                    echo    "<label for='korime'>Korisničko ime</label><br>
                            <input type='text' id='korime'  name='korisnicko_ime_korisnika' placeholder='korisničko ime' value='{$korisnicko_ime}'>
                            <span  style='visibility: visible;' class='tooltiptext'>{$greska_kime}</span>
                            <span  class='tooltiptext' id='dostupno'>Dostupno</span>
                            <span  class='tooltiptext' id='nedostupno'>Nedostupno</span><br>";           

                    echo    "<label for='godinak'>Datum rođenja</label><br>
                            <input class='unos' type='date' id='datumvrijeme' name='datum_rodenja_korisnika' value='{$datum}' ><br><br>";

                    echo    "<label for='emailk'>E-mail</label><br>
                            <input type='email' id='emailk' name='email_korisnika' placeholder='korisnik@email.com' value='{$email}'>
                            <span  style='visibility: visible;' class='tooltiptext' id='nedostupno'>{$greska_email}</span><br>";

                    echo    "<label for='lozinka'>Lozinka </label><br>
                            <input type='password' id='lozinka' name='lozinka_korisnika' placeholder='lozinka' value='{$lozinka}'>
                            <span  style='visibility: visible;' class='tooltiptext' id='nedostupno'>{$greska_lozinka}</span><br><br>";

                    echo    "<label for='lozinka'>Potvrdi lozinku </label><br>
                            <input type='password' id='plozinka' name='lozinka_ponovljena' placeholder='lozinka'
                            required='required'><br><br>";
                    
                    echo    "<p><img src='../captcha.php' alt='captcha image' id='captcha'><a style='color: black;' href='#' onclick='document.getElementById('captcha').src = '../captcha.php?' +
                                Math.random(); return false'>&#8634;</a><br/>
                                <input type='text' id='captcha' name='captcha' placeholder='Nisam robot!' maxlength='6'></p>
                            ";
                    
                    echo    "<div id='btn'><input id='gumbovi' class='input' type='submit' name='registriraj'
                            value='Registriraj se!'><br><br></div>";

                    if(isset($greska)){
                        echo "<label id='ispis_greske' style='color: red;'>{$greska}</label>";
                    }
                    ?>
                    
                    <span id="poruka" style="color: green;"></span><br>
                    </div>           
            </form>
        <hr> 
    </div>
       
    <script>
        document.cookie = "WebDiP=" + document.title + ";";
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