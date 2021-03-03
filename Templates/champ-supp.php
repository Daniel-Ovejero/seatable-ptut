<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mes absences</title>
    <link rel="stylesheet" href="../Assets/css/note.css">
    <?php include_once '../Includes/import-css.php' ?>
</head>

<body>
<?php include_once '../Actions/get-all-metadata.php'?>
<?php include_once '../Includes/navbar.php' ?>

<?php
foreach ($tables as $table){
    echo "<form name='table-$table->name' method='post'>";
    echo "<input type='hidden' name='table' value='$table->name'>";
    echo "<strong>".$table->name."</strong>";
    echo "<br>";
    foreach ($table->columns as $col) {

        //changer la value en fonction de la table champs supp
        echo "<input type='checkbox' name='$col->name' id='$col->name' value='$col->name'> <label for='$col->name'>$col->name</label>";
        echo "<br>";
    }
    echo "<button type='submit'>Enregistrer</button>";
    echo "</form>";
    echo "<br>";
}

if(isset($_POST)){
    var_dump($_POST);
}
?>

</body>
</html>