<?php 
// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival 

ob_start();

?>
<br>
<table width='80%' cellspacing='0' cellpadding='0' align='center'>
   <tr>
      <td class='texteAccueil'>
         Cette application web permet de gérer l hébergement des groupes de musique
         durant le festival Folklores du Monde.
      </td>
   </tr>
   <tr>
      <td>&nbsp;
      </td>
   </tr>
   <tr>
      <td class='texteAccueil'>
         Elle offre les services suivants :
      </td>
   </tr>
   <tr>
      <td>&nbsp;
      </td>
   </tr>
   <tr>
      <td class='texteAccueil'>
         <ul>
            <li>Gérer les établissements (caractéristiques et capacités d accueil) acceptant d héberger les groupes de musiciens.
               <p>
               </p>
            <li>Consulter, réaliser ou modifier les attributions des chambres aux groupes dans les établissements.
         </ul>
      </td>
   </tr>
</table>
<?php

$contenu = ob_get_clean();
require "$racine/vue/VueTemplate.php";
?>