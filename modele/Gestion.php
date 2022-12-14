
<?php

// FONCTIONS DE CONNEXION
// utilisation de la methode pdo 

function connect()
{
   //$hote="localhost";
   $login = "root";
   $mdp = "root";
   //return mysql_connect($hote, $login, $mdp);
   $dsn = 'mysql:host=localhost;dbname=festival';
   try {
      $dbh = new PDO($dsn, $login, $mdp);
      $dbh->exec("set names utf8"); //commande coder en utf8
      return $dbh;
   } catch (PDOException $e) {
      print "Erreur! :" . $e->getMessage() . "<br/>";
      die();
   }
}

function selectBase($connexion) 
{
   $bd="festival"; //anciennement abdelfest 
   $query="SET CHARACTER SET utf8";
   // Modification du jeu de caractères de la connexion
   // $res=mysql_query($query, $connexion); 
   // $res=connect()->query($query);
   // $ok=mysql_select_db($bd, $connexion);
   $ok= $connexion->query($query);
   return $ok;
}

// FONCTIONS DE GESTION DES ÉTABLISSEMENTS

// on adapte les requetes 

function obtenirReqEtablissements()
{
   $sql="SELECT id, nom 
   from Etablissement 
   order by id";
   return $sql;
}

/*function obtenirReqEtablissements()
{
   $req="select id, nom from Etablissement order by id";
   return $req;
}*/

function obtenirReqEtablissementsOffrantChambres()
{
   $sql="SELECT id, nom, nombreChambresOffertes 
   from Etablissement 
   where nombreChambresOffertes!=0 
   order by id";
   return $sql;
}

function obtenirReqEtablissementsAyantChambresAttribuées()
{
   $sql="SELECT distinct id, nom, nombreChambresOffertes 
   from Etablissement, Attribution 
   where id = idEtab 
   order by id";
   return $sql;
}

function obtenirDetailEtablissement($connexion, $id)
{
   $sql="SELECT * 
   from Etablissement 
   where id='$id'";
   // $rsEtab=mysql_query($req, $connexion);
   $rsEtab=$connexion->query($sql);
   // return mysql_fetch_array($rsEtab);
   return $rsEtab->fetch(PDO::FETCH_ASSOC);
}

function supprimerEtablissement($connexion, $id)
{
   $sql="DELETE 
   from Etablissement 
   where id='$id'";
   return $connexion->query($sql); // manque le return
}
 
function modifierEtablissement($connexion, $id, $nom, $adresseRue, $codePostal, 
                               $ville, $tel, $adresseElectronique, $type, 
                               $civiliteResponsable, $nomResponsable, 
                               $prenomResponsable, $nombreChambresOffertes)
{  
   $nom=str_replace("'", "''", $nom);
   $adresseRue=str_replace("'","''", $adresseRue);
   $ville=str_replace("'","''", $ville);
   $adresseElectronique=str_replace("'","''", $adresseElectronique);
   $nomResponsable=str_replace("'","''", $nomResponsable);
   $prenomResponsable=str_replace("'","''", $prenomResponsable);
  
   $sql="update Etablissement set nom='$nom',adresseRue='$adresseRue',
         codePostal='$codePostal',ville='$ville',tel='$tel',
         adresseElectronique='$adresseElectronique',type='$type',
         civiliteResponsable='$civiliteResponsable',nomResponsable=
         '$nomResponsable',prenomResponsable='$prenomResponsable',
         nombreChambresOffertes='$nombreChambresOffertes' where id='$id'";
   
   // mysql_query($req, $connexion);
   $connexion->query($sql);
}

function creerEtablissement($connexion, $id, $nom, $adresseRue, $codePostal, 
                            $ville, $tel, $adresseElectronique, $type, 
                            $civiliteResponsable, $nomResponsable, 
                            $prenomResponsable, $nombreChambresOffertes)
{ 
   $nom=str_replace("'", "''", $nom);
   $adresseRue=str_replace("'","''", $adresseRue);
   $ville=str_replace("'","''", $ville);
   $adresseElectronique=str_replace("'","''", $adresseElectronique);
   $nomResponsable=str_replace("'","''", $nomResponsable);
   $prenomResponsable=str_replace("'","''", $prenomResponsable);
   
   $sql="insert into Etablissement values ('$id', '$nom', '$adresseRue', 
         '$codePostal', '$ville', '$tel', '$adresseElectronique', '$type', 
         '$civiliteResponsable', '$nomResponsable', '$prenomResponsable',
         '$nombreChambresOffertes')";
   
   // mysql_query($req, $connexion);
   $connexion->query($sql);
}


function estUnIdEtablissement($connexion, $id)
{
   $sql="select * from Etablissement where id='$id'";
   // $rsEtab=mysql_query($req, $connexion);
   $rsEtab=$connexion->query($sql);
   // return mysql_fetch_array($rsEtab);
   return $rsEtab->fetch(PDO::FETCH_ASSOC);
}

function estUnNomEtablissement($connexion, $mode, $id, $nom)
{
   $nom=str_replace("'", "''", $nom);
   // S'il s'agit d'une création, on vérifie juste la non existence du nom sinon
   // on vérifie la non existence d'un autre établissement (id!='$id') portant 
   // le même nom
   if ($mode=='C')
   {
      $sql="select * from Etablissement where nom='$nom'";
   }
   else
   {
      $sql="select * from Etablissement where nom='$nom' and id!='$id'";
   }
   // $rsEtab=mysql_query($req, $connexion);
   $rsEtab=$connexion->query($sql);
   // return mysql_fetch_array($rsEtab);
   return $rsEtab->fetch(PDO::FETCH_ASSOC);
}

