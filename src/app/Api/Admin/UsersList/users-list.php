<?php

if ($telegramApi->getText() == "show_all_users") {
    $sql->table('users')->where('user_id', $telegramApi->getUser_id())->update(['step'], ['users-list']);
    $users = $sql->table('users')->select(["first_name", "last_name", 'username'])->get();
    $usersInfo = "نمایش لیست کاربران ربات " . BOT_NAME . PHP_EOL . PHP_EOL . PHP_EOL;
    $users = array_chunk($users, 90);
    foreach ($users as $userPages) {
        foreach ($userPages as $user) {
            $usersInfo .= "Name : " . $user['first_name'] . " " . $user['last_name'] . PHP_EOL . "Username : " . "@" . $user['username'] . PHP_EOL . PHP_EOL;
        }
        $telegramApi->sendMessage($usersInfo);
        $usersInfo = "";
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
    $text = "برای ادامه کار لطفا یکی از گزیینه های زیر را انتخاب نمایید";
    $telegramApi->sendMessage($text, $reply_markup);
}
