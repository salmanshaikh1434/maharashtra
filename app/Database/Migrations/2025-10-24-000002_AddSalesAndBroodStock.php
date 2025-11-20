<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSalesAndBroodStock extends Migration
{
    public function up()
    {
        // Brood stock batches
        if (! $this->db->tableExists('brood_stocks')) {
            $this->forge->addField([
                'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'species'        => ['type' => 'VARCHAR', 'constraint' => 255],
                'females'        => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
                'female_weight'  => ['type' => 'FLOAT', 'null' => true],
                'males'          => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
                'male_weight'    => ['type' => 'FLOAT', 'null' => true],
                'date'           => ['type' => 'DATE', 'null' => true],
                'notes'          => ['type' => 'TEXT', 'null' => true],
                'created_at'     => ['type' => 'DATETIME', 'null' => true],
                'updated_at'     => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('brood_stocks');
        }

        // Fingerling sales
        if (! $this->db->tableExists('fingerling_sales')) {
            $this->forge->addField([
                'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'experiment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
                'production_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
                'species'       => ['type' => 'VARCHAR', 'constraint' => 255],
                'quantity'      => ['type' => 'FLOAT'],
                'unit_price'    => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
                'total_amount'  => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
                'buyer'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'date'          => ['type' => 'DATE', 'null' => true],
                'remarks'       => ['type' => 'TEXT', 'null' => true],
                'created_at'    => ['type' => 'DATETIME', 'null' => true],
                'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('fingerling_sales');
        }

        // Brood sales
        if (! $this->db->tableExists('brood_sales')) {
            $this->forge->addField([
                'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'brood_stock_id'=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
                'species'       => ['type' => 'VARCHAR', 'constraint' => 255],
                'females'       => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
                'males'         => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
                'female_weight' => ['type' => 'FLOAT', 'null' => true],
                'male_weight'   => ['type' => 'FLOAT', 'null' => true],
                'unit_price'    => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
                'total_amount'  => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
                'buyer'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'date'          => ['type' => 'DATE', 'null' => true],
                'remarks'       => ['type' => 'TEXT', 'null' => true],
                'created_at'    => ['type' => 'DATETIME', 'null' => true],
                'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('brood_sales');
        }
    }

    public function down()
    {
        $this->forge->dropTable('brood_sales', true);
        $this->forge->dropTable('fingerling_sales', true);
        $this->forge->dropTable('brood_stocks', true);
    }
}

