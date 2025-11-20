<?php

namespace App\Commands;

use App\Models\Experiment;
use App\Models\Spawn;
use App\Models\Fry;
use App\Models\Semifingerling;
use App\Models\Fingerling;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Services;

class AdvanceStock extends BaseCommand
{
    protected $group       = 'stock';
    protected $name        = 'stock:advance';
    protected $description = 'Moves stock between stages (spawn → fry → semifinger → fingerling) based on experiment dates (+15/+30/+45 days).';

    public function run(array $params)
    {
        $runId = bin2hex(random_bytes(4));
        $startedAt = date('Y-m-d H:i:s');
        log_message('info', "AdvanceStock run={$runId} started at {$startedAt}");
        CLI::write("[AdvanceStock] run={$runId} started at {$startedAt}");
        $db = Services::database();
        $experiments = (new Experiment())->select('id,date')->findAll();
        $today = date('Y-m-d');

        $spawnModel = new Spawn();
        $fryModel = new Fry();
        $semiModel = new Semifingerling();
        $fingerModel = new Fingerling();

        $moved = [
            'spawn_to_fry' => 0,
            'fry_to_semi' => 0,
            'semi_to_finger' => 0,
        ];

        $processed = 0;
        foreach ($experiments as $exp) {
            $processed++;
            $expdate = strtotime($exp['date']);
            $day15 = date('Y-m-d', strtotime('+15 days', $expdate));
            $day30 = date('Y-m-d', strtotime('+30 days', $expdate));
            $day45 = date('Y-m-d', strtotime('+45 days', $expdate));

            $db->transStart();
            try {
                if ($today === $day15) {
                    $spawns = $spawnModel->where('experiment_id', $exp['id'])->findAll();
                    if (! empty($spawns)) {
                        foreach ($spawns as &$row) {
                            $row['quantity'] = (float) $row['quantity'] * 0.30;
                            unset($row['id']);
                        }
                        if (! empty($spawns)) {
                            $fryModel->insertBatch($spawns);
                            $spawnModel->where('experiment_id', $exp['id'])->delete();
                            $moved['spawn_to_fry'] += count($spawns);
                        }
                    }
                }

                if ($today === $day30) {
                    $frys = $fryModel->where('experiment_id', $exp['id'])->findAll();
                    if (! empty($frys)) {
                        foreach ($frys as &$row) {
                            $row['quantity'] = (float) $row['quantity'] / 1.5;
                            unset($row['id']);
                        }
                        if (! empty($frys)) {
                            $semiModel->insertBatch($frys);
                            $fryModel->where('experiment_id', $exp['id'])->delete();
                            $moved['fry_to_semi'] += count($frys);
                        }
                    }
                }

                if ($today === $day45) {
                    $semis = $semiModel->where('experiment_id', $exp['id'])->findAll();
                    if (! empty($semis)) {
                        foreach ($semis as &$row) {
                            $row['quantity'] = (float) $row['quantity'] / 2;
                            unset($row['id']);
                        }
                        if (! empty($semis)) {
                            $fingerModel->insertBatch($semis);
                            $semiModel->where('experiment_id', $exp['id'])->delete();
                            $moved['semi_to_finger'] += count($semis);
                        }
                    }
                }

                $db->transCommit();
            } catch (\Throwable $e) {
                $db->transRollback();
                $msg = 'Error advancing stock for experiment ID ' . $exp['id'] . ': ' . $e->getMessage();
                CLI::error($msg);
                log_message('error', "AdvanceStock run={$runId} " . $msg);
            }
        }

        $endedAt = date('Y-m-d H:i:s');
        $summary = 'Advance complete: ' . json_encode($moved) .
                   " | run={$runId} processed_experiments={$processed} finished_at={$endedAt}";
        CLI::write($summary);
        log_message('info', $summary);
    }
}
