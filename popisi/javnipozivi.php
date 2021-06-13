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

    if(isset($_POST["naziv_vrtica"])){
        $veza = new Baza();
        $veza -> spojiDB();
        $naziv = "'" . $_POST["naziv_vrtica"] . "'";

        $upit = "SELECT javni_poziv_id, broj_mjesta, datum_od, datum_do, vrtic.naziv FROM `javni_poziv` LEFT JOIN vrtic ON vrtic.vrtic_id = javni_poziv.vrtic_id WHERE vrtic.naziv LIKE '{$naziv}'";
        $rezultat = $veza -> selectDB($upit);

        if($username == "''"){
            echo 3;
        }else{
            echo mysqli_num_rows($rezultat);
        }

        $veza ->zatvoriDB();
    }

    $veza = new Baza();
    $veza -> spojiDB();

    if(isset($_POST["filtriraj"])){   
        $datum_od = date("Y-m-d", strtotime($_POST["datum_od"]));
        $datum_do = date("Y-m-d", strtotime($_POST["datum_do"]));
        
        $upit = "SELECT javni_poziv_id, broj_mjesta, datum_od, datum_do, vrtic.naziv FROM `javni_poziv` LEFT JOIN vrtic ON vrtic.vrtic_id = javni_poziv.vrtic_id WHERE javni_poziv.datum_od > '{$datum_od}' AND javni_poziv.datum_do < '{$datum_do}'";
        $rezultat = $veza -> selectDB($upit);
        $podaci = array();

        while($red = mysqli_fetch_array($rezultat)){
            $podaci[] = $red;
        }
        $veza -> zatvoriDB();
    }elseif(isset($_POST["trazi"])){   
        $trazi = $_POST["naziv"];
        
        $upit = "SELECT javni_poziv_id, broj_mjesta, datum_od, datum_do, vrtic.naziv FROM `javni_poziv` LEFT JOIN vrtic ON vrtic.vrtic_id = javni_poziv.vrtic_id WHERE vrtic.naziv LIKE '%{$trazi}%'";
        $rezultat = $veza -> selectDB($upit);
        $podaci = array();

        while($red = mysqli_fetch_array($rezultat)){
            $podaci[] = $red;
        }
        $veza -> zatvoriDB();
    }else{
        $upit = "SELECT javni_poziv_id, broj_mjesta, datum_od, datum_do, vrtic.naziv FROM `javni_poziv` LEFT JOIN vrtic ON vrtic.vrtic_id = javni_poziv.vrtic_id";
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
    <title>Javni pozivi</title>
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
    <script src="../JavaScript/sdujakovi.js"></script>



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
    
    <h2>Javni pozivi</h2>
    <hr>

    <div class='desni_dio'>
    <form action='javnipozivi.php' method='POST' enctype='multipart/form-data'><div class='unos_podataka'>
        <table>
        <tr>
                <td>Datum od:</td>
                <td>Datum do:</td>
                <td></td>
                <td>Naziv:</td>
                <td></td>
            </tr>
            <tr>
                <td><input type="date" name="datum_od"></td>
                <td><input type="date" name="datum_do"></td>
                <td><input type="submit" name="filtriraj" value="Filtriraj"></td>
                <td><input type="text" name="naziv" placeholder="Naziv"></td>
                <td><input type="submit" name="trazi" value="Traži"></td>
                <td><input type="submit" name="reset" value="Ponovno postavi"></td>
            </tr>
        </table>
    </form>
    </div>

        <table style="word-break: break;" id="tablica1" class="tabela" >
            
            <tbody id="body_tablica">
            
            <?php
                    /*while($red = mysqli_fetch_array($rezultat)){
                        echo    "<tr>"
                                . "<td>{$red['javni_poziv_id']}</td>"
                                . "<td>{$red['naziv']}</td>"
                                . "<td>{$red['datum_od']}</td>"
                                . "<td>{$red['datum_do']}</td>"
                                . "<td>{$red['broj_mjesta']}</td>"
                                . "</tr>";
                    }*/
            ?>
            </tbody>
        </table>
    <hr>
    </section>
</div>

<script>
var myArray = <?php echo json_encode($podaci); ?>;

$('#trazi_naziv').on('keyup', function(){
                var value = $(this).val()
                console.log(value)

                var data = searchTable(value, myArray)
                console.log(data)
                buildTable(data)
            })

buildTable(myArray)

function searchTable(value, data){
    var filteredData = []

    for (var i = 0; i < data.length; i++){
        value = value.toLowerCase()
        var name = data[i].naziv.toLowerCase()

        if(name.includes(value)){
            filteredData.push(data[i])
        }
    }
    return filteredData
}

function buildTable(data){
    var table = document.getElementById('body_tablica')
    table.innerHTML = `<tr>
                    <th>ID</th>
                    <th>Naziv vrtića</th>
                    <th>Datum od</th>
                    <th>Datum do</th>  
                    <th>Broj mjesta</th>              
                </tr>`

    for (var i = 0; i < data.length; i++){


        var row = `<tr>
                        <td>${data[i].javni_poziv_id}</td>
                        <td>${data[i].naziv}</td>
                        <td>${data[i].datum_od}</td>
                        <td>${data[i].datum_do}</td>
                        <td>${data[i].broj_mjesta}</td>
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