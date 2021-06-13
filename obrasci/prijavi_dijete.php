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

    $ime = ""; $prezime="";$korisnicko_ime = ""; $vrtic=""; $javni_poziv=""; $datum ="";$dodaj_azuriraj = "Dodaj";

    if(isset($_POST["prijavi"])){
        $veza = new Baza();
        $veza -> spojiDB();

        $slika_put = "../multimedija/".basename($_FILES["slika"]["name"]);

        $slika = $_FILES["slika"]["name"];
        $ime = $_POST["ime"];
        $prezime = $_POST["prezime"];
        $vrtic = $_POST["vrtic"];
        $skupina = $_POST["skupina"];
        $javni_poziv = $_POST["javni_poziv"];

        $upit = "INSERT INTO dijete(dijete_id, ime, prezime, slika, skupina_id) VALUES (NULL, '{$ime}', '{$prezime}' , '{$slika}', '{$skupina}')";
        $rezultat = $veza -> updateDB($upit);
        $veza ->zatvoriDB();

        move_uploaded_file($_FILES["slika"]["tmp_name"], $slika_put);

    }

    function popuni_skupine(){
        $podaci = '';
        $veza = new Baza();
        $veza -> spojiDB();

        $upit = "SELECT * FROM skupina";
        $rezultat = $veza -> selectDB($upit);
        while($red = mysqli_fetch_array($rezultat)){
            $podaci .= '<option value="' .$red["skupina_id"]. ' - ' .$red["naziv"].'">' .$red["skupina_id"]. ' - ' .$red["naziv"].'</option>';
        }
        $veza ->zatvoriDB();

        return $podaci;
    }

    $veza = new Baza();
        $veza -> spojiDB();
        $upit = "SELECT javni_poziv_id, broj_mjesta, datum_od, datum_do, vrtic.naziv FROM `javni_poziv` LEFT JOIN vrtic ON vrtic.vrtic_id = javni_poziv.vrtic_id";
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
    <title>Prijavi dijete</title>
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
        
        
        <div class="sadrzaj" style="margin-left: 5%; margin-right: 5%; margin-top: -2%">
        <h2>Prijavi dijete</h2>
        <hr>
            <?php
            
            
            
            echo "<div class='desni_dio'>";
                echo "<form action='prijavi_dijete.php' method='POST' enctype='multipart/form-data'><div class='unos_podataka'>
                    <table>
                    <tr>
                        <td>Ime</td>
                        <td>Prezime</td>
                        <td>Vrtić</td>
                    </tr>
                    <tr>
                        <td><input type='text' id='imed' name='ime' placeholder='ime' value='{$ime}'></td>
                        <td><input type='text' id='prezimek' name='prezime' placeholder='prezime' value='{$prezime}'></td>
                        <td><input type='text' id='vrtic' name='vrtic' placeholder='Odaberi iz tablice!' value='{$vrtic}'></td>
                    </tr>
                    <tr>
                        <td class='par'>Skupina</td>
                        <td class='par'>Javni poziv</td>
                        <td class='par'>Slika</td>
                    </tr>
                    <tr>
                        <td><select name='skupina' id='moderator'>";
                        echo popuni_skupine();
                        echo "</select></td>
                        <td><input id='javni_poziv' name='javni_poziv' placeholder='Odaberi iz tablice!' value='{$javni_poziv}'></td>
                        <td><input type='file' name='slika' style='width:200px;'></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td><input id='gumbovi' type='submit'name='prijavi' placeholder='lozinka' value='Prijavi'>";
                    
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
                                <td>Naziv vrtića</td>
                                <td>Datum od</td>
                                <td>Datum do</td>
                                <td>Broj mjesta</td>
                                <td>Odabir</td>
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
                        <td>${data[i].javni_poziv_id}</td>
                        <td>${data[i].naziv}</td>
                        <td>${data[i].datum_od}</td>
                        <td>${data[i].datum_do}</td>
                        <td>${data[i].broj_mjesta}</td>
                        <td class='odaberi'><a style='color: #2e95b8; font-size: 17px;'>Odaberi</a></td>
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