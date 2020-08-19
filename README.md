#####Laravel Library for converting number to word both for **Bangla & English**
To install this library follow the following steps:
* **composer require s1k3/bangla-number-to-word**
* **(You may skip this step when using Laravel >= 5.5))**. Navigate to the path/to/config/app.php and add  to the providers array
 ``` php
 'providers' => [
        S1K3\Bangla\Number\To\Word\NumberToWordServiceProvider::class
 ]
 ```
* Execute the following command from the command-line to publish the configuration file config/number_to_word.php
``` php
php artisan vendor:publish --provider="S1K3\Bangla\Number\To\Word\NumberToWordServiceProvider"
```

***Basic Usage***
```php
number_to_word("1556.62","bn"); //এক হাজার পাঁচশত ছাপ্পান্ন টাকা বাষট্টি পয়সা
```
Second parameter is optional if it not given then configuration's ***language*** value will be used.
```php
number_to_word("155342262");//পনের কোটি তিপ্পান্ন লক্ষ বিয়াল্লিশ হাজার দুইশত বাষট্টি টাকা
```
```php
number_to_word("15262","en");//fifteen thousand two hundred sixty-two taka
```
***Configuration(config/number_to_word.php)***
```php
return [
    'language' => 'bn',
    'unit' => [
        'en' => 'taka',
        'bn' => 'টাকা'
    ],
    'units' => [
        'en' => [
            'crore' => 'crore',
            'lac' => 'lac',
            'thousand' => 'thousand',
            'hundred' => 'hundred',
            'paisa' => 'cent'
        ],
        'bn' => [
            'crore' => 'কোটি',
            'lac' => 'লক্ষ',
            'thousand' => 'হাজার',
            'hundred' => 'শত',
            'paisa' => 'পয়সা'
        ]
    ]
];

```
Value | Description
------------ | -------------
language | The default language it can either be **en**(For English) or **bn**(For Bangla) 
unit | Currency name for Bangla and English
units | Money units for Bangla and English

