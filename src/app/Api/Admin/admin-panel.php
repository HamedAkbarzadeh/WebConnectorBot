<?php

namespace src\app\Api\Admin;

//Admin Panel
if ($telegramApi->getText() == 'admin_panel' || strpos($telegramApi->getText(), 'return_admin_panel') === 0) {
    if ($telegramApi->getText() == 'admin_panel') {
        $telegramApi->deleteMessage();
    }

    $sql->table('users')->where('user_id', $telegramApi->getUser_id())->update(['step'], ['admin_panel']);
    $text = 'به پنل ادمین خوش آمدید.';
    $reply_markup = [
        'inline_keyboard' => [
            // Fetch DB
            [
                [
                    'text' => 'مدیریت محصولات',
                    'callback_data' => 'product_management',
                ],
                [
                    'text' => 'مدیریت لینک ها',
                    'callback_data' => 'link_management',
                ],
            ],
            [
                [
                    'text' => 'لیست کاربران',
                    'callback_data' => 'users_list_management',
                ],
            ],
            [
                [
                    'text' => 'بازگشت',
                    'callback_data' => 'return_home',
                ],
            ], //The buttons must be read from the database.
        ],
    ];

    $telegramApi->editMessageText($text, $reply_markup);
}
