<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataSource extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'source_id'=>[
				'type'=>'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
	        'source_name'=>[
				'type'=>'VARCHAR',
		        'constraint'=>32,
		        'unique'=>true,
		        'null'=>false,
	        ],
	        'source_constants'=>[
				'type'=>'JSON',
		        'null'=>true
	        ],
	        'source_methods'=>[
				'type'=>'JSON',
				'null'=>true,
	        ],
	        'source_permissions'=>[
				'type'=>'JSON',
		        'null'=>true
	        ],
			'source_log_rules'=>[
				'type'=>'JSON',
				'null'=>true,
			],
			'source_get_result_method'=>[
				'type'=>'JSON',
				'null'=>true
			],
	        'created_at datetime default current_timestamp',
	        'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
		$this->forge->addPrimaryKey('source_id');
		$this->forge->createTable('datasources');
    }

    public function down()
    {
        $this->forge->dropTable('datasources');
    }
}
