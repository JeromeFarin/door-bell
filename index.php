<?php

include 'content.html';

if (!isset($_GET['ringing'])) {
    die;
}

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

$response = sendMessage();

if ($_ENV['APP_ENV'] === 'test') {
    $return["allresponses"] = $response;
    $return = json_encode($return);
    $data = json_decode($response, true);
    print_r($data);
    $id = $data['id'];
    print_r($id);
    print("\n\nJSON received:\n");
    print($return);
    print("\n");
}
