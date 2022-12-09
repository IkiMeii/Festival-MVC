<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/Gestion.php";

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = 'Accueil';
require "$racine/vue/VueAccueil.php";
