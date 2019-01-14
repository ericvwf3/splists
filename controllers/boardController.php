<?php

require_once('helper.php');

$bdd = dbConnect('splists', 'root', '', 3308);

// Response de la BDD non traitée
$res = $bdd->query('SELECT * FROM lists');

// J'instancie mon tableau qui contiendra mes listes
$lists = [];

// Tant que j'ai des réponses qui vont dans $donnees (variable temporaire pour le while)
while($donnees = $res->fetch()) {

    // Je met le contenu de $donnees (variable temporaire) dans le tableau $lists
    $lists[] = $donnees;
}

$res->closeCursor();

    //Cas où je recois une variable POST de _form_list.php, je crée une liste
if(!empty($_POST['list-title'])) {
    
    //creation d'une nouvelle liste :

    $res = $bdd->prepare("INSERT INTO lists(title) VALUES (:title)");

    $res->execute([
        "title" => $_POST['list-title']
    ]);

    Header('Location: /splists/views/board.php?list=' . $bdd->lastInsertId());
}