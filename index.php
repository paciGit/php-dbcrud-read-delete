<?php

  // Comunicazione dati DB
  $servername = "localhost";
  $user = "root";
  $password = "root";
  $db_name = "db-hotel";
  $connection = new mysqli($servername, $user, "root", $db_name);

  // In caso di mancata connessione
  if( $connection && $connection->connect_error ) {
  echo 'error?' . $connection->connect_error;
  print_r( $connection );

  return;
  } else {
  echo 'Connesso<BR><BR>';
  }

  //Seleziona tutto dalla tabella pagamenti e stampa il risultato in una lista ordinata
  $sql = "
    SELECT *
    FROM pagamenti
  ";

  // while > result
  $result = $connection->query($sql);

  if( $result && $result->num_rows > 0 ) {
    echo '<ul>';

    while( $row = $result->fetch_assoc() ) {
      if($row['id'] == 7) {
        echo '<li style="font-weight: bold;">';
      } else {
        echo '<li>';
      }

      echo $row['id'] ." - " .$row['status'] ." - " .$row['price'];
      echo '</li>';
    }

    echo '</ul>';
  } else {
    print_r($result);
  }


  //Elimina dalla tabella pagamenti la riga con id 8
  $sql = "
    DELETE
    FROM pagamenti
    WHERE id = 8
  ";

  // while > result
  $result = $connection->query($sql);

  if( $result === true ) {
    echo 'deleted.';
    print_r($result);
  } else {
    echo 'Error';
    print_r($result);
  }


  //Elimina dalla tabella pagamenti la riga con pagante_id = 6 e con status = rejected
  $sql = "
    DELETE
    FROM pagamenti
    WHERE pagante_id = 6 AND status = 'rejected'
  ";

  // Result
  $result = $connection->query($sql);
  if ($result) {
      echo "Deleted paying_id ".$paying." and status: ".$status."<br>";
  } else {
      echo "query error";
  }


  //Seleziona dalla tabella pagamenti le colonne id, status e price di tutti i pagamenti con price superiore a 600, stampa il risultato in una lista non ordinata
  // Query SQL
  $sql = "
    SELECT id, status, price
    FROM pagamenti
    WHERE price > 600
  ";

  $result = $connection->query($sql);

  if( $result && $result->num_rows > 0 ) {
    // Ciclo while sui risultati
    echo '<ul>';

    while( $row = $result->fetch_assoc() ) {
      echo '<li>' . $row['id'] ." - " .$row['status'] . " - " .$row['price'] . '</li>';
    }

    echo '</ul>';
  } else {
    print_r($result);
  }


  //closed connection
  $connection->close();




 ?>
