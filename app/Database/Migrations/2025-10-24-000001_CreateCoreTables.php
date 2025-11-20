<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCoreTables extends Migration
{
    public function up()
    {
        // experiments
        if (! $this->db->tableExists('experiments')) {
            $this->forge->addField([
                'id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'name' => ['type' => 'VARCHAR', 'constraint' => 255],
                'date' => ['type' => 'DATE'],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('experiments');
        }

        // productions
        if (! $this->db->tableExists('productions')) {
            $this->forge->addField([
                'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'experiment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
                'species'       => ['type' => 'VARCHAR', 'constraint' => 255],
                'fno'           => ['type' => 'FLOAT'],
                'fwt'           => ['type' => 'FLOAT'],
                'mno'           => ['type' => 'FLOAT'],
                'mwt'           => ['type' => 'FLOAT'],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('productions');
        }

        // spawns
        if (! $this->db->tableExists('spawns')) {
            $this->forge->addField([
                'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'production_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
                'experiment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
                'quantity'      => ['type' => 'FLOAT'],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('spawns');
        }

        // frys
        if (! $this->db->tableExists('frys')) {
            $this->forge->addField([
                'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'experiment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
                'production_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
                'quantity'      => ['type' => 'FLOAT'],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('frys');
        }

        // semifingers
        if (! $this->db->tableExists('semifingers')) {
            $this->forge->addField([
                'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'experiment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
                'production_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
                'quantity'      => ['type' => 'FLOAT'],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('semifingers');
        }

        // fingerlings
        if (! $this->db->tableExists('fingerlings')) {
            $this->forge->addField([
                'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'experiment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
                'production_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
                'quantity'      => ['type' => 'FLOAT'],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('fingerlings');
        }
    }

    public function down()
    {
        $this->forge->dropTable('fingerlings', true);
        $this->forge->dropTable('semifingers', true);
        $this->forge->dropTable('frys', true);
        $this->forge->dropTable('spawns', true);
        $this->forge->dropTable('productions', true);
        $this->forge->dropTable('experiments', true);
    }
}

