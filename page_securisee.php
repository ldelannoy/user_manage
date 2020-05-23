<?php
session_start();

if(isset($_SESSION['user']) === false){
    header('location: index.php');
    exit;
}
if(isset($_GET['deco'])){
    unset($_SESSION['user']);
    header('location: index.php');  
    exit;
}

?>

<h1>Bienvenue <?=$_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name'] ?> sur la page de l'identité de l'élève</h1>
<?php
require_once('connexion_formulaire_ecole.php');

$id = $_GET['id'] ?? null;
$user=[];
  if($id){

      $request=$pdo->prepare('select * from users where id=:id limit 1');
      $result=$request->execute(
        ['id' => $id]
      );
      if($result){
        $user = $request->fetch();
        //echo '<pre>';
        //print_r($user);
        //exit;
      }
  }


if(isset($_POST['btnEnvoyer'], $_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['birthday'],$_POST['nationality'],$_POST['birth_country'],$_POST['birth_city'],$_POST['phone'],$_POST['mobile'], $_POST['email'])){


unset($_POST['btnEnvoyer']);

//echo '<pre>';
//print_r($_POST);
//exit; 
$data =  ['first_name' => $_POST['first_name'],
'last_name' => $_POST['last_name'],
'gender' => $_POST['gender'],
'birthday' => $_POST['birthday'],
'nationality' => $_POST['nationality'],
'birth_country' => $_POST['birth_country'],
'birth_city' => $_POST['birth_city'],
'phone' => $_POST['phone'],
'mobile' => $_POST['mobile'],
'email' => $_POST['email']
];   

if($id){
    $request =$pdo->prepare('update users set first_name= :first_name,last_name= :last_name,gender= :gender,birthday= :birthday,nationality= :nationality,birth_country= :birth_country,birth_city= :birth_city,phone= :phone,mobile= :mobile,email= :email where id= :id');// code...
    $data['id']= $id;    


}else{

$request =$pdo->prepare('insert into users (first_name,last_name,gender,birthday,nationality,birth_country,birth_city,phone,mobile,email) values (:first_name,:last_name,:gender,:birthday,:nationality,:birth_country,:birth_city,:phone,:mobile,:email)');// code...
    

}

$result = $request->execute($data);

if($result === true){
    header('location: edit.php');
}
}   
//echo '<pre>';
//print_r($_POST);
//exit;


 $request =$pdo->query('select id,pays_fr from pays',PDO::FETCH_ASSOC);// code...

$result = $request->fetchall();




// on alimente la variable countries si le resultat ne nous renvoie pas false
// c'est que la requête s'est bien passée donc on retourne le resultat sinon un
// tableau vide
$countries = $result !== false ? $result : [];

//pour la nationalité

$request =$pdo->query('select id,abbreviation_2 from pays',PDO::FETCH_ASSOC);// code...

$result = $request->fetchall();




// on alimente la variable countries si le resultat ne nous renvoie pas false
// c'est que la requête s'est bien passée donc on retourne le resultat sinon un
// tableau vide
$nation = $result !== false ? $result : [];

  
             
?>
<h2><b>Veuillez remplir le formulaire et valider les données</b></h2>
<div>
<form action="" method="POST" style=" margin: 1; padding: 10px">
    <fieldset>
        <legend>Elève</legend>
    <div style="margin-bottom: 10px;">    
        <label for="first_name" >Prénom :  </label>
        <input type="text" id="first_name" name="first_name" value="<?= $user['first_name'] ?? '' ?>">
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="last_name" >Nom :  </label>
        <input type="text" id="last_name" name="last_name" value="<?= $user['last_name'] ?? '' ?>">
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="gender" >Sexe :  </label>
        <input type="text" size="5px" id="gender" name="gender" value="<?= $user['gender'] ?? '' ?>">
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="birthday" >Birthday :  </label>
        <input type="date" id="birthday" name="birthday" value="<?= $user['birthday'] ?? '' ?>">
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="nationality" >Nationalité :  </label>

        <select name="nationality" >
        <!--
        en bouclant sur option on crée autant de ligne qu'il ya de pays dans notre
        liste deroulante
        value => sera la valeur envoyée dans le post
        >XXXX</option> => XXXX le nom visible dans la liste deroulante de chaque pays
        -->
        <?php foreach($nation as $natio): ?>
          <option value="<?= $natio['abbreviation_2'] ?>">
            <?= $natio['abbreviation_2'] ?>
          </option>
        <?php endforeach ?>
     </select>
    </div>
    <div style="margin-bottom: 10px;">  
      
        <label for="birth_country" >Pays de naissance :  </label>
        
     <select name="birth_country">
        <!--
        en bouclant sur option on crée autant de ligne qu'il ya de pays dans notre
        liste deroulante
        value => sera la valeur envoyée dans le post
        >XXXX</option> => XXXX le nom visible dans la liste deroulante de chaque pays
        -->
        <?php foreach($countries as $country): ?>
          <option value="<?= $country['pays_fr'] ?>">
            <?= $country['pays_fr'] ?>
          </option>
        <?php endforeach ?>
     </select>
  
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="birth_city" >Ville de naissance :  </label>
        <input type="text" id="birth_city" name="birth_city" value="<?= $user['birth_city'] ?? '' ?>">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="phone" >Tel :  </label>
        <input type="text" id="phone" name="phone" value="<?= $user['phone'] ?? '' ?>">
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="mobile" >GSM :  </label>
        <input type="text" id="mobile" name="mobile" value="<?= $user['mobile'] ?? '' ?>">
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="mobile" >Email :  </label>
        <input type="email" id="email" name="email" value="<?= $user['email'] ?? '' ?>">
    </div>
    
    </fieldset>
    
    <fieldset>
        <legend>Adresse</legend>
    <div style="margin-bottom: 10px;">    
        <label for="street" >Rue :  </label>
        <input type="text" id="street" name="address[street]">
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="number" >N° :  </label>
        <input type="int" id="number" name="address[number]">
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="box" >Bte :  </label>
        <input type="text" id="box" name="address[box]">
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="postcode" >CP :  </label>
        <input type="text" id="postcode" name="address[postcode]">
    </div>
    <div style="margin-bottom: 10px;">    
        <label for="city" >Ville :  </label>
        <input type="text" id="city" name="address[city]">
    </div>

    
    </fieldset>
    <div style="text-align: right;margin: 1; padding: 10px">
        <input type="submit" name="btnEnvoyer" value="Valider">
    </div>
 
</form>
</div>
<div style="padding: 10px">
<a href="?deco=true">Déconnexion</a>
<a href="edit.php">Editer</a>
</div>