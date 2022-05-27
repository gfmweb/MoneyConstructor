<?php

namespace App\Models;

use CodeIgniter\Model;

class LoggerModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'logs';
    protected $primaryKey       = 'log_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['log_owner','log_owner_table','log_owner_id','log_method_used','log_last_chanel_response'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
	
	/**
	 * @param $owner
	 * @param $table
	 * @param $id
	 * @param $method_name
	 * @return int
	 * @throws \ReflectionException
	 * Создает лог операции
	 */
	public function CreateLog($owner,$table,$id,$method_name):int
	{
		return $this->insert(['log_owner'=>$owner,'log_owner_table'=>$table,'log_owner_id'=>$id,'log_method_used'=>$method_name],true);
	}
	
	/**
	 * @param array $IDS
	 * @return array
	 * Возвращает все логи с указанными IDшниками (Используется как выборка всех логов по пользователю)
	 */
	public function GetLogsByIDArray(array $IDS): array
	{
		return $this->whereIn('log_id',$IDS)->get()->getResultArray();
	}
	
	/**
	 * @param string $table
	 * @param $start
	 * @param $stop
	 * @return array
	 */
	public function getLogsByOwnerTable(string $table, $startDay = null,$stopDay = null): array
	{
		if((is_null($startDay))&&(is_null($stopDay))){
			return $this->getWhere(['log_owner_table'=>$table])->getResultArray();
		}
		elseif((is_null($startDay))&&(!is_null($stopDay)))
		{
			return $this->getWhere(['log_owner_table'=>$table,'DATE(created_at) <=  DATE('.$stopDay.')']);
		}
		else
		{
			return $this->getWhere(['log_owner_table'=>$table,'DATE(created_at) <=  DATE('.$stopDay.')','DATE(created_at)  =>  DATE('.$stopDay.')']);
			
		}
	}
	
	/**
	 * @param string $methodName
	 * @return array
	 * Возврат массива использованного метода отправки
	 */
	public function getLogsByMethodName(string $methodName ,$startDay = null, $stopDay = null): array
	{
		if((is_null($startDay))&&(is_null($stopDay))) {
			return $this->getWhere(['log_method_used' => $methodName])->getResultArray();
		}
		elseif((is_null($startDay))&&(!is_null($stopDay))){
			return $this->getWhere(['log_method_used' => $methodName,'DATE(created_at) <=  DATE('.$stopDay.')'])->getResultArray();
		}
		else{
			return $this->getWhere(['log_method_used' => $methodName,'DATE(created_at) <=  DATE('.$stopDay.')','DATE(created_at)  =>  DATE('.$stopDay.')']);
		}
	}
	
}

