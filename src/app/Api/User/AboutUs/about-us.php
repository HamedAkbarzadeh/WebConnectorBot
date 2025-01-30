<?php

if ($telegramApi->getText() == "about_us") {

    $text = "به صفحه درباره ما" . BOT_NAME . " خوش آمدید";

    $reply_markup = [
        'inline_keyboard' => [
            [
                [
                    'text' => 'بارگشت',
                    'callback_data' => 'return_home'
                ]
            ]
        ]
    ];

    $telegramApi->sendMessage($text, $reply_markup);
}
