<?php
    echo
        "<ul>
            <li><a href='$putanja/obrasci/registracija.php'>Registracija</a></li>
            <li><a href='$putanja/popisi/popisivrtica.php'>Popis vrtića</a></li>
            <li><a href='$putanja/popisi/javnipozivi.php'>Javni pozivi</a></li>
            <li><a href='$putanja/dokumentacija.php'>Dokumentacija</a></li>
            <li><a href='$putanja/o_autoru.php'>O autoru</a></li>";
            
            if(isset($_SESSION['uloga']) && $_SESSION['uloga'] === "3"){
                echo "<li><a href='$putanja/obrasci/prijavi_dijete.php'>Prijavi dijete</a></li>";
            }
            if(isset($_SESSION['uloga']) && $_SESSION['uloga'] === "2"){
                echo "<li><a href='$putanja/moderator/moderacija.php'>Moderiraj</a></li>";
            }
            if(isset($_SESSION['uloga']) && $_SESSION['uloga'] === "1"){
                echo "<li><a href='$putanja/moderator/moderacija.php'>Moderiraj</a></li>";
                echo "<li><a href='$putanja/administrator/administracija.php'>Administracija</a></li>";
            }
            
    echo  "</ul>";

?>