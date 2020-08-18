<?php


namespace S1K3\Bangla\Number\To\Word;



class AmountInWord
{
    private $amount;
    private $fraction;

    private function __construct($value)
    {
        $values = explode(".", $value);
        if (count($values) == 2) {
            $this->amount = $values[0];
            $this->fraction = $values[1];
        } else {
            $this->amount = $value;
            $this->fraction = "";
        }
    }

    public static function instance($value, $language = "en")
    {
        $instance = new AmountInWord($value);
        if (!$instance->isValid($value)) throw new InvalidAmountException();
        return $instance;
    }

    public function convert($language = "en")
    {
        $currency_units = $this->currencyUnits();
        $currency_values = explode(",", $this->formatWithComma());
        $result = "";
        for ($i = 0; $i < count($currency_values); $i++) {
            if ((int)$currency_values[$i] != 0) {
                //very big number not ideal todo work
                if ($currency_units[$i] == "crore" && strlen($currency_values[$i]) > 3) {
                    $new_instance = AmountInWord::instance($currency_values[$i], $language);
                    $result .= $new_instance->convert($language);
                    $result .= " " . config("number_to_word.units.$language.crore");
                    $result .= " ";
                } else {
                    $result .= NumberConverter::instance($currency_values[$i], $currency_units[$i], $language)->word();
                    $result .= " ";
                }
            }
        }
        $result.=config("number_to_word.unit.$language");
        if (!empty($this->fraction)) {
            $result.=" ". NumberConverter::instance(sprintf("%.2f", "0.{$this->fraction}") * 100,"paisa",$language)->word();
        }
        return $result;
    }

    private function formatWithComma()
    {
        $result = "";
        $amounts = explode(".", $this->amount);
        if (count($amounts) == 2) {
            $elements = strrev($amounts[0]);
        } else {
            $elements = strrev($this->amount);
        }
        $index = 1;
        for ($i = 0; $i < strlen($elements); $i++) {
            $result .= $elements[$i];
            if ($index < strlen($elements)) {
                if ($index == 3 || $index == 5 || $index == 7) $result .= ",";
            }
            $index++;
        }
        return strrev($result);
    }

    private function currencyUnits()
    {
        switch ($this->totalUnits()) {
            case 4:
                return ["crore", "lac", "thousand", "hundred"];
            case 3:
                return ["lac", "thousand", "hundred"];
            case 2:
                return ["thousand", "hundred"];
            default:
                return ["hundred"];
        }
    }

    private function totalUnits()
    {
        $units = explode(",", $this->formatWithComma());
        return count($units);
    }

    private function isValid($value)
    {
        $valid_numbers = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "."];
        if (empty($value)) return false;
        if (count(explode(".", $value)) > 2) return false;
        for ($i = 0; $i < strlen($value); $i++) {
            if (!in_array($value[$i], $valid_numbers)) {
                return false;
            }
        }
        return true;
    }

}
