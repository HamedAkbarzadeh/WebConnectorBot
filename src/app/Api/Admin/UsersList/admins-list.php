<?php

if ($telegramApi->getText() == "show_all_admins") {
    $sql->table('users')->where('user_id', $telegramApi->getUser_id())->update(['step'], ['admins-list']);
    $users = $sql->table('users')->select(["first_name", "last_name", 'username'])->where("is_admin", 1)->get();

    $usersInfo = "نمایش لیست ادمین های ربات " . BOT_NAME . PHP_EOL . PHP_EOL . PHP_EOL;
    foreach ($users as $user) {
        $usersInfo .= "Name : " . $user['first_name'] . " " . $user['last_name'] . PHP_EOL . "Username : " . "@" . $user['username'] . PHP_EOL . PHP_EOL;
    }

    $reply_markup = [
        'inline_keyboard' => [

            [
                [
                    'text' => 'بازگشت به صفحه ی قبل',
                    'callback_data' => 'users_list_manage',
                ],
                [
                    'text' => 'بازگشت به منوی اصلی',
                    'callback_data' => 'return_home_button',
                ],
            ],
        ],
    ];
    $telegramApi->editMessageText($usersInfo, $reply_markup);
}
