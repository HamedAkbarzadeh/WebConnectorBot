<?php

if ($telegramApi->getText() == "users_list_manage") {
    $sql->table('users')->where('user_id', $telegramApi->getUser_id())->update(['step'], ['user-list-manage']);
    $users = $sql->table("users")->select()->where("is_admin", "!=", 1)->get();
    $admins = $sql->table("users")->select()->where("is_admin", 1)->get();

    $text = "تعداد کاربران : " . count($users) . PHP_EOL;
    $text .= "تعداد ادمین ها : " . count($admins) . PHP_EOL;
    $text .= "تعداد کل کاربران : " . (count($admins) + count($users));


    $reply_markup = [
        'inline_keyboard' => [
            [
                [
                    'text' => 'نمایش کاربران',
                    'callback_data' => 'show_all_users'
                ]
            ],
            [
                [
                    'text' => 'نمایش ادمین ها ',
                    'callback_data' => 'show_all_admins'
                ],
            ],
            [
                [
                    'text' => 'بازگشت به صفحه ی قبل',
                    'callback_data' => 'return_admin_panel_button',
                ],
                [
                    'text' => 'بازگشت به منوی اصلی',
                    'callback_data' => 'return_home_button',
                ],
            ],
        ],
    ];
    $telegramApi->editMessageText($text, $reply_markup);
}
include_once "admins-list.php";
include_once "users-list.php";
