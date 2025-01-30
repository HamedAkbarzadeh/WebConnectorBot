<?php
// AgACAgQAAxkBAAII7Wbpz9SgrWwF-7tPirFxjM18dz2JAAI4wjEbG29IU1r_tRiIoSF8AQADAgADeQADNgQ file ID profile pic
namespace src\app\Api\Admin;

if (strpos($telegramApi->getText(), '/start') === 0 || $telegramApi->getText() == "return_home") {
    if ($telegramApi->getText() == "return_home") {
        $telegramApi->deleteMessage();
    }
    $sql->table('users')->where('user_id', $telegramApi->getUser_id())->update(['step'], ['home']);


    $buttons = [
        [
            [
                'text' => 'ورود به کانال',
                'callback_data' => 'linkToJoin_telegramChannel',
            ],
            [
                'text' => 'ورود به سایت',
                'callback_data' => 'linkToJoin_webSite',
            ],
        ],
        [
            [
                'text' => 'ورود به اینستاگرام',
                'callback_data' => 'linkToJoin_instagram',
            ],
        ],
        [
            [
                'text' => 'درباره ما',
                'callback_data' => 'about_us',
            ],
        ],
        [
            [
                'text' => 'ارتباط با ما',
                'callback_data' => 'contact_us',
            ],
        ]
    ];
    if ($user['is_admin']) {
        $buttons[] = [
            [
                'text' => 'پنل ادمین🔨',
                'callback_data' => 'admin_panel',
            ],
        ];
    }
    $reply_markup = [
        'inline_keyboard' =>
        $buttons,
    ];
    $text = "به ربات تلگرامی نمایشگاه چوب خوشرنگ خوش آمدید .";
    $telegramApi->sendMessage($text, $reply_markup);
}

include_once "../Admin/admin-panel.php";
include_once "Links/link.php";
include_once "AboutUs/about-us.php";
include_once "ContactUs/contact-us.php";
