<?php

if ($telegramApi->getText() == 'support_button') {
    $telegramApi->deleteMessage();

    $sql->table('users')->where('user_id', $telegramApi->getUser_id())->update(['step'], ['support']);

    $text = "✨ با ما در ارتباط باشید!
🌟 از طریق ربات پشتیبانی ما می‌توانید انتقادات، پیشنهادات و نظرات خود را به راحتی با ما در میان بگذارید. نظرات شما به ما کمک می‌کند تا خدمات بهتری ارائه دهیم.

📩 برای ارسال پیام یا ارتباط با تیم پشتیبانی، کافی است وارد ربات زیر شوید:
@AsanDropSupport_Bot

✅ منتظر نظرات ارزشمند شما هستیم!";
    $buttons[] = [
        [
            'text' => 'بازگشت🔙',
            'callback_data' => 'return_home_button',
        ],
    ];

    $reply_markup = [
        'inline_keyboard' => $buttons,
    ];
    $telegramApi->sendMessage($text, $reply_markup);
}
