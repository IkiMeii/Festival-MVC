<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
$titre="CreationEtablissement";
// include "$racine/vue/VueTemplate.php";
include_once "$racine/modele/Gestion.php";
include_once "$racine/controleur/controlesEtGestionErreurs.inc.php";

require "$racine/modele/bd.inc.php";

require "$racine/vue/VueCreationEtablissement.php";
