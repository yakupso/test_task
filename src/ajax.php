<?php

require_once "functions.php";

$file = "log.txt";

$users = [
    0 => [
        'id' => 1,
        'name' => 'Артур Артуров',
        'email' => 'artur@mail.ru'
    ],
    1 => [
        'id' => 2,
        'name' => 'Иван Иванов',
        'email' => 'ivan@mail.ru'
    ],
    2 => [
        'id' => 3,
        'name' => 'Андрей Андреев',
        'email' => 'andrew@mail.ru'
    ],
];

$user = json_decode(file_get_contents('php://input'), true);

if (empty($user['name']) ||
    empty($user['surname']) ||
    empty($user['email']) ||
    empty($user['password']) ||
    empty($user['repeat_password'])) {
    sendAnswer('ERROR', 'Заполните все поля', $user);
}

if (strpos($user['email'], '@') === false) {
    sendAnswer('ERROR', 'Неверный формат email', $user);
}

if ($user['password'] !== $user['repeat_password']) {
    sendAnswer('ERROR', 'Пароли не совпадают', $user);
}

if (repeatEmail($user['email'], $users)) {
    sendAnswer('ERROR', 'Данный email уже существует', $user);
}

sendAnswer('SUCCESS', 'Успешная регистрация', $user);
