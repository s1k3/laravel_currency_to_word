<?php

function number_to_word($number,$language = ''){
    if (empty($language)) $language =config("number_to_word.language");
    return \S1K3\Bangla\Number\To\Word\AmountInWord::instance($number)->convert($language);
}
