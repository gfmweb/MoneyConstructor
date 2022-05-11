<?php

namespace App\Models;

use CodeIgniter\Model;

class DataSourceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'datasources';
    protected $primaryKey       = 'source_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['source_name','source_setup','source_methods','source_permissions'];

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
	
	
	public function getAllAllowedDataSources(int $user_id): array{
	 return $this->db->query('SELECT source_id,source_name FROM datasources WHERE 1 ORDER BY source_id ASC ')->getResultArray();
	}
	
	public function newChanel($name,$code){
		return $this->insert(['source_name'=>$name,'source_methods'=>json_encode($code,256)]);
	}
	
	public function editChanel($id,$name,$code)	{
		return $this->update($id,['source_name'=>$name,'source_methods'=>json_encode($code,256)]);
	}
	
	public function getChanelByID($id){
		return $this->getWhere(['source_id'=>$id])->getResultArray();
	}
	
	public function delChanel($id){
		return $this->delete($id);
	}
	
	public function getChanelByName($name){
		return $this->select(['source_id','source_setup','source_methods'])->getWhere(['source_name'=>$name])->getResultArray();
	}
	

}
