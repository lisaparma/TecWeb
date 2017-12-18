<?php

function menuHome() {
	echo "<ul id='menu'>
	        <li> <a href='AzDashboard.php'> Area Aziende </a> </li>
	        <li> <a href='UtDashboard.php'> Area Privati </a> </li>
	        <li> <a href=''> boh </a> </li>
	        <li> <a href=''> boh </a> </li>
	     </ul>" ;
}


function search() {
	echo "<div id='ricerca'> 
	        <form action='home.php' method='post'>
	            <fieldset id='fieldset'>
	                <legend>  Ricerca:</legend>

	                <div id='titolo'> 
	                    <label for='titolo'>Titolo:<br/></label>
	                    <input type='text' id='boxtitolo' name='Title' tabindex=''> <!--</input>-->
	                </div>

	                <div id='regione'> 
	                    <label for='citta'>Città:<br/></label>
	                    <input type='text' id='boxcitta' name='City' tabindex=''> <!--</input>-->
	                </div>

	                <div id='tipologia'> 
	                    <label for='titolo'>Tipologia:<br/></label>
	                    <select name='Type'>
	                    	<option disable selected value></option>
	                        <option value='Amministrazione'> Amministrazione </option>
                            <option value='Assistenza'> Assistenza anziani e/o disabili </option>
                            <option value='Contabilità'> Contabilità </option>
                            <option value='Direzione'> Direzione </option>
                            <option value='Edilizia'> Edilizia </option>
                            <option value='Estetica'> Estetica </option>
                            <option value='Formazione'> Formazione </option>
                            <option value='Marketing'> Marketing </option>
                            <option value='Medicina'> Medicina </option>
                            <option value='Produzione'> Produzione </option>
                            <option value='Ristorazione'> Ristorazione </option>
                            <option value='Sicurezza'> Sicurezza </option> 
                            <option value='Altro'> Altro </option>

	                    </select>
	                </div>

	            <input type='submit' id='cerca' value='Cerca' tabindex='' name='cerca'>
	            </fieldset>

	        </form>
	    </div>" ;
    
    if(isset($_POST['cerca'])) {
    	$title = $_POST['Title'];
        $city=$_POST['City'];
        $type=$_POST['Type'];
        $result = mysqli_query(openDB(), "SELECT * FROM Annunci JOIN Aziende ON Aziende.Nome=Annunci.Azienda WHERE Titolo LIKE '%$title%' OR Tipologia='$type' OR Citta='$city'");
        if($result) {
            echo "<div id='listannunci'>
                    <p>Risultati:</p>
                        <ul id='annunci'>";
                            while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                                echo "<li><h3>".$row['Titolo']."</h3>
                                        <p>Pubblicato il: ".$row['Data']."</p><br/>
                                        <p>Descrizione:<br/><p>".$row['Descrizione']."</p>
                                    </li>";
            }	
            echo "</ul>
                    </div>" ;       
        }
        else {
            echo "Nessun annuncio corrispondente";
        }
        return false;
    }
    else
    return true;
}


//prende gli ultimi 5 annunci che sono stati inseriti nel database
function lastAds() {
	$result = mysqli_query(openDB(), "SELECT * FROM Annunci ORDER BY Data DESC LIMIT 5");

	if($result) {
		echo "<div id='listannunci'>
		    	<p>Aggiunti di recente:</p>
		    		<ul id='annunci'>";
		while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo "<li><h3>".$row['Titolo']."</h3>
						<p>Pubblicato il: ".$row['Data']."</p><br/>
						<p>Descrizione:<br/><p>".$row['Descrizione']."</p>
				</li>";
		}	
		echo "</ul>
    			</div>" ;       
	}
	else {
		echo "Ancora nessun annuncio è stato pubblicato";
	}
}

?>