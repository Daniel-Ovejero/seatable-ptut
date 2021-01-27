<?php include '../Actions/get-notes-etu.php';


foreach ($matieres as $matiere){
    echo '<h2>'.$matiere->LibelleMatiere.'</h2>';
    echo '<ul>';
    foreach ($partiels as $partiel){
        if(in_array($partiel->_id, $matiere->Partiel)){
            echo '<li>'.$partiel->LibellePartiel.': ';
            foreach ($notes as $note){
                if(in_array($partiel->_id, $note->Partiel)){
                    echo $note->Note.'</li>';
                }
            }

        }
    }
    echo '</ul>';
}

