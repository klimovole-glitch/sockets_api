<?php
set_time_limit(0);
$host = '127.0.0.1';
$port = 8080;

$socket = stream_socket_server("tcp://{$host}:{$port}", $errno, $errstr);
if (!$socket) {
    die("Ошибка: {$errstr} ({$errno})\n");
}

echo "Сервер запущен на http://{$host}:{$port}\n";
echo "Ожидание подключения... (Нажмите Ctrl+C для выхода)\n";

while ($conn = stream_socket_accept($socket, -1)) {
    fread($conn, 1024);
    
    $response = "HTTP/1.1 200 OK\r\n";
    $response .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $response .= "Connection: close\r\n\r\n";
    $response .= "OK";
    
    fwrite($conn, $response);
    fclose($conn);
    echo "Отправлен ответ: OK\n";
}
?>