function obtenirNbEtab($connexion)
{
   $sql="select count(*) as nombreEtab from Etablissement";
   // $rsEtab=mysql_query($req, $connexion);
   $rsEtab=$connexion->query($sql);
   // $lgEtab=mysql_fetch_array($rsEtab);
   $lgEtab=$rsEtab->fetch(pdo::FETCH_ASSOC);
   return $lgEtab["nombreEtab"];
}

function obtenirNbEtabOffrantChambres($connexion)
{
   $sql="select count(*) as nombreEtabOffrantChambres from Etablissement where 
         nombreChambresOffertes!=0";
   // $rsEtabOffrantChambres=mysql_query($req, $connexion);
   $rsEtabOffrantChambres=$connexion->query($sql);
   // $lgEtabOffrantChambres=mysql_fetch_array($rsEtabOffrantChambres);
   $lgEtabOffrantChambres=$rsEtabOffrantChambres->fetch(pdo::FETCH_ASSOC);
   return $lgEtabOffrantChambres["nombreEtabOffrantChambres"];
}

// Retourne false si le nombre de chambres transmis est inférieur au nombre de 
// chambres occupées pour l'établissement transmis 
// Retourne true dans le cas contraire
function estModifOffreCorrecte($connexion, $idEtab, $nombreChambres)
{
   $nbOccup=obtenirNbOccup($connexion, $idEtab);
   return ($nombreChambres>=$nbOccup);
}

// FONCTIONS RELATIVES AUX GROUPES

function obtenirReqIdNomGroupesAHeberger()
{
   $sql="SELECT id, nom 
   from Groupe 
   where hebergement='O' 
   order by id";
   return $sql;
}

function obtenirNomGroupe($connexion, $id)
{
   $sql="select nom from Groupe where id='$id'";
   // $rsGroupe=mysql_query($req, $connexion);
   $rsGroupe=$connexion->query($sql);
   // $lgGroupe=mysql_fetch_array($rsGroupe);
   $lgGroupe=$rsGroupe->fetch(pdo::FETCH_ASSOC);
   return $lgGroupe["nom"];
}

// FONCTIONS RELATIVES AUX ATTRIBUTIONS

// Teste la présence d'attributions pour l'établissement transmis    
function existeAttributionsEtab($connexion, $id)
{
   $sql="SELECT * 
   From Attribution 
   where idEtab ='$id'";
   // $rsAttrib=mysql_query($req, $connexion);
   $rsAtrrib=$connexion->query($sql); 
   // return mysql_fetch_array($rsAttrib);
   return $rsAtrrib->fetch(PDO::FETCH_ASSOC);
}

/*function existeAttributionsEtab($connexion, $id)
{
   $req="select * From Attribution where idEtab='$id'";
   $rsAttrib=mysql_query($req, $connexion);
   return mysql_fetch_array($rsAttrib);
}
*/

// Retourne le nombre de chambres occupées pour l'id étab transmis
function obtenirNbOccup($connexion, $idEtab)
{
   $sql="select IFNULL(sum(nombreChambres), 0) as totalChambresOccup from
        Attribution where idEtab='$idEtab'";
   // $rsOccup=mysql_query($req, $connexion);
   $rsOccup=$connexion->query($sql);
   // $lgOccup=mysql_fetch_array($rsOccup);
   $lgOccup=$rsOccup->fetch(pdo::FETCH_ASSOC);
   return $lgOccup["totalChambresOccup"];
}

// Met à jour (suppression, modification ou ajout) l'attribution correspondant à
// l'id étab et à l'id groupe transmis
function modifierAttribChamb($connexion, $idEtab, $idGroupe, $nbChambres)
{
   $sql="select count(*) as nombreAttribGroupe from Attribution where idEtab=
        '$idEtab' and idGroupe='$idGroupe'";
   // $rsAttrib=mysql_query($req, $connexion);
   $rsAttrib=$connexion->query($sql);
   // $lgAttrib=mysql_fetch_array($rsAttrib);
   $lgAttrib=$rsAttrib->fetch(pdo::FETCH_ASSOC);

   if ($nbChambres==0)
      $sql="delete from Attribution where idEtab='$idEtab' and idGroupe='$idGroupe'";
   else
   {
      if ($lgAttrib["nombreAttribGroupe"]!=0)
         $sql="update Attribution set nombreChambres=$nbChambres where idEtab=
              '$idEtab' and idGroupe='$idGroupe'";
      else
         $sql="insert into Attribution values('$idEtab','$idGroupe', $nbChambres)";
   }
   // mysql_query($req, $connexion);
   $connexion->query($sql);
}

// Retourne la requête permettant d'obtenir les id et noms des groupes affectés
// dans l'établissement transmis
function obtenirReqGroupesEtab($id)
{
   $sql="select distinct id, nom from Groupe, Attribution where 
        Attribution.idGroupe=Groupe.id and idEtab='$id'";
   return $sql;
}
            
// Retourne le nombre de chambres occupées par le groupe transmis pour l'id étab
// et l'id groupe transmis
function obtenirNbOccupGroupe($connexion, $idEtab, $idGroupe)
{
   $sql="select nombreChambres From Attribution where idEtab='$idEtab'
        and idGroupe='$idGroupe'";
   // $rsAttribGroupe=mysql_query($req, $connexion);
   $rsAttribGroupe=$connexion->query($sql);
   // if ($lgAttribGroupe=mysql_fetch_array($rsAttribGroupe))
   if ($lgAttribGroupe=$rsAttribGroupe->fetch(PDO::FETCH_ASSOC))
      return $lgAttribGroupe["nombreChambres"];
   else
      return 0;
}

