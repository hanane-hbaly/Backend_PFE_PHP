<?php

include '../../connect.php';

$table = "secteur";

$SecteurId = filterRequest("SecteurId");


$Nomsecteur1 = filterRequest("Noms");
$Nomsecteur2 = filterRequest("Nomss");
deleteData($table,"SecteurId=$SecteurId");

$data = array( 
    "Noms" => $Noms,
    );
    
    insertData($table , $data);
    $data = array( 
        "Noms" => $Nomss,
        );
        
        insertData($table , $data);




?>
