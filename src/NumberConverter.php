<?php


namespace S1K3\Bangla\Number\To\Word;


use NumberFormatter;

class NumberConverter
{
    private $number;
    private $unit;
    private $language;

    private $numbers = [
        '0' => '',
        '1' => 'এক',
        '2' => 'দুই',
        '3' => 'তিন',
        '4' => 'চার',
        '5' => 'পাঁচ',
        '6' => 'ছয়',
        '7' => 'সাত',
        '8' => 'আট',
        '9' => 'নয়',
        '10' => 'দশ',
        '11' => 'এগার',
        '12' => 'বার',
        '13' => 'তের',
        '14' => 'চৌদ্দ',
        '15' => 'পনের',
        '16' => 'ষোল',
        '17' => 'সতের',
        '18' => 'আঠার',
        '19' => 'ঊনিশ',
        '20' => 'বিশ',
        '21' => 'একুশ',
        '22' => 'বাইশ',
        '23' => 'তেইশ',
        '24' => 'চব্বিশ',
        '25' => 'পঁচিশ',
        '26' => 'ছাব্বিশ',
        '27' => 'সাতাশ',
        '28' => 'আঠাশ',
        '29' => 'ঊনত্রিশ',
        '30' => 'ত্রিশ',
        '31' => 'একত্রিশ',
        '32' => 'বত্রিশ',
        '33' => 'তেত্রিশ',
        '34' => 'চৌত্রিশ',
        '35' => 'পঁয়ত্রিশ',
        '36' => 'ছত্রিশ',
        '37' => 'সাঁইত্রিশ',
        '38' => 'আটত্রিশ',
        '39' => 'ঊনচল্লিশ',
        '40' => 'চল্লিশ',
        '41' => 'একচল্লিশ',
        '42' => 'বিয়াল্লিশ',
        '43' => 'তেতাল্লিশ',
        '44' => 'চুয়াল্লিশ',
        '45' => 'পঁয়তাল্লিশ',
        '46' => 'ছেচল্লিশ',
        '47' => 'সাতচল্লিশ',
        '48' => 'আটচল্লিশ',
        '49' => 'ঊনপঞ্চাশ',
        '50' => 'পঞ্চাশ',
        '51' => 'একান্ন',
        '52' => 'বায়ান্ন',
        '53' => 'তিপ্পান্ন',
        '54' => 'চুয়ান্ন',
        '55' => 'পঞ্চান্ন',
        '56' => 'ছাপ্পান্ন',
        '57' => 'সাতান্ন',
        '58' => 'আটান্ন',
        '59' => 'ঊনষাট',
        '60' => 'ষাট',
        '61' => 'একষট্টি',
        '62' => 'বাষট্টি',
        '63' => 'তেষট্টি',
        '64' => 'চৌষট্টি',
        '65' => 'পঁয়ষট্টি',
        '66' => 'ছেষট্টি',
        '67' => 'সাতষট্টি',
        '68' => 'আটষট্টি',
        '69' => 'ঊনসত্তর',
        '70' => 'সত্তর',
        '71' => 'একাত্তর',
        '72' => 'বাহাত্তর',
        '73' => 'তিয়াত্তর',
        '74' => 'চুয়াত্তর',
        '75' => 'পঁচাত্তর',
        '76' => 'ছিয়াত্তর',
        '77' => 'সাতাত্তর',
        '78' => 'আটাত্তর',
        '79' => 'ঊনআশি',
        '80' => 'আশি',
        '81' => 'একাশি',
        '82' => 'বিরাশি',
        '83' => 'তিরাশি',
        '84' => 'চুরাশি',
        '85' => 'পঁচাশি',
        '86' => 'ছিয়াশি',
        '87' => 'সাতাশি',
        '88' => 'আটাশি',
        '89' => 'ঊননব্বই',
        '90' => 'নব্বই',
        '91' => 'একানব্বই',
        '92' => 'বিরানব্বই',
        '93' => 'তিরানব্বই',
        '94' => 'চুরানব্বই',
        '95' => 'পঁচানব্বই',
        '96' => 'ছিয়ানব্বই',
        '97' => 'সাতানব্বই',
        '98' => 'আটানব্বই',
        '99' => 'নিরানব্বই'
    ];
    private $units=[];

    private function __construct($number, $unit, $language = "en")
    {
        $this->number = $number;
        $this->unit = $unit;
        $this->language = $language;
        $this->units=config("number_to_word.units.$language");
    }

    public static function instance($number, $unit, $language = "en")
    {
        return new NumberConverter($number, $unit, $language);
    }

    public function word()
    {
        if ($this->language == "en") {
            $number_formatter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
            $result = $number_formatter->format($this->number);
            if (strlen($this->number) == 3) {
                if($this->unit == "hundred") {
                    $word = $result;
                }else{
                    $word = "$result {$this->units[$this->unit]}";
                }
            }else{
                $word = "$result {$this->units[$this->unit]}";
            }
        } else {
            $word = "";
            if (strlen($this->number) == 3 ) {
                $hundred = $this->numbers[(int)$this->number[0]];
                $tenth = $this->numbers[(int)($this->number[1] . $this->number[2])];
                if($this->unit == "hundred"){
                    $word = "$hundred{$this->units['hundred']} $tenth";
                }else{
                    $word = "$hundred{$this->units['hundred']} $tenth {$this->units[$this->unit]}";
                }
            } else {
                if((int)$this->number){
                    $word = "{$this->numbers[(int)$this->number]} {$this->units[$this->unit]}";
                }
            }
        }
        return $word;
    }

}
