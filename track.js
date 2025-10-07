const fetch = require('node-fetch');

exports.handler = async (event) => {
  if (event.httpMethod !== 'POST') {
    return { statusCode: 405, body: JSON.stringify({ error: 'Method not allowed' }) };
  }

  const data = JSON.parse(event.body);

  // Формируем сообщение
  const msg = `👤 Новый посетитель:\n⏰ Время: ${data.timestamp}\n🌐 IP: ${data.ip}\n📱 Устройство: ${data.device.vendor} ${data.device.model}\n🖥 ОС: ${data.device.os}\n🌐 Браузер: ${data.device.browser}\n🖥 Экран: ${data.screen}`;

  // Telegram
  const botToken = '8419611735:AAHcIuTBPtm8TvkE8jZL6UT1TpKjTeMgzTA'; // Замени на свой токен
  const chatId = '8010348333';     // Замени на свой chat_id
  const url = `https://api.telegram.org/bot${8419611735:AAHcIuTBPtm8TvkE8jZL6UT1TpKjTeMgzTA}/sendMessage`;

  try {
    await fetch(url, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ chat_id: chatId, text: msg })
    });
    return { statusCode: 200, body: JSON.stringify({ status: 'ok' }) };
  } catch (error) {
    console.error('Ошибка Telegram:', error);
    return { statusCode: 500, body: JSON.stringify({ error: 'Failed to send to Telegram' }) };
  }
};
