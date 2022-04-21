<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RequestsHistory extends Migration
{
    public function up()
    {
       $this->forge->addField([
		  'history_id'=>[
			  'type'=>'INT',
			  'constraint'     => 11,
			  'unsigned'       => true,
			  'auto_increment' => true,
		  ],
	      'request_id'=>[
				'type'=>'VARCHAR',
		        'constraint'=>64,
		        'null'=>false,
	      ],
	      'request_body'=>[
				'type'=>'TEXT',
		        'null'=>true,
	      ],
	       'request_result'=>[
			   'type'=>'INT',
		       'constraint'     => 11,
		       'unsigned'       => true,
		       'comment'=>' Ссылка на таблицу Jobs'
	       ],
		   
	       'created_at datetime default current_timestamp',
	       'updated_at datetime default current_timestamp on update current_timestamp',
       ]);
	    $this->forge->addPrimaryKey('history_id');
		$this->forge->addKey('request_id',false);
		$this->forge->createTable('requests_history');
    }

    public function down()
    {
        $this->forge->dropTable('requests_history');
    }
}
