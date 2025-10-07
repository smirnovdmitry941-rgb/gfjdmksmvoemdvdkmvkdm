<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Формируем сообщение
    $msg = "👤 Новый посетитель:\n";
    $msg .= "⏰ Время: {$data['timestamp']}\n";
    $msg .= "🌐 IP: {$data['ip']}\n";
    $msg .= "📍 Гео: {$data['geo']['country']}, {$data['geo']['region']}, {$data['geo']['city']}\n";
    $msg .= "📱 Устройство: {$data['device']['vendor']} {$data['device']['model']}\n";
    $msg .= "🖥 ОС: {$data['device']['os']}\n";
    $msg .= "🌐 Браузер: {$data['device']['browser']}\n";
    $msg .= "🖥 Экран: {$data['screen']}\n";
    $msg .= "⏳ Часовой пояс: {$data['timezone']}\n";
    $msg .= "🔗 URL: {$data['url']}\n";
    $msg .= "↩️ Referrer: {$data['referrer'] ?: 'прямой вход'}";

    // Telegram
    $botToken = 'YOUR_BOT_TOKEN'; // Замени
    $chatId = 'YOUR_CHAT_ID';     // Замени
    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    
    $params = [
        'chat_id' => $chatId,
        'text' => $msg,
        'parse_mode' => 'HTML'
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Для теста
    curl_exec($ch);
    curl_close($ch);
    
    echo json_encode(['status' => 'ok']);
}
?>
