<?php
require_once('connexion_formulaire_ecole.php');

if(isset($_POST['btnEnvoyer'], $_POST['first_name'], $_POST['last_name'], $_POST['birthday'], $_POST['email'], $_POST['password'])){
    $request = $pdo->prepare("insert into user(first_name, last_name, birthday, email, password)".
    " values (:first_name, :last_name, :birthday, :email, :password)");
    
    unset($_POST['btnEnvoyer']);

    $_POST['password'] = md5($_POST['password']);
    $result = $request->execute($_POST);
    //var_dump($request->errorinfo());

    if($result === true && $request->rowCount() === 1){

        echo "<div style='color:green; font-weight:bold'>Utilisateur enregistré</di>";
    }else{

        echo "<div style='color:red; font-weight:bold'>Impossible d'enregistrer l'utilisateur</di>";
    }
}elseif($_POST){
    echo "<div style='color:red; font-weight:bold'>Information(s) manquante(s)</di>";
}

?>

<div>
<form action="" method="POST" style="width: 300px; height:200px; border: 1px solid #000; margin: 0 auto; padding: 10px">
    
    <div style="margin-bottom: 10px;">    
        <label for="first_name" >First Name :  </label>
        <input type="text" id="first_name" name="first_name">
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="last_name" >Last Name :  </label>
        <input type="text" id="last_name" name="last_name">
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="birthday" >Birthday :  </label>
        <input type="date" id="birthday" name="birthday">
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="email" >Email :  </label>
        <input type="email" id="email" name="email">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="password">Mot de passe : </label>
        <input type="password" id="password" name="password">
    </div>

    <div>
        <input type="submit" name="btnEnvoyer" value="Envoyer">
    </div>

</form>
<div style="text-align: center">
<a href="index.php">Se connecter</a>
</div>
</div>