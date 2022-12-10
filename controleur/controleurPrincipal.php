<?php

function controleurPrincipal($action) {
    $lesActions = array();
    $lesActions["CreatEtab"] = "CreationEtablissement.php";



    $lesActions["accueil"] = "Accueil.php";
    $lesActions["etablissement"] = "ListeEtablissements.php";
    $lesActions["attribution"] = "ConsultationAttributions.php";

    $lesActions["DetailEtab"] = "DetailEtablissement.php";
    $lesActions["ModEtab"] = "ModificationEtablissement.php";
    $lesActions["SuppEtab"] = "SuppressionEtablissement.php";
    $lesActions["DonNbCham"] = "DonnerNbChambres.php";
    $lesActions["ModAtt"] = "ModificationAttributions.php";

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } 
    else {
        return $lesActions["accueil"];
    }
}

?>
