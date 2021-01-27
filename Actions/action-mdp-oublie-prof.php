<?php
session_start();

require_once ('../Includes/conf.php');
require_once("../Includes/PHPMailer-master/src/Exception.php");
require_once("../Includes/PHPMailer-master/src/OAuth.php");
require_once("../Includes/PHPMailer-master/src/PHPMailer.php");
require_once("../Includes/PHPMailer-master/src/POP3.php");
require_once("../Includes/PHPMailer-master/src/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;

// Envoi du mail

if(isset($_POST["recup_mail"]) && $_POST["recup_mail"]) {
    $mail = new PHPmailer();

    $opts = array('http' =>
        array(
            'method' => 'GET',
            'header' => "Content-Type: application/json\r\n" .
                "Authorization: Token " . TOKEN . "\r\n",

            'content' => '{
        "filters":[

		{

			"column_name": "AdresseMail",

			"filter_predicate": "is",

			"filter_term": "' . $_POST["recup_mail"] . '",

			"filter_term_modifier": ""	
		}
		],
		"filter_conjunction": "And"
	}'
        )
    );
    $context = stream_context_create($opts);
    $url = "https://cloud.seatable.io/dtable-server/api/v1/dtables/" . UUID . "/filtered-rows/?table_name=Professeur";
    $result = file_get_contents($url, false, $context);
    $result = json_decode($result);



    if (sizeof($result->rows) > 0) {

        $mail = new PHPmailer();

        $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP
        $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
        $mail->SMTPAuth = true; // Activer authentication SMTP
        $mail->Username = 'djaberkheloufi@gmail.com'; // Votre adresse email d'envoi
        $mail->Password = 'poulet25'; // Le mot de passe de cette adresse email
        $mail->SMTPSecure = 'ssl'; // Accepter SSL
        $mail->Port = 465;

        $mail->setFrom('djaberkheloufi@gmail.com', 'Mailer'); // Personnaliser l'envoyeur
        $mail->addAddress($_POST["recup_mail"]); // Ajouter le destinataire


        $random_number = ''; // set up a blank string

        $count = 0;

        while ($count < 8) {
            $random_digit = mt_rand(0, 9);

            $random_number .= $random_digit;
            $count++;
        }

        $opts = array('http' =>
            array(
                'method' => 'PUT',
                'header' => "Content-Type: application/json\r\n" .
                    "Authorization: Token " . TOKEN . "\r\n",
                'content' => '{
   "row": {
   "Code": "' . password_hash($random_number, PASSWORD_DEFAULT) . '"
   },
   "table_name": "Professeur",
   "row_id": "'.$result->rows[0]->_id.'"
    }'
            )
        );

        $context = stream_context_create($opts);
        $url = "https://cloud.seatable.io/dtable-server/api/v1/dtables/" . UUID . "/rows/";
        $result = file_get_contents($url, false, $context);

        $mail->Subject = 'Verification email';
        $mail->Body = $random_number;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        //$mail->SMTPDebug = 1;
        $mail->send();
        $_SESSION["Mail"] = $_POST["recup_mail"];

        header('Location: ../Templates/mdp-oublie-prof.php?section=code');
    } else {
        $error["doublon"] = true;
    }

} elseif (isset($_POST["verif_code"])) {

    echo "lala";
    $opts = array('http' =>
        array(
            'method' => 'GET',
            'header' => "Content-Type: application/json\r\n" .
                "Authorization: Token " . TOKEN . "\r\n",

            'content' => '{
        "filters":[

		{

			"column_name": "AdresseMail",

			"filter_predicate": "is",

			"filter_term": "' . $_SESSION["Mail"] . '",

			"filter_term_modifier": ""	
		}
		],
		"filter_conjunction": "And"
	}'
        )
    );
    $context = stream_context_create($opts);
    $url = "https://cloud.seatable.io/dtable-server/api/v1/dtables/" . UUID . "/filtered-rows/?table_name=Professeur";
    $result = file_get_contents($url, false, $context);
    $rep = json_decode($result, true);


    if (password_verify($_POST["verif_code"], $rep["rows"][0]["Code"])) {
        $opts = array('http' =>
            array(

                'method' => 'PUT',
                'header' => "Content-Type: application/json\r\n" .
                    "Authorization: Token " . TOKEN . "\r\n",
                'content' => '{
   "row": {      "Code": "1" },
   "table_name": "Professeur",
   "row_id": "' . $rep["rows"][0]["_id"] . '"
    }'
            )

        );
        $context = stream_context_create($opts);
        $url = "https://cloud.seatable.io/dtable-server/api/v1/dtables/" . UUID . "/rows/";
        $result = file_get_contents($url, false, $context);
        header("Location: ../Templates/mdp-oublie-prof.php?section=changemdp");
    } else {
        $error["code"] = true;
    }
} elseif (isset($_POST["change_mdp"]) && isset($_POST["change_mdpc"])) {

    $opts = array('http' =>
        array(
            'method' => 'GET',
            'header' => "Content-Type: application/json\r\n" .
                "Authorization: Token " . TOKEN . "\r\n",

            'content' => '{
        "filters":[

		{

			"column_name": "AdresseMail",

			"filter_predicate": "is",

			"filter_term": "' . $_SESSION["Mail"] . '",

			"filter_term_modifier": ""	
		}
		],
		"filter_conjunction": "And"
	}'
        )
    );
    $context = stream_context_create($opts);
    $url = "https://cloud.seatable.io/dtable-server/api/v1/dtables/" . UUID . "/filtered-rows/?table_name=Professeur";
    $result = file_get_contents($url, false, $context);
    $rep = json_decode($result, true);

    if ($_POST["change_mdp"] == $_POST["change_mdpc"]) {
        //UPDATE
        if ($rep["rows"][0]["Code"] == 1) {
            $opts = array('http' =>
                array(

                    'method' => 'PUT',
                    'header' => "Content-Type: application/json\r\n" .
                        "Authorization: Token " . TOKEN . "\r\n",
                    'content' => '{
   "row": {   
     
   "MotDePasseProfesseur": "' . password_hash($_POST['change_mdp'], PASSWORD_DEFAULT) . '"

   },
   "table_name": "Professeur",
   "row_id": "' . $rep["rows"][0]["_id"] . '"
    }'
                )

            );
            $context = stream_context_create($opts);
            $url = "https://cloud.seatable.io/dtable-server/api/v1/dtables/" . UUID . "/rows/";
            $result = file_get_contents($url, false, $context);
            header("Location: ../Templates/index.php");

        }
    } else {
        $error['confirm_mdp'] = true;
    }
}
