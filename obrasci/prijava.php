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


    if(isset($_POST['prijava'])){
        $greska = "";
        $poruka = "";


        foreach($_POST as $k => $v){
            if(empty($v)){
                $greska .= "Nije popunjeno: " . $k . "<br>";
            }
        }


        if(empty($greska)){
            //$poruka = "Nema greške";
            $veza = new Baza();
            $veza->spojiDB();

            $korime = $_POST['korisnicko_ime'];
            $lozinka = $_POST['lozinka'];
            $autenticiran = false;

            if(isset($_COOKIE[$korime])){
                $br_pokusaja = $_COOKIE[$korime];
            }else{
                $br_pokusaja = 0;
            }
            

            $upit_korisnik = "SELECT * FROM korisnik WHERE korisnicko_ime ='{$korime}'";
            $rezultat_korisnik = $veza->selectDB($upit_korisnik);
            $red = mysqli_fetch_array($rezultat_korisnik);
            $id = $red['korisnik_id'];

            if($red['status'] == 0){
                $greska = "Korisnik blokiran, kontaktirajte administratora!";
            }else{
                if($br_pokusaja < 3){
                    if(empty($rezultat_korisnik)){
                        $greska = "Korisničko ime ne postoji!";
                    }else{
                        $upit_autentikacija = "SELECT * FROM korisnik WHERE korisnicko_ime ='{$korime}' AND lozinka = '{$lozinka}'";
                        $rezultat_autentikacija = $veza->selectDB($upit_autentikacija);
    
                        if(!empty($rezultat_autentikacija)){
                            while($red = mysqli_fetch_array($rezultat_autentikacija)){
                                if($red){
                                    $autenticiran = true;
                                    $email = $red['email'];
                                    $tip = $red['uloga_id'];
                                    $dnevnik_korisnik = $red['korisnik_id'];
                                }
                            }
                            if($autenticiran){
                                setcookie("autenticiran", $korime, false, '/', false);
                                Sesija::kreirajKorisnika($korime, $tip);
                                $veza = new Baza();
                                $veza -> spojiDB();
                                
                                $vrijeme_provodenja = date('Y-m-d H:i:s');
                                
                                $dnevnik_upit = "INSERT INTO `dnevnik` VALUES (NULL, 'prijava', '-' , '{$vrijeme_provodenja}', '{$dnevnik_korisnik}', '1')";
                                $rezultat2 = $veza->updateDB($dnevnik_upit); 
                                $veza->zatvoriDB();
                                header("Location: ../index.php");
                            }else{
                                $greska = "Neuspješna prijava, pokušajte ponovo!";
                                if(isset($_COOKIE['korisnik'])){
                                    if($_COOKIE['korisnik'] !== $korime){
                                        setcookie($_COOKIE['korisnik'], '', time() - 3600,'/', false);
                                    }
                                }
                                setcookie($korime, $br_pokusaja + 1, false, '/', false);
                                setcookie('korisnik', $korime, false,'/', false);
                            }
                        }
                    }
                }else{
                    $upit = "UPDATE `korisnik` SET `status` = 0 WHERE `korisnik_id` = $id";
                    $rezultat = $veza->updateDB($upit);       
                }     
            }
           
          $veza->zatvoriDB();
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
    <title>Prijava</title>
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
    <script src="../vanjske_biblioteke/registracija.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LfQhwAVAAAAAOlBU0CAAPSjfbAigQw8Km6z0rJW"></script>


</head>



<body>

<header class="header">
   
      
<header>
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
        
        

        <div class="sadrzaj">
            <h2>Prijavi se!</h2>
            <hr>
            <form novalidate id="form1" method="POST" name="prijava_forma" action="<?php echo $_SERVER['PHP_SELF'];?>">
           
                    <div style="text-align: center; font-size: 18px;">
                        <?php
                        echo    "<br><br><label for='korisnicko_ime'>Ime</label><br>
                                <input type='text' id='korisnicko_ime' name='korisnicko_ime' placeholder='korisničko ime' value=''><br><br><br>";

                        echo    "<label for='lozinka'>Prezime</label><br>
                                <input type='password' id='lozinka' name='lozinka' placeholder='**********' value=''><br><br><br>";

                        

                        echo    "<div id='btn'><input id='gumbovi' class='input' type='submit' name='prijava'
                                value='Prijavi se!'></div>";
                        

                                if(isset($greska)){
                                    echo "<p>$greska</p>";
                                } 
                        ?>
                    
                    
                    
                        <span id="poruka" style="color: green;"></span><br>
                    </div>
            </form>
            <hr>  
        </div>
        
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