<?php
require_once('connexion_formulaire_ecole.php');

$request =$pdo->query('select id,pays_fr from pays',PDO::FETCH_ASSOC);// code...

$result = $request->fetchall();

// on alimente la variable countries si le resultat ne nous renvoie pas false
// c'est que la requête s'est bien passée donc on retourne le resultat sinon un
// tableau vide
$countries = $result !== false ? $result : [];

  ?>

  <form>
      <select name="birth_country">
        <!--
        en bouclant sur option on crée autant de ligne qu'il ya de pays dans notre
        liste deroulante
        value => sera la valeur envoyée dans le post
        >XXXX</option> => XXXX le nom visible dans la liste deroulante de chaque pays
        -->
        <?php foreach($countries as $country): ?>
          <option value="<?= $country['id'] ?>">
            <?= $country['pays_fr'] ?>
          </option>
        <?php endforeach ?>
      </select>
  </form>
