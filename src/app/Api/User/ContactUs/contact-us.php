<?php

if ($telegramApi->getText() == "contact_us") {

    $text = "به صفحه ارتباط با ما خوش آمدید";


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
