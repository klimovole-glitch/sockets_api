<?php
$url = "https://jsonplaceholder.typicode.com/users/1"; 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($response === false) {
    die("<h3>Ошибка сети: " . curl_error($ch) . "</h3>");
}

if ($httpCode !== 200) {
    die("<h3>Ошибка HTTP: Код " . $httpCode . "</h3>");
}

$data = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("<h3>Ошибка: Невалидный JSON</h3>");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Данные из API</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; padding: 40px; }
        .card { background: #fff; max-width: 400px; padding: 20px; border-radius: 8px; border-left: 5px solid #007bff; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #333; }
        ul { list-style-type: none; padding: 0; }
        li { padding: 8px 0; border-bottom: 1px solid #eee; }
        li:last-child { border-bottom: none; }
        span { font-weight: bold; color: #555; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Профиль пользователя</h2>
        <ul>
            <li><span>ID:</span> <?= $data['id'] ?></li>
            <li><span>Имя:</span> <?= $data['name'] ?></li>
            <li><span>Логин:</span> <?= $data['username'] ?></li>
            <li><span>Email:</span> <?= $data['email'] ?></li>
            <li><span>Город:</span> <?= $data['address']['city'] ?></li>
        </ul>
    </div>
</body>
</html>