<?php

if (strpos($telegramApi->getText(), 'linkToJoin') === 0) {
    $direction = explode("_", $telegramApi->getText())[1];


    switch ($direction) {
        case 'webSite':
            $link = $sql->table('links')->select()->where('tag', 'web_khoshrang')->first();
            $text = "سایت مبلمان خوشرنگ \n جهت ورود بر روی دکمه ورود کلیک نمایید .\n\n" . $link['link'];
            break;
        case 'instagram':
            $link = $sql->table('links')->select()->where('tag', 'instagram')->first();
            $text = "اینستاگرام مبلمان خوشرنگ \n جهت ورود بر روی دکمه ورود کلیک نمایید .\n\n" . $link['link'];
            break;
        case 'telegramChannel':
            $link = $sql->table('links')->select()->where('tag', 'telegram_channel_khoshrang')->first();
            $text = "کانال مبلمان خوشرنگ\n جهت ورود بر روی دکمه ورود کلیک نمایید ." . str_replace('https://t.me/', "@", $link['link']);
            break;
        default:
            $text = "برای بازگشت به منو قبل روی دکمه بازگشت کلیک نمایید";
            break;
    }
    if (isset($reply_markup)) {

        $reply_markup = [
            'inline_keyboard' => [
                [
                    [
                        'text' => "ورود",
                        'url' => $link['link']
                    ],
                    [
                        'text' => 'بازگشت',
                        'callback_data' => 'return_home'
                    ]
                ]
            ]
        ];
    } else {
        $reply_markup = [
            'inline_keyboard' => [
                [
                    [
                        'text' => 'بازگشت',
                        'callback_data' => 'return_home'
                    ]
                ]
            ]
        ];
    }

    $telegramApi->editMessageText($text, $reply_markup);
}
