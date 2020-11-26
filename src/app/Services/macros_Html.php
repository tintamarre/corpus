<?php

/**
* **************************************************************
* HTML MACROS
* **************************************************************.
*/
Html::macro('randSlug', function ($length = 10) {
    return substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)))), 1, $length);
});

// {{Html::gravatar(Auth::user()->email, 32,Auth::user()->fullName() , array('class' => 'avatar'))}}
Html::macro('gravatar', function ($email, $size = 128, $alt = '', $attributes = []) {
    $attributes['alt'] = $alt;

    return '<img src="http://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '?s=' . $size . '&d=identicon" ' . HTML::attributes($attributes) . ' />';
});
