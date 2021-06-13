$(document).ready(function () {
    naslov = $(document).find("title").text();

    $('#tablica1').after('<div id="nav"></div>');
    //$('#trazi_naziv').on('keyup', function(){
    var rowsShown = 7;
    var rowsTotal = $('#tablica1 tbody tr').length;
    var numPages = rowsTotal / rowsShown;
    $('#nav').empty();
    for (i = 0; i < numPages; i++) {

        var pageNum = i + 1;
        $('#nav').append('<a class="stranice" href="#" rel="' + i + '">' + pageNum + '</a> ');
    }
    $('#tablica1 tbody tr').hide();
    $('#tablica1 tbody tr').slice(0, rowsShown).show();
    $('#nav a:first').addClass('active');
    $('#nav a').bind('click', function () {

        $('#nav a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#tablica1 tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
            css('display', 'table-row').animate({ opacity: 1 }, 300);
        //});
    });

    switch (naslov) {
        case "Registracija":
            $("#korime").keyup(function (event) {
                var username = $(this).val();
                $.ajax({
                    url: "../obrasci/registracija.php",
                    method: "POST",
                    data: { user_name: username },
                    success: function (data) {
                        if (data[0] === '3') {
                            $('#dostupno').css("visibility", "hidden");
                            $('#nedostupno').css("visibility", "hidden");
                            $('#korime').css("border-color", "mintcream");

                        } else if (data[0] != '0') {
                            $('#dostupno').css("visibility", "hidden");
                            $('#nedostupno').css("visibility", "visible");
                            $('#korime').css("border-color", "red");

                        } else {
                            $('#dostupno').css("visibility", "visible");
                            $('#nedostupno').css("visibility", "hidden");
                            $('#korime').css("border-color", "green");

                        }
                    }
                })
            });
            break;


        case "Korisnici":
            $(document).on("click", ".azuriraj", function () {
                var red = $(this).closest('tr');
                var id = red.find('td:eq(0)').text();
                document.cookie = "id=" + id + ";path=/";
                location.href = "../administrator/korisnici.php";
            });
            break;
        case "Dnevnik":
            $(document).on("click", ".azuriraj", function () {
                var red = $(this).closest('tr');
                var id = red.find('td:eq(0)').text();
                document.cookie = "id_a=" + id + ";path=/";
                location.href = "../administrator/dnevnik.php";
            });

            $(document).on("click", ".pobrisi", function () {
                var red = $(this).closest('tr');
                var id = red.find('td:eq(0)').text();
                document.cookie = "pobrisi=" + id + ";path=/";
                location.href = "../administrator/dnevnik.php";
            });
            break;

        case "Dodaj vrtić":
            naziv_v = document.getElementById("naziv");
            adresa_v = document.getElementById("adresa");
            moderator_t = document.getElementById("moderator");
            dodaj = document.getElementById("dodaj");
            azuriraj = document.getElementById("azuriraj");
            azuriraj.style.visibility = "hidden";


            $(document).on("click", ".azuriraj", function () {
                var red = $(this).closest('tr');
                var id = red.find('td:eq(0)').text();
                var naziv = red.find('td:eq(1)').text();
                var adresa = red.find('td:eq(2)').text();
                var moderator_id = red.find('td:eq(6)').text();


                dodaj.style.visibility = "hidden";
                azuriraj.style.visibility = "visible";

                naziv_v.innerHTML = naziv;
                naziv_v.setAttribute('value', naziv);

                adresa_v.innerHTML = naziv;
                adresa_v.setAttribute('value', adresa);

                document.cookie = "id=" + id + ";path=/";
                moderator_t.innerHTML += "<option selected value=''>" + moderator_id + "</option>";
            });

            $(document).on("click", ".pobrisi", function () {
                var red = $(this).closest('tr');
                var id = red.find('td:eq(0)').text();
                document.cookie = "pobrisi=" + id + ";path=/";
                location.href = "../administrator/administracija.php";
            });
            break;

        case "Vrtići":
            naziv_v = document.getElementById("naziv");


            $(document).on("click", ".ocijeni", function () {
                var red = $(this).closest('tr');
                var id = red.find('td:eq(0)').text();
                var naziv = red.find('td:eq(1)').text();

                naziv_v.innerHTML = naziv;
                naziv_v.setAttribute('value', naziv);

                document.cookie = "id=" + id + ";path=/";
            });

            $(document).on("click", ".pobrisi", function () {
                var red = $(this).closest('tr');
                var id = red.find('td:eq(0)').text();
                document.cookie = "pobrisi=" + id + ";path=/";
                location.href = "../administrator/administracija.php";
            });
            break;

        case "Prijavi dijete":
            javni_p = document.getElementById("javni_poziv");
            vrtic_p = document.getElementById("vrtic");


            $(document).on("click", ".odaberi", function () {
                var red = $(this).closest('tr');
                var vrtic = red.find('td:eq(1)').text();
                var javni_poziv = red.find('td:eq(0)').text();


                javni_p.innerHTML = javni_poziv;
                javni_p.setAttribute('value', javni_poziv);

                vrtic_p.innerHTML = vrtic;
                vrtic_p.setAttribute('value', vrtic);
            });

            $(document).on("click", ".pobrisi", function () {
                var red = $(this).closest('tr');
                var id = red.find('td:eq(0)').text();
                document.cookie = "pobrisi=" + id + ";path=/";
                location.href = "../administrator/administracija.php";
            });
            break;

        case "Popis vrtića":
            $(document).on("click", ".odaberi", function () {
                var red = $(this).closest('tr');
                var id = red.find('td:eq(0)').text();
                document.cookie = "id=" + id + ";path=/";
                location.href = "../popisi/galerija.php";
            });
            break;

        case "Kreiraj skupinu":
            naziv_s = document.getElementById("naziv");
            cijena_s = document.getElementById("mjesecna_cijena");
            dodaj = document.getElementById("dodaj");
            azuriraj = document.getElementById("azuriraj");
            azuriraj.style.visibility = "hidden";

            $(document).on("click", ".azuriraj", function () {
                var red = $(this).closest('tr');
                var id = red.find('td:eq(0)').text();
                var naziv = red.find('td:eq(1)').text();
                var cijena = red.find('td:eq(2)').text();
                document.cookie = "id=" + id + ";path=/";

                dodaj.style.visibility = "hidden";
                azuriraj.style.visibility = "visible";

                naziv_s.innerHTML = naziv;
                naziv_s.setAttribute('value', naziv);

                cijena_s.innerHTML = cijena;
                cijena_s.setAttribute('value', cijena);

                //location.href = "../moderator/moderacija.php";
            });

            $(document).on("click", ".pobrisi", function () {
                var red = $(this).closest('tr');
                var id = red.find('td:eq(0)').text();
                document.cookie = "pobrisi=" + id + ";path=/";
                location.href = "../moderator/moderacija.php";
            });
            break;

        case "Kreiraj javni poziv":
            broj_m = document.getElementById("broj_mjesta");
            datum_o = document.getElementById("datum_od");
            datum_d = document.getElementById("datum_do");
            azuriraj = document.getElementById("azuriraj");
            azuriraj.style.visibility = "hidden";

            $(document).on("click", ".azuriraj", function () {
                var red = $(this).closest('tr');
                var id = red.find('td:eq(0)').text();
                var broj_mjesta = red.find('td:eq(1)').text();
                var datum_od = red.find('td:eq(2)').text();
                var datum_do = red.find('td:eq(3)').text();

                document.cookie = "id=" + id + ";path=/";

                dodaj.style.visibility = "hidden";
                azuriraj.style.visibility = "visible";

                broj_m.innerHTML = broj_mjesta;
                broj_m.setAttribute('value', broj_mjesta);

                datum_o.innerHTML = datum_od;
                datum_o.setAttribute('value', datum_od);

                datum_d.innerHTML = datum_do;
                datum_d.setAttribute('value', datum_do);

                //location.href = "../moderator/moderacija.php";
            });

            $(document).on("click", ".pobrisi", function () {
                var red = $(this).closest('tr');
                var id = red.find('td:eq(0)').text();
                document.cookie = "pobrisi=" + id + ";path=/";
                location.href = "../moderator/kreiraj_javni_poziv.php";
            });
            break;
        default:
            break;
    }
})