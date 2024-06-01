<?php 

function sendAnswer($type, $description, $user) {

    $file = "log.txt";
    $result = [];

    $result[$type] = $description;
    $text = @file_get_contents($file);
    $text .= "$type : $description. Данные пользователя: name - {$user['name']}, surname - {$user['surname']}, email - {$user['email']}. \n";

    file_put_contents($file, $text);
    echo json_encode($result);
    
    exit();
}

function repeatEmail($email, $users) {

    foreach($users as $user) {
        if ($email === $user['email']) {
            return true;
        }
    }
    return false;
}
