<?php
function numer_to_word($number){
    return \S1K3\Bangla\Number\To\Word\AmountInWord::instance($number)->convert(config("number_to_word.language"));
}