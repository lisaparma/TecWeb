<?php


require_once("structure.php");
require_once("functionHome.php");
require_once("connect.php");
require_once("classUtente.php");
require_once("classAzienda.php");
session_start();

$title = "Home - Jomp";
head($title);

echo "<body>";

headers();

menuHome();



searchForm("home.php");

if(isset($_POST['cerca'])) {
    	$title = $_POST['Title'];
        $city=$_POST['City'];
        $type=$_POST['Type'];
        $plus1="";
        $plus2="";
        
        if($city)
            $plus1=" AND Aziende.Citta='$city'";
        if($type!='all')
            $plus2=" AND Annunci.Tipologia='$type'";
        
        $result = mysqli_query(openDB(), "SELECT Annunci.Titolo, Annunci.Data, Annunci.Descrizione, Annunci.Azienda FROM Annunci JOIN Aziende ON Aziende.Nome=Annunci.Azienda WHERE Annunci.Descrizione LIKE '%$title%' $plus1 $plus2 ORDER BY Data DESC");
        
        
        if($result->num_rows) {
            echo "<div id='listannunci'>
                    <p>Risultati:</p>
                        <ul id='annunci'>";
                        printAdsHome($result);	
            echo "</ul>
                    </div>" ;       
        }
        else {
            echo "Nessun annuncio corrispondente";
        }
    }
else
    lastAds();


footer();
 
echo "</body> \n </html>";
?>