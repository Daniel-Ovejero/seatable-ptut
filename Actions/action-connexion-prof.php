<?php

session_start();

include("../Includes/conf.php");

if (isset($_POST["username"]) && isset($_POST["password"])) {

    $opts = array('http' =>
        array(
            'method'  => 'GET',
            'header'  => "Content-Type: application/json\r\n".
                "Authorization: Token ".TOKEN."\r\n",

            'content' =>  '{
        "filters":[
		{
			"column_name": "Adresse Mail",

			"filter_predicate": "is",

			"filter_term": "'.$_POST["username"].'",

			"filter_term_modifier": ""	
		}
		],
		"filter_conjunction": "And"
	}'
        )
    );

    $context  = stream_context_create($opts);
    $url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/filtered-rows/?table_name=Professeur";
    $result = file_get_contents($url, false, $context);
    $rep = json_decode($result, true);


    foreach ($rep as $etu => $value) {
        foreach ($value as $prof) {
            if ($_POST["username"] == $prof["Name"]) {
                if (password_verify($_POST["password"], $prof["MotDePasse"])) {
                    $_SESSION["row_id"] = $prof["Id"];
                    break;
                }
            }
        }
    }

    if(isset($_SESSION["row_id"])) {
        header("Location: ./detail.php");
    }else{
        echo "Couple login/mdp faux";
    }
}
?>
