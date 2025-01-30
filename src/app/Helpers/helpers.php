<?php

use Morilog\Jalali\Jalalian;



function setManualLog($text, $file = "AllError.log")
{
    date_default_timezone_set('Asia/Tehran');

    $file = fopen('../Log/' . $file, 'a');
    if ($file) {
        // fwrite($file, "[ ".jalaliDate(time() , "%A, %d %B %Y || %H:%i:%s")." ] - " . $text . PHP_EOL . PHP_EOL);
        fwrite($file, "[ " . date("Y-m-d H:i:s") . " ] - " . $text . PHP_EOL . PHP_EOL);
        fclose($file);
    }
}
function jalaliDate($date, $format = '%A, %d %B %Y')
{
    return Jalalian::forge($date)->format($format);
}
function convertPersianToEnglish($number)
{
    $number = str_replace('۰', '0', $number);
    $number = str_replace('۱', '1', $number);
    $number = str_replace('۲', '2', $number);
    $number = str_replace('۳', '3', $number);
    $number = str_replace('۴', '4', $number);
    $number = str_replace('۵', '5', $number);
    $number = str_replace('۶', '6', $number);
    $number = str_replace('۷', '7', $number);
    $number = str_replace('۸', '8', $number);
    $number = str_replace('۹', '9', $number);
    return $number;
}
function convertArabicToEnglish($number)
{
    $number = str_replace('۰', '0', $number);
    $number = str_replace('۱', '1', $number);
    $number = str_replace('۲', '2', $number);
    $number = str_replace('۳', '3', $number);
    $number = str_replace('۴', '4', $number);
    $number = str_replace('۵', '5', $number);
    $number = str_replace('۶', '6', $number);
    $number = str_replace('۷', '7', $number);
    $number = str_replace('۸', '8', $number);
    $number = str_replace('۹', '9', $number);
    return $number;
}
function convertEnglishToPersian($number)
{
    $number = str_replace('0', '۰', $number);
    $number = str_replace('1', '۱', $number);
    $number = str_replace('2', '۲', $number);
    $number = str_replace('3', '۳', $number);
    $number = str_replace('4', '۴', $number);
    $number = str_replace('5', '۵', $number);
    $number = str_replace('6', '۶', $number);
    $number = str_replace('7', '۷', $number);
    $number = str_replace('8', '۸', $number);
    $number = str_replace('9', '۹', $number);
    return $number;
}
function priceFormat($price)
{
    $price = number_format($price, 0, '/', '،');
    $price = convertEnglishToPersian($price);
    return $price;
}

function validateNationalCode($nationalCode)
{
    $nationalCode = trim($nationalCode, ' .');
    $nationalCode = convertArabicToEnglish($nationalCode);
    $nationalCode = convertPersianToEnglish($nationalCode);
    $bannedArray = ['0000000000', '1111111111', '2222222222', '3333333333', '4444444444', '5555555555', '6666666666', '7777777777', '8888888888', '9999999999'];

    if (empty($nationalCode)) {
        return false;
    } else if (count(str_split($nationalCode)) != 10) {
        return false;
    } else if (in_array($nationalCode, $bannedArray)) {
        return false;
    } else {

        $sum = 0;

        for ($i = 0; $i < 9; $i++) {
            // 1234567890
            $sum += (int) $nationalCode[$i] * (10 - $i);
        }

        $divideRemaining = $sum % 11;

        if ($divideRemaining < 2) {
            $lastDigit = $divideRemaining;
        } else {
            $lastDigit = 11 - ($divideRemaining);
        }

        if ((int) $nationalCode[9] == $lastDigit) {
            return true;
        } else {
            return false;
        }
    }
}
function returnToMenuAdmin($text, $sendEditMessage = false)
{
    global $telegramApi;

    $reply_markup = [
        'inline_keyboard' => [
            // Fetch DB
            [
                [
                    'text' => 'بازگشت به ادمین پنل',
                    'callback_data' => 'return_admin_panel_button'
                ]
            ],
            [
                [
                    'text' => 'بازگشت به منوی اصلی',
                    'callback_data' => 'return_home_button'
                ]
            ], //The buttons must be read from the database.
        ]
    ];
    if ($sendEditMessage) {
        $telegramApi->editMessageText($text, $reply_markup);
    } else {
        $telegramApi->sendMessage($text, $reply_markup);
    }
}

function inlineCancelButton()
{
    $reply_markup = [
        'inline_keyboard' => [
            [
                [
                    'text' => 'کنسل کردن',
                    'callback_data' => 'cancel_proccess'
                ]
            ]
        ]
    ];
}
function setStep($step)
{
    global $sql;
    global $telegramApi;
    $sql->table('users')->where('user_id', $telegramApi->getUser_id())->update(['step'], [$step]);
}
