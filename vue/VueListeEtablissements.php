<!-- Manque encore le php -->
<?php $titre = 'Liste des établissements';


require_once("$racine/modele/Gestion.php");
require_once("$racine/controleur/ControlesEtGestionErreurs.inc.php");
// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival 

ob_start();

?>
<table width='80%' cellpadding='0' cellspacing='0' align='center'>
   <tr>
      <td align='center'><a href='index.php'>Accueil > </a><a href='./?action=etablissement'>Consultation Etablissement</a>
   </tr>
</table>

<?php
// AFFICHER L'ENSEMBLE DES ÉTABLISSEMENTS
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR
// ÉTABLISSEMENT

?>
<br>
<table width='70%' cellspacing='0' cellpadding='0' align='center' class='tabNonQuadrille'>
   <tr class='enTeteTabNonQuad'>
      <td colspan='4'>Etablissements</td>
   </tr>

   <?php

   // remplacement des req par sql
   $sql = obtenirReqEtablissements();
   // $rsEtab=mysql_query($sql, $connexion); adaptation à la methode pdo
   $sth = connect()->query($sql);
   // $lgEtab=mysql_fetch_array($rsEtab); remplacement de tous les lgEtab par result
   $lgEtab = $sth->fetch(PDO::FETCH_ASSOC);
   // BOUCLE SUR LES ÉTABLISSEMENTS
   while ($lgEtab != FALSE) {
      $id = $lgEtab['id'];
      $nom = $lgEtab['nom'];

   ?>

      <tr class='ligneTabNonQuad'>
         <td width='52%'><?= $nom ?></td>

         <td width='16%' align='center'>
            <a href='./?action=DetailEtab' href='?id=<?= $id ?>'>
               Voir détail</a>
         </td>

         <td width='16%' align='center'>
            <a href='./?action=ModEtab' href ='?action=demanderModifEtab&amp;id=<?= $id ?>'>
               Modifier</a>
         </td>

         <?php
         // S'il existe déjà des attributions pour l'établissement, il faudra
         // d'abord les supprimer avant de pouvoir supprimer l'établissement
         if (!existeAttributionsEtab($connexion, $id)) {
         ?>
            <td width='16%' align='center'>
               <a href='./?action=SuppEtab' href ='?action=demanderSupprEtab&amp;id=<?= $id ?>'>
                  Supprimer</a>
            </td>

         <?php

         } else {
            $attribution = obtenirNbOccup($connexion, $id);

         ?>

            <td width='16%'>&nbsp;<?= $attribution ?> chambres</td>

         <?php

         }

         ?>

      </tr>

   <?php
      // $lgEtab=mysql_fetch_array($rsEtab);
      $lgEtab = $sth->fetch(PDO::FETCH_ASSOC);
   }

   ?>

   <tr class='ligneTabNonQuad'>
      <td colspan='4'><a href='./?action=CreatEtab' href ='?action=demanderCreEtab'>
            Création d'un établissement</a></td>
   </tr>
</table>

<?php

$contenu = ob_get_clean();
require "$racine/vue/VueTemplate.php";
?>