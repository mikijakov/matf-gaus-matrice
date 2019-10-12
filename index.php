<html>
    <head>
        <title>LAAG - Izračunaj rešenja iz matrice</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <div id="zaglavlje">
            <h1>Izračunaj rešenja sistema jednačina</h1>
        </div>
        <div id="info">
            <p>Unesi parametre jednačine u obliku da parametri stoje u razmaku od 1 space-a između. Parametre naredne jednačine uneti u nastavku na isti način.
            </p>
        </div>
        <form action="" method="post">
            <textarea name="matrica" id="matrica" rows="5" cols="40"></textarea>
            <input type="submit" name="izracunaj" id="izracunaj" value="Izračunaj">
        </form>
        <?php 
            if (isset($_POST["matrica"]))
            {
                $matrica_unos = $_POST["matrica"];
                $parametri = explode(" ", $matrica_unos);
                $broj_parametara_po_jednacini = 0;
                $broj_parametara_po_jednacini = floor(sqrt(count($parametri))); //bez ekvivalencije
                if($broj_parametara_po_jednacini != 0){
                    if($broj_parametara_po_jednacini * ($broj_parametara_po_jednacini + 1) == count($parametri)){
                        for($i = 0; $i < $broj_parametara_po_jednacini; $i++){
                            for($j = 0; $j < $broj_parametara_po_jednacini; $j++){
                                $matrica_parametri[$i][$j] = $parametri[($broj_parametara_po_jednacini + 1)*$i + $j];
                            }
                            $matrica_jednakosti[$i] = $parametri[($broj_parametara_po_jednacini + 1)*$i + $broj_parametara_po_jednacini];
                        }
                    }
                    else{
                        echo 'Netačan unos, pokušaj opet!';
                    }
                }
            }
            else {
                $matrica_unos = null;
            }
            require_once 'gausova_eliminacija.php';
            $gaus = new gausova_eliminacija();
            $resenja_niz = $gaus->izracunaj($matrica_parametri, $matrica_jednakosti);

        ?>
            <span id="rezultati">Rezultat: <?php if(is_string($resenja_niz)){echo $resenja_niz;} else{?><br> <?php foreach($resenja_niz as $broj => $resenje) {echo ' Resenje x'.$broj.' iznosi '.$resenje; echo "<br>";}}?></span>
        
        <div id="footer">
            <p>Copyright Mihailo Jakovljević @ <a href="nanotouch.co">Nanotouch</a> for <a href="http://www.matf.bg.ac.rs/">math.rs</p>
        </div>
    </body>
</html>