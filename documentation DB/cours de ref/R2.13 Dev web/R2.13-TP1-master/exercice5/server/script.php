<?php

/*  Question

    Q1 :
    Ouvrez le fichiez model.php et complétez la fonction getRoomData en suivant les indications dans ce fichier.

    Q2 :
    Complétez le script ci-dessous pour faire bon usage de getRoomData.
    Testez en utilisant la partie cliente de l'exercice 4 (attention aux urls)
*/

require("model.php");

if ( isset($_REQUEST['direction'] ) ){
    /* avant ce stade final, ils passeront par une étape de if/else if de toutes les directions possibles */
    $direction = $_REQUEST['direction'];
    // TODO
}
else{
    http_response_code(404);
}

