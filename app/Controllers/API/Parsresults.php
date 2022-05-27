<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;


/**
 *  Контроллер парсинга результатов работы методов
 */
class Parsresults extends BaseController
{
	public function Parse($methodName,$methodResults)
	{
		if ($methodName == 'Телеграм'){
			return $this->ParseTelegram($methodResults);
		}
	}
	
	
    public function ParseTelegram($telegramRersults): array
    {
        return ['status'=>'finish','time'=>time()];
    }
}
