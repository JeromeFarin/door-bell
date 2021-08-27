<?php

$_ENV['APP_ENV'] = 'test';

function sendMessage()
{
    $fields = array(
        'name' => "Door bell",
        'app_id' => "36b0c14a-4982-4a14-b16f-c409ce98ff00",
        'contents' => array(
            "en" => 'Someone just ringing'
        ),
        'sms_from' => "+18508425310",
        'include_phone_numbers' => ["+33644079372"]
    );


    $fields = json_encode($fields);
    if ($_ENV['APP_ENV'] === 'test') {
        print("\nJSON sent:\n");
        print($fields);
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic OGRlMzhhNDAtODMzOC00MmJhLTkyOGEtNjkwYzgzNGNkZDBk'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// $response = sendMessage();

// if ($_ENV['APP_ENV'] === 'test') {
//     $return["allresponses"] = $response;
//     $return = json_encode($return);
//     $data = json_decode($response, true);
//     print_r($data);
//     $id = $data['id'];
//     print_r($id);
//     print("\n\nJSON received:\n");
//     print($return);
//     print("\n");
// }
include 'content.html';
// echo "<h1>Hey salut,</h1> <p>J'espère que tu vas bien, tu es bien chez Jérôme Farin, j'ai été notifié que tu es devant la porte, si je suis à la maison, tu devrais me voir rapidement sinon tu peux m'appeler au <a target=\"_blank\" href=\"tel:+33644079372\">06 44 07 93 72</a> pour que l'on trouve un arrangement</p>";

// echo "<h1>Hey salut,</h1> <p>J'espère que tu vas bien, tu es bien chez Jérôme Farin et Marie Jallet, nous avons été notifié que tu es devant la porte, si quelqu'un est à la maison, tu devrais voir rapidement quelqu'un sinon tu peux nous appeler au <a target=\"_blank\" href=\"tel:+33644079372\">06 44 07 93 72</a> ou au <a target=\"_blank\" href=\"tel:+33781420228\">07 81 42 02 28</a> pour que l'on trouve un arrangement</p>";
