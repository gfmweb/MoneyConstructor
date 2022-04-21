<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Roles extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'group_id'=>[
				'type'=>'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
	        'group_name'=>[
				'type'=>'VARCHAR',
		        'constraint'     => 32,
		        'null'=>false
	        ],
	        'group_description'=>[
				'type'=>'TEXT',
		        'null'=>true
	        ],
	        'created_at datetime default current_timestamp',
	        'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
		$this->forge->addPrimaryKey('group_id');
		$this->forge->createTable('groups');
    }

    public function down()
    {
       $this->forge->dropTable('groups');
    }
}
