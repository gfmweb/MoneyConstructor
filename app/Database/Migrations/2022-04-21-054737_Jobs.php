<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jobs extends Migration
{
    public function up()
    {
      $this->forge->addField([
		 'job_id'=>[
			 'type'=>'INT',
			 'constraint'     => 11,
			 'unsigned'       => true,
			 'auto_increment' => true,
		 ],
	      'job_method'=>[
			'type'=>'JSON',
		    'null'=>true
	      ],
	      'job_status'=>[
			'type'=>'VARCHAR',
		    'constraint'=>32,
		    'default'=>'В процессе выполнения'
	      ],
	      'job_logs'=>[
			  'type'=>'JSON',
		      'null'=>true
	      ],
	      'job_overall_summ'=>[
		      'type'=>'INT',
		      'constraint'     => 11,
		      'unsigned'       => true,
		      'default'=>0
	      ],
	      'job_finish'=>[
				'type'=>'BOOLEAN',
		        'default'=>false,
	      ],
	      'created_at datetime default current_timestamp',
	      'updated_at datetime default current_timestamp on update current_timestamp',
      ]);
	    $this->forge->addPrimaryKey('job_id');
	    $this->forge->createTable('jobs');
    }

    public function down()
    {
		$this->forge->dropTable('jobs');
    }
}
