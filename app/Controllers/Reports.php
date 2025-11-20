<?php

namespace App\Controllers;

use App\Models\Experiment;
use App\Models\Production;
use App\Models\Spawn;
use App\Models\Fry;
use App\Models\Semifingerling;
use App\Models\Fingerling;
use App\Models\FingerlingSale;
use App\Models\BroodStock;
use CodeIgniter\Database\BaseBuilder;

class Reports extends BaseController
{
    private function daterange()
    {
        $start = $this->request->getGet('start');
        $end   = $this->request->getGet('end');
        $species = $this->request->getGet('species');
        $stage = $this->request->getGet('stage');
        return [
            'start' => $start ?: null,
            'end' => $end ?: null,
            'species' => $species ?: null,
            'stage' => $stage ?: null,
        ];
    }

    public function stock()
    {
        $db = db_connect();
        $filters = $this->daterange();
        $whereDate = function (BaseBuilder $b) use ($filters) {
            if ($filters['start']) {
                $b->where('e.date >=', $filters['start']);
            }
            if ($filters['end']) {
                $b->where('e.date <=', $filters['end']);
            }
            if ($filters['species']) {
                $b->where('p.species', $filters['species']);
            }
        };

        // sum per species for each stage
        $stages = [
            'spawn' => ['table' => 'spawns',      'alias' => 's'],
            'fry'   => ['table' => 'frys',        'alias' => 'f'],
            'semi'  => ['table' => 'semifingers', 'alias' => 'sf'],
            'finger'=> ['table' => 'fingerlings', 'alias' => 'fg'],
        ];

        $summary = [];
        foreach ($stages as $key => $meta) {
            $builder = $db->table($meta['table'] . ' ' . $meta['alias'])
                ->select('p.species, SUM(' . $meta['alias'] . '.quantity) as qty')
                ->join('productions p', 'p.id = ' . $meta['alias'] . '.production_id')
                ->join('experiments e', 'e.id = ' . $meta['alias'] . '.experiment_id');
            $whereDate($builder);
            $summary[$key] = $builder->groupBy('p.species')->get()->getResultArray();
        }

        $page = [
            'summary' => $summary,
            'filters' => $filters,
        ];
        $data['page'] = view('reports/stock', $page);
        return view('template', $data);
    }

    public function sales()
    {
        $filters = $this->daterange();
        $builder = db_connect()->table('fingerling_sales')
            ->select('stage, species, SUM(quantity) qty, SUM(COALESCE(total_amount,0)) revenue');
        if ($filters['start']) $builder->where('date >=', $filters['start']);
        if ($filters['end']) $builder->where('date <=', $filters['end']);
        if ($filters['species']) $builder->where('species', $filters['species']);
        if ($filters['stage']) $builder->where('stage', $filters['stage']);
        $grouped = $builder->groupBy(['stage','species'])->get()->getResultArray();

        $list = db_connect()->table('fingerling_sales')
            ->select('*')
            ->orderBy('date','desc');
        if ($filters['start']) $list->where('date >=', $filters['start']);
        if ($filters['end']) $list->where('date <=', $filters['end']);
        if ($filters['species']) $list->where('species', $filters['species']);
        if ($filters['stage']) $list->where('stage', $filters['stage']);
        $rows = $list->get()->getResultArray();

        $page = [
            'grouped' => $grouped,
            'rows' => $rows,
            'filters' => $filters,
        ];
        $data['page'] = view('reports/sales', $page);
        return view('template', $data);
    }

    public function production()
    {
        $filters = $this->daterange();
        $b = db_connect()->table('productions p')
            ->select('p.species, COUNT(p.id) as batches, SUM(p.fno) fno, SUM(p.fwt) fwt, SUM(p.mno) mno, SUM(p.mwt) mwt')
            ->join('experiments e', 'e.id = p.experiment_id');
        if ($filters['start']) $b->where('e.date >=', $filters['start']);
        if ($filters['end']) $b->where('e.date <=', $filters['end']);
        if ($filters['species']) $b->where('p.species', $filters['species']);
        $summary = $b->groupBy('p.species')->get()->getResultArray();

        $page = [
            'summary' => $summary,
            'filters' => $filters,
        ];
        $data['page'] = view('reports/production', $page);
        return view('template', $data);
    }

    public function brood()
    {
        $filters = $this->daterange();
        $b = db_connect()->table('brood_stocks')
            ->select('species, SUM(females) females, SUM(males) males, SUM(COALESCE(female_weight,0)) female_weight, SUM(COALESCE(male_weight,0)) male_weight');
        if ($filters['start']) $b->where('date >=', $filters['start']);
        if ($filters['end']) $b->where('date <=', $filters['end']);
        if ($filters['species']) $b->where('species', $filters['species']);
        $summary = $b->groupBy('species')->get()->getResultArray();

        $page = [
            'summary' => $summary,
            'filters' => $filters,
        ];
        $data['page'] = view('reports/brood', $page);
        return view('template', $data);
    }
}
