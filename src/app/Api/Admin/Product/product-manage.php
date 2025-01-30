<?php


if ($telegramApi->getText() == 'product_management') {
    $text = "به بخش مدیریت محصولات خوش آمدید";
    $reply_markup = [
        'inline_keyboard' => [
            [
                [
                    'text' => 'افزودن محصول به سایت',
                    'callback_data' => 'add_product_to_site'
                ],
                [
                    'text' => 'ارسال محصول به داخل کانال',
                    'callback_data' => 'send_product_to_channel'
                ]
            ],
            [
                [
                    'text' => 'بازگشت',
                    'callback_data' => 'return_admin_panel'
                ]
            ]
        ]
    ];
    $telegramApi->editMessageText($text, $reply_markup);
}
