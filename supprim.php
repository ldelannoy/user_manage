<?php
require_once('connexion_formulaire_ecole.php');
$id=$_GET['id'] ?? null;

if ($id === null) {
  header('location: edit.php');
  exit;
}

$req=$pdo->prepare("delete from users where id= :id");

$result = $req->execute(['id' => $id]);
$count =$req->rowCount();

if ($result === true) {
  if ($count > 0){
    header('location: edit.php');
    exit;
  
}else {
echo "Un problème est survenu, impossible de supprimer un contact qui n'existe pas";  // code...

//echo $req ? "le contact n° $id est bien supprimé" : "Un problème est survenu, le contact n° $id n'a pas été supprimé";

}
}
 ?>
