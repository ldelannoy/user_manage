<?php
require_once('connexion_formulaire_ecole.php');

$request =$pdo->query('select id,abbreviation_2 from pays',PDO::FETCH_ASSOC);// code...

$result = $request->fetchall();

// on alimente la variable countries si le resultat ne nous renvoie pas false
// c'est que la requête s'est bien passée donc on retourne le resultat sinon un
// tableau vide
$natio = $result !== false ? $result : [];

  ?>

  <form>
      <select name="nationality">
        <!--
        en bouclant sur option on crée autant de ligne qu'il ya de pays dans notre
        liste deroulante
        value => sera la valeur envoyée dans le post
        >XXXX</option> => XXXX le nom visible dans la liste deroulante de chaque pays
        -->
        <?php foreach($natio as $nat): ?>
          <option value="<?= $nat['id'] ?>">
            <?= $nat['abbreviation_2'] ?>
          </option>
        <?php endforeach ?>
      </select>
  </form>
