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
    $id = $_COOKIE["id"];
    setcookie("id", "", time() - (86400 * 2), '/', false);
    $upit = "SELECT * FROM dijete, skupina, vrtic WHERE dijete.skupina_id = skupina.skupina_id AND skupina.vrtic_id = vrtic.vrtic_id AND vrtic.vrtic_id = '{$id}'";
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
    <title>Galerija</title>
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

    <h2>Galerija</h2>
    <hr>
    <div class="unos_podataka">
            <input id="trazi_naziv" type="text" placeholder="Traži po imenu" autofocus>
                
            <table style="word-break: break; border:none;" id="tablica1" class="tabela" >
                <tbody id="body_tablica">
                </tbody>
            </table>
    </div>     
</div>

<script>
        var polje1 = <?php echo json_encode($podaci); ?>;
        
        

        buildTable(polje1);

        function buildTable(data){
            var table = document.getElementById('body_tablica')
            table.innerHTML = ``

            for (var i = 0; i < data.length; i += 3){    
                
                var slika = data[i].slika
                var ime = data[i].ime
                var prezime = data[i].prezime

                var slika2 = data[i+1].slika
                var ime2 = data[i+1].ime
                var prezime2 = data[i+1].prezime

                var slika3 = data[i+2].slika
                var ime3 = data[i+2].ime
                var prezime3 = data[i+2].prezime

                var row =   `<tr>
                                <td style="border: none;"><img style="width: 100px;" src='../multimedija/` + slika + `'><p>` + ime + ` ` + prezime + `</p></td>
                                <td style="border: none;"><img style="width: 100px;" src='../multimedija/` + slika2 + `'><p>` + ime2 + ` ` + prezime2 + `</p></td>
                                <td style="border: none;"><img style="width: 100px;" src='../multimedija/` + slika3 + `'><p>` + ime3 + ` ` + prezime3 + `</p></td>                                
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