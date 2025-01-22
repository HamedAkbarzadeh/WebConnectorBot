<?php
if (strpos($telegramApi->getText(), '/start') === 0) {


    $tempUserID = $sql->table('users')->select('user_id')->where('user_id', $telegramApi->getUser_id())->first()['user_id'];

    if ($telegramApi->getUser_id() != $tempUserID) {

        $invited_by_user_id = null;
        //add invited_by_user_id in database if joined with referral link
        if (explode(' ', $telegramApi->getText())[1] != null) {
            $invited_by_user_id = $sql->table('users')->select()->where('invite_link', BOT_USERNAME . "?start=" . explode(' ', $telegramApi->getText())[1])->first();
            if ($invited_by_user_id) {
                if ($user['invited_by_user_id '] == null) {
                    $invited_by_user_id = $invited_by_user_id['id'];
                }
            }
        }
        $userName = $telegramApi->getUsername();
        $text = "کاربر $userName گرامی عزیز، سلام!🎈" . PHP_EOL . " به ربات" . BOT_NAME . " خوش آمدی😊❤️" . PHP_EOL . PHP_EOL . "برای استفاده از قابلیت های ربات یکی از دکمه های زیر رو انتخاب کن :";

        $sql->table('users')->insert(
            [
                'user_id',
                'first_name',
                'last_name',
                'username',
                'is_bot',
                'is_permium',
                'invite_link',
                'invited_by_user_id',
                'step',
                'status_bot_used',
            ],
            [
                $telegramApi->getUser_id(),
                $telegramApi->getFirst_name(),
                $telegramApi->getLast_name(),
                $telegramApi->getUsername(),
                $telegramApi->getIs_bot(),
                $telegramApi->getIs_permium(),
                BOT_USERNAME . "?start=" . hash('md2', $telegramApi->getUser_id()),
                $invited_by_user_id,
                'home',
                0,
            ]
        );
    } else {

        $userName = $telegramApi->getFirst_name();
        $text = "کاربر $userName گرامی عزیز، سلام!🎈" . PHP_EOL . " به ربات" . BOT_NAME . " خوش آمدی😊❤️" . PHP_EOL . PHP_EOL . "برای استفاده از قابلیت های ربات یکی از دکمه های زیر رو انتخاب کن :";

        $res = $sql->table('users')->where('user_id', $tempUserID)->update(
            [
                'user_id',
                'first_name',
                'last_name',
                'username',
                'is_permium',
                'step',
                'status_bot_used',
            ],
            [
                $telegramApi->getUser_id(),
                $telegramApi->getFirst_name(),
                $telegramApi->getLast_name(),
                $telegramApi->getUsername(),
                $telegramApi->getIs_permium(),
                'home',
                1,
            ]
        );
    }
}
