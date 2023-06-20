<?php
include "../connect.php";

// Requête pour récupérer les options de secteur
$secteurQuery = $con->query("SELECT Noms FROM secteur");
$secteurOptions = $secteurQuery->fetchAll(PDO::FETCH_COLUMN);

// Renvoyer les options de secteur au format JSON
$response = array('secteurOptions' => $secteurOptions);
header('Content-Type: application/json');
echo json_encode($response);

// Vérifier si des données ont été envoyées depuis le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $secteurSelectionne = $_POST['secteur'];
    $nomClient = $_POST['nom'];
    $prenomClient = $_POST['prenom'];
    $telephoneClient = $_POST['telephone'];
    $adresseClient = $_POST['adresse'];

    // Requête pour récupérer l'ID du secteur correspondant
    $secteurQuery = $con->prepare("SELECT SecteurID FROM secteur WHERE Noms = :nom");
    $secteurQuery->bindParam(':nom', $secteurSelectionne);
    $secteurQuery->execute();
    $secteur = $secteurQuery->fetch(PDO::FETCH_ASSOC);

    $secteurID = $secteur['SecteurID'];

    // Requête pour insérer les données dans la table "client"
    $insertQuery = $con->prepare("INSERT INTO client (SecteurID, Nomc, Prenomc, telephone, Adressec) VALUES (:secteurID, :nom, :prenom, :telephone, :adresse)");
    $insertQuery->bindParam(':secteurID', $secteurID);
    $insertQuery->bindParam(':nom', $nomClient);
    $insertQuery->bindParam(':prenom', $prenomClient);
    $insertQuery->bindParam(':telephone', $telephoneClient);
    $insertQuery->bindParam(':adresse', $adresseClient);
    $insertQuery->execute();

    // Réponse JSON indiquant le succès de l'enregistrement
    $response = array('success' => true);
    echo json_encode($response);
}
?>
