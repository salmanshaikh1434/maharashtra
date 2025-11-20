<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStageToFingerlingSales extends Migration
{
    public function up()
    {
        // Add a stage column so we can sell spawn/fry/semi/fingerling batches
        if ($this->db->tableExists('fingerling_sales') && ! $this->db->fieldExists('stage', 'fingerling_sales')) {
            $this->forge->addColumn('fingerling_sales', [
                'stage' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'default'    => 'fingerling',
                    'after'      => 'species',
                ],
            ]);
        }
    }

    public function down()
    {
        if ($this->db->tableExists('fingerling_sales') && $this->db->fieldExists('stage', 'fingerling_sales')) {
            $this->forge->dropColumn('fingerling_sales', 'stage');
        }
    }
}
