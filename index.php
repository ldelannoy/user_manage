<?php

session_start();
require_once('connexion_formulaire_ecole.php');

if(isset($_POST['btnEnvoyer'])){
    
    $email =$_POST['email'];
    $password =$_POST['password'];

        $request = $pdo->prepare('select * from user where email = :email limit 1');
        $result = $request->execute(['email'=> $email]);
        $user = $request->fetch(PDO::FETCH_ASSOC);

        if($user !== false && md5($password) === $user['password']){
        unset($user['password']);
        $_SESSION['user'] = $user;
        
        header('location: page_securisee.php');
        exit;
        }
    
    echo '<div style="font-weight: bold;color: #FF0000;">vos accés ne sont pas corrects</div>';

    }

?>

<div>
<form action="" method="POST" style="width: 300px; height:200px; border: 1px solid #000; margin: 0 auto; padding: 10px">
    
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
</div>