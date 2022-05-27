<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoggerModel;
class Logger extends BaseController
{
	
    public function log_job( string $log_owner, string $log_owner_table, int $log_owner_id, string $method,$results): string
    {
        $LogModel = model(LoggerModel::class);
		
	    $id = $LogModel->CreateLog($log_owner,$log_owner_table,$log_owner_id,$method);
	    
	    return $id;
    }
	
	
}
