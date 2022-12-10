<?php $titre = 'Supprimer un établissement';

require_once("$racine/modele/Gestion.php");
require_once("$racine/modele/bd.inc.php");
require_once("$racine/controleur/ControlesEtGestionErreurs.inc.php");
// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival 


ob_start ();

// SUPPRIMER UN ÉTABLISSEMENT 

$id=$_REQUEST['id'];  

$lgEtab=obtenirDetailEtablissement($connexion, $id);
$nom=$lgEtab['nom'];

// Cas 1ère étape (on vient de listeEtablissements.php)

if ($_REQUEST['action']=='demanderSupprEtab')    
{

   ?>
   <br><center><h5>Souhaitez-vous vraiment supprimer l'établissement <?= $nom?>
   <br><br>
   <a href='./?action=SuppEtab' href ='?action=validerSupprEtab&amp;id=<?= $id?>'>
   Oui</a>&nbsp; &nbsp; &nbsp; &nbsp;
   <a href='./?action=etablissement'>Non</a></h5></center>

<?php
}

// Cas 2ème étape (on vient de suppressionEtablissement.php)

else
{
   supprimerEtablissement($connexion, $id);
   
   ?>
   <br><br><center><h5>L'établissement <?= $nom ?> a été supprimé</h5>
   <a href='./?action=etablissement'>Retour</a></center>

<?php
}
$contenu = ob_get_clean ();

require "$racine/vue/VueTemplate.php";

?>
