<?php

require_once("structure.php");
require_once("connect.php");
require_once("classAdmin.php");
require_once("functionAdmin.php");

session_start();

$title = "Sezione Utenti- Jomp";
head($title);

headers();

$page = "Sezione Utenti";
breadcrumb(array('Area Personale', $page));

menu($page);

# ------------------------------------------------------

echo"<div id='contenuto'>";

//delete action
if(isset($_POST['delete'])) {
	$username = $_POST['delete'];

	$delete = "DELETE FROM Utenti WHERE Username='".$username."'";

	if(!mysqli_query(openDB(), $delete)) {
		echo "<div class='errorMsg'> Problemi con l'eliminizione dell'utente</div>";
	}
	else {
		echo "<div class='successMsg'> Rimozione dell'utente avvenuta con successo!</div>";
	}
}

$result = mysqli_query(openDB(), "SELECT * FROM Utenti WHERE Uso='utente' ORDER BY Cognome");

if(mysqli_num_rows($result) == 0) {
	echo "<div class='NoData'> Nessun utente ancora registrato.</div>";
}

else {
	echo "<h3>Ecco gli utenti che si sono registrati:</h3>
		<ul id='ModUtenti'>";
	
	while($row = $result->fetch_array(MYSQLI_ASSOC)) {
		echo "<li class='formMod'>
				<ul>
				<div class='inner-wrap'>
					<li><strong>Nome</strong>: ".$row['Cognome']." ".$row['Nome']."</li>
					<li><strong>Data di nascita</strong>: ".$row['Nascita']."</li>
					<li><strong>Email</strong>: ".$row['Email']."</li>
					<li><strong>Username</strong>: ".$row['Username']."</li>
					<li>Iscritto il ".$row['Iscrizione']."</li>
				</div>
				</ul>
				<div id='options'>
					<form method='post' action='AdminModUtenti.php'>
		            	<button value='".$row['Username']."'' name='delete'>Rimuovi</button>
	            	</form>
            	</div>
			</li>";
	}
	echo"</ul>";

}


# ------------------------------------------------------

echo"</div>";
footer();
 
echo "</body> \n </html>";

?>