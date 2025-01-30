<?php

use src\app\Classes\Product;

if ($telegramApi->getText() == "add_product_to_site") {
    setStep('insert_product_section_name');
    $text = " قسمت افزودن محصول به داخل سایت ";
    $text .= "\n\nنام محصول را وارد نمایید ";
    inlineCancelButton();
    $telegramApi->sendMessage($text, $reply_markup);
}

//save name product
if ($userStep == "insert_product_section_name") {
    setStep("insert_product_save_name");
    $product = new Product($sql, $telegramApi);
    $productName = $telegramApi->getText();

    $product->store(['name'], [$productName]);

    $text = "لطفا عکس های محصولات را ارسال نمایید";
    inlineCancelButton();
    $telegramApi->sendMessage($text, $reply_markup);
}
