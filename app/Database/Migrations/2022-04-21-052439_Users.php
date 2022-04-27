<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'user_id'=>[
				'type'=>'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
	        'user_role_id'=>[
		        'type'=>'INT',
		        'constraint'     => 11,
		        'unsigned'       => true,
		        'default'        => 2
		       
	        ],
	        'user_login'=>[
				'type'=>'VARCHAR',
		        'constraint'=>32,
		        'null'=>false,
	        ],
	        'user_password'=>[
				'type'=>'TEXT',
		        'null'=>false,
	        ],
	        'user_token'=>[
		        'type'=>'TEXT',
		        'constraint'=>64,
		        'null'=>false,
	        ],
	        'user_refresh_token'=>[
		        'type'=>'TEXT',
		        'constraint'=>64,
		        'null'=>false,
	        ],
	        'user_token_expire'=>[
		        'type'=>'DATETIME',
		        'null'=>false,
	        ],
	        'user_settings'=>[
		        'type'=>'JSON',
		        'null'=>true,
	        ],
	        'created_at datetime default current_timestamp',
	        'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
			$this->forge->addPrimaryKey('user_id');
			$this->forge->addKey('user_login',false);
			
			$this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
