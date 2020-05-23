<?php
require_once('connexion_formulaire_ecole.php');
?>
<h1>Listing élèves</h1><br>

    <style>
      table{
          width: 100%;
          border: 2px solid #CCC;
        }
      th {
        background: #CCC;
        color: white;
      }
      .text-right{
        text-align: right;
        padding-right: 20px;
      }


    </style>
  </div>
    <div>  
      <table>
      <tr>
        <th>ID</th>  
        <th>Prénom  </th>
        <th>Nom  </th>
        <th>Sexe  </th>
        <th>Date de naissance </th>
        <th >Nationalité </th>
        <th >Pays de naissance </th>
        <th>Ville de naissance</th>
        <th>Tel</th>
        <th>Gsm</th>
        <th>Email</th>
      </tr>
    </div>
</div>    

<?php

  $users =$pdo->query('select * from users',PDO::FETCH_ASSOC);// code...
  
  $resultat=$users->fetchall();
  foreach ($resultat as $r) {
    echo"<tr>
      <td>{$r['id']}</td>
      <td>{$r['first_name']}</td>
      <td>{$r['last_name']}</td>
      <td>{$r['gender']}</td>
      <td>{$r['birthday']}</td>
      <td>{$r['nationality']}</td>
      <td>{$r['birth_country']}</td>
      <td>{$r['birth_city']}</td>
      <td>{$r['phone']}</td>
      <td>{$r['mobile']}</td>
      <td>{$r['email']}</td>
      <td>
      <a href='supprim.php?id={$r['id']}'>Supprimer</a>|<a href='page_securisee.php?id={$r['id']}'>Editer</a>
      </td>
      </tr>";
  }
  
?>
