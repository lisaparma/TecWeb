<?php

require_once("structure.php");
require_once("functionHome.php");
require_once("connect.php");
require_once("classUtente.php");
require_once("classAzienda.php");
require_once("classAdmin.php");

session_start();

$title = "Aziende partner - Jomp";
$desc = "Visualizzazione di tutte le aziende registrate nel sito che offrono lavoro tranite annunci.";
head($title, $desc);

headers();

$page='Aziende partner';
breadcrumb(array($page));

function getCompany() {
	$result = mysqli_query(openDB(), "SELECT Nome, Citta, Email, Descrizione, Sito FROM Aziende ORDER BY Nome ASC");

	if(mysqli_num_rows($result) == 0) {
		echo "<div class='NoData'> Nessuna azienda si è ancora registrata. </div>";
	}

	else {
		echo"<ul>";
		while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			echo "<li class='sectionCompany'>
					<hr>
					<h3><strong>".$row['Nome']."</strong></h3>
					<ul>
						<li> <strong>Sede:</strong> ".$row['Citta']."</li>
						<li> <strong>Contatto:</strong> ".$row['Email']."</li>
						<li> <strong>Sito web: </strong> <a href='".$row['Sito']."'>".$row['Sito']."</a></li>
						<li>".$row['Descrizione']."</li>
					</ul>
					
				</li>";
		}
		echo"</ul>";
	}
}

echo "<div id='intro'>
		<h2>Aziende partner</h2>
		<p>Moltissime aziende appartenenti ai diversi settori lavorativi sono alla continua ricerca di personale. La nostra ampia raccolta di annunci ti permette di valutare quale lavoro sia più adatto alle tue esigenze e alle tue passioni. Qui potrai conoscere meglio le aziende proponenti e in che ambiente lavorativo ti si potrebbe presentare davanti.</p>
		<p>L'ordine in cui vengono presentate le aziende, segue quello alfabetico (non è stato applicato nessun criterio sulla valutazione dell'azienda o sul numero di annunci più seguiti dagli utenti).</p>
	</div>";
getCompany();



footer();
 
echo "</body> \n </html>";
?>