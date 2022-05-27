<?php

namespace App\Models;

use CodeIgniter\Model;

class JobsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jobs';
    protected $primaryKey       = 'job_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['job_method','job_status','job_logs','job_overall_summ','job_finish'];

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
	
	public function CreateJob( string $MenthodName):int
	{
		return $this->insert(['job_method'=>json_encode($MenthodName,256),'job_status'=>'Первичное выполнение','job_logs'=>json_encode([],256)],true);
	}
	
	public function UpdateResults(int $id, string $results)
	{
		$current_log = $this->getWhere(['job_id'=>$id])->getResultArray();
		if(isset($current_log[0]['job_logs'])){
			$current_log[0]['job_logs'] = json_decode($current_log[0]['job_logs'],true);
			
		}
		$current_log[0]['job_logs'][] =$results;
		return $this->update($id,['job_logs'=>json_encode($current_log[0]['job_logs'],true)]);
	}
}
