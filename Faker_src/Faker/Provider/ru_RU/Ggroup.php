<?php

namespace Faker\Provider\ru_RU;

class Ggroup extends \Faker\Provider\Company
{
    protected static $ggnames = array(
		'Smart Watch',
		'Акустика',
		'Внешние аккумуляторы',
		'Для iPad',
		'Зарядные устройства',
		'Защитные стёкла и плёнки',
		'Кабели и переходники',
		'Наушники и гарнитуры',
		'Прочее',
		'Чехлы для iPad Mini',
		'Чехлы и обложки для iPad 2/3/4',
		'Чехлы и обложки для iPad Air 2',
		'Для iPhone',
		'Чехлы для iPhone 4/4S',
		'Чехлы для iPhone 5/5S',
		'Чехлы для iPhone 6 Plus/6S Plus',
		'Чехлы для iPhone 6/6S',
		'Для Samsung',
		'Чехлы для Galaxy Alpha',
		'Чехлы для Galaxy Note 2',
		'Чехлы для Galaxy Note 3',
		'Чехлы для Galaxy Note 4',
		'Чехлы для Galaxy Note 5',
		'Чехлы для Galaxy S3',
		'Чехлы для Galaxy S4',
		'Чехлы для Galaxy S5',
		'Чехлы для Galaxy S6',
		'Чехлы для Galaxy S6 Edge',
		'Распродажа',
	);

    public static function ggname()
    {
        return static::randomElement(static::$ggnames);
    }
}