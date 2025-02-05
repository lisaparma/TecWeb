<?php

require_once("structure.php");
require_once("functionUtente.php");
require_once("connect.php");
require_once("classUtente.php");
session_start();

$title = "Dashboard Utente - Jomp";
$desc = "Riepilogo delle attività dell'utente e delle informazioni utili per amministrare il proprio account.";
head($title, $desc);


headers();

$page = "Dashboard";
breadcrumb(array('Area Personale', $page));
menu($page);

# -------------------------------------------

if(isset($_SESSION['login'])){ // Solo se in sessione vedi questo 
    
    $user = $_SESSION['login'];
    
    echo"<div id='contenuto'>
                <h2> Benvenut";if($user->getSex() =='f') echo"a "; else echo"o "; echo "nella tua area personale, ".$user->getName()."!</h2>
                
            <h4> Ricapitoliamo i tuoi dati:</h4>
            <ul>
                <li> <strong> Nome: </strong>".$user->getName()."</li> 
                <li><strong> Cognome: </strong>".$user->getSurname()." </li> 
                <li><strong> Data di nascita: </strong>".$user->getBirth2()."</li> 
                <li><strong>Sesso: </strong>";
                if($user->getSex()=='f')
                    echo "donna</li>";
                else
                    echo "uomo</li>";
            echo"<li><strong>E-mail: </strong>".$user->getEmail()." </li> 
                <li><strong>Username: </strong>".$user->getUsername()." </li>
                <li><strong>Data di iscrizione: </strong>".$user->getLogin()."</li>
            </ul>";
    
    echo"  <h4> Ricerche salvate:</h4>
            <ul>
                <li> Numero ricerche salvate: ".$user->getNumLike()."</li>
                <li>La città in cui cerchi più lavoro è ".$user->getPrefCity()." con ".$user->getNumLikePrefCity()." annunci salvati.</li>
            </ul>
                
    </div>
    ";
    
}
else{
    echo " <div id='contenuto'>
               <div class='errorMsg'>Sessione scaduta, procedere con la riutenticazione.</div>
           </div>";
}

# -------------------------------------------

footer();
 
echo "</body> \n </html>";

?>