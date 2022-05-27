<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Logs extends Migration
{
    public function up()
    {
       $this->forge->addField([
	      'log_id'=>[
			  'type'=>'INT',
	          'constraint'     => 11,
	          'unsigned'       => true,
	          'auto_increment' => true,
		      ],
	      'log_owner'=>[
			  'type'        => 'VARCHAR',
		      'constraint'  => 32,
		      'null'        => true,
	      ],
	      'log_owner_table' =>[
		      'type'        => 'VARCHAR',
		      'constraint'  => 32,
		      'null'        => true,
	      ],
	       'log_owner_id'=>[
			   'type'           =>'INT',
		       'constraint'     => 11,
		       'unsigned'       => true,
	       ],
	       'log_method_used'=>[
		       'type'        => 'VARCHAR',
		       'constraint'  => 32,
		       'null'        => true,
	       ],
		   'log_last_chanel_response'=>[
			   'type'        => 'JSON',
			   'null'        => true
		   ],
	       'created_at datetime default current_timestamp',
	       'updated_at datetime default current_timestamp on update current_timestamp',
       ]);
	   $this->forge->addPrimaryKey('log_id');
	   $this->forge->createTable('logs');
    }

    public function down()
    {
        $this->forge->dropTable('logs');
    }
}
