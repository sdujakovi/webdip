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

    
        $veza = new Baza();
        $veza -> spojiDB();

        $upit = "SELECT vrtic.vrtic_id, naziv, adresa, avg(ocjena) as prosjek FROM vrtic LEFT JOIN ocjena ON vrtic.vrtic_id = ocjena.vrtic_id GROUP BY 1";
        $rezultat = $veza -> selectDB($upit);

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
    <title>Popis vrtića</title>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
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

<div class="sadrzaj" style="margin-left: 5%; margin-right: 5%; margin-top: -2%">
    <section style="width: 100%">

    <h2>Popis vrtića i ocjena</h2>
    <hr>
    <?php if(isset($rezultat)){ ?>
    <table style="word-break: break;" id="tablica1" class="tabela" >
        <caption> </caption>
        
        <tbody>
        <tr>
                <td><b style="font-size: 17px;">ID</b></td>
                <td><b style="font-size: 17px;">Naziv vrtića</b></td>
                <td><b style="font-size: 17px;">Adresa vrtića</b></td>
                <td><b style="font-size: 17px;">Prosjek</b></td>  
                <td><b style="font-size: 17px;">Odabir</b></td>              

        </tr>
            <?php
                    while($red = mysqli_fetch_array($rezultat)){
                        echo    "<tr>"
                                . "<td>{$red['vrtic_id']}</td>"
                                . "<td>{$red['naziv']}</td>"
                                . "<td>{$red['adresa']}</td>"
                                . "<td>{$red['prosjek']}</td>"
                                . "<td class='odaberi'><a href='#' style='color: #2e95b8; font-size: 17px;'>Odaberi</a></td>"
                                . "</tr>";
                    }
            ?>
        </tbody>
    </table>
    <?php } ?>
    <hr>
    </section>
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