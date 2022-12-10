<?php $titre = 'Nombre de Chambre';

require_once("$racine/modele/Gestion.php");
require_once("$racine/modele/bd.inc.php");
require_once("$racine/controleur/ControlesEtGestionErreurs.inc.php");
// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival 


ob_start ();

// SÉLECTIONNER LE NOMBRE DE CHAMBRES SOUHAITÉES

$idEtab=$_REQUEST['idEtab'];
$idGroupe=$_REQUEST['idGroupe'];
$nbChambres=$_REQUEST['nbChambres'];

?>

<form method='POST' action='./?action=ModAtt'>
	<input type='hidden' value='validerModifAttrib' name='action'>
   <input type='hidden' value='<?=$idEtab?>' name='idEtab'>
   <input type='hidden' value='<?=$idGroupe?>' name='idGroupe'>

   <?php $nomGroupe=obtenirNomGroupe($connexion, $idGroupe); ?>
   
   
   <br><center><h5>Combien de chambres souhaitez-vous pour le 
   groupe <?= $nomGroupe?> dans cet établissement ?
   
   &nbsp;<select name='nbChambres'>

   <?php

   for ($i=0; $i<=$nbChambres; $i++)
   {
      ?>
      <option><?=$i?></option>

   <?php
   }

   ?>
   </select></h5>
   <input type='submit' value='Valider' name='valider'>&nbsp&nbsp&nbsp&nbsp
   <input type='reset' value='Annuler' name='Annuler'><br><br>
   <a href='./?action=ModAtt' href='?action=demanderModifAttrib'>Retour</a>
   </center>
</form>

<?php 

$contenu = ob_get_clean ();

require "$racine/vue/VueTemplate.php";

?>
