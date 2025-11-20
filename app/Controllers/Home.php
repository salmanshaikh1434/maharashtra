<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = db_connect();

        $firstOfMonth = date('Y-m-01');
        $today = date('Y-m-d');

        // Revenue this month (fingerling + brood)
        $revFinger = (float) ($db->table('fingerling_sales')
            ->select('COALESCE(SUM(total_amount),0) as t')
            ->where('date >=', $firstOfMonth)
            ->where('date <=', $today)
            ->get()->getRowArray()['t'] ?? 0);
        $revBrood = (float) ($db->table('brood_sales')
            ->select('COALESCE(SUM(total_amount),0) as t')
            ->where('date >=', $firstOfMonth)
            ->where('date <=', $today)
            ->get()->getRowArray()['t'] ?? 0);
        $revenueMonth = $revFinger + $revBrood;

        // Active experiments this month
        $experimentsMonth = (int) ($db->table('experiments')
            ->where('date >=', $firstOfMonth)
            ->where('date <=', $today)
            ->countAllResults());

        // Brood totals
        $broodAgg = $db->table('brood_stocks')
            ->select('COALESCE(SUM(females),0) as females, COALESCE(SUM(males),0) as males, COALESCE(SUM(COALESCE(female_weight,0)),0) as female_weight, COALESCE(SUM(COALESCE(male_weight,0)),0) as male_weight')
            ->get()->getRowArray();
        $broodTotals = [
            'females' => (int) ($broodAgg['females'] ?? 0),
            'males' => (int) ($broodAgg['males'] ?? 0),
            'female_weight' => (float) ($broodAgg['female_weight'] ?? 0),
            'male_weight' => (float) ($broodAgg['male_weight'] ?? 0),
        ];

        // Stock totals by stage (overall)
        $stockTotals = [
            'spawn' => (float) ($db->table('spawns')->select('COALESCE(SUM(quantity),0) as t')->get()->getRowArray()['t'] ?? 0),
            'fry' => (float) ($db->table('frys')->select('COALESCE(SUM(quantity),0) as t')->get()->getRowArray()['t'] ?? 0),
            'semi' => (float) ($db->table('semifingers')->select('COALESCE(SUM(quantity),0) as t')->get()->getRowArray()['t'] ?? 0),
            'finger' => (float) ($db->table('fingerlings')->select('COALESCE(SUM(quantity),0) as t')->get()->getRowArray()['t'] ?? 0),
        ];

        // Last 5 productions (with date)
        $recentProductions = $db->table('productions p')
            ->select('p.species, p.fno, p.fwt, p.mno, p.mwt, e.date')
            ->join('experiments e', 'e.id = p.experiment_id')
            ->orderBy('e.date', 'DESC')
            ->limit(5)
            ->get()->getResultArray();

        // Last 5 sales (merged fingerling + brood)
        $fingerSales = $db->table('fingerling_sales')
            ->select('date, species, COALESCE(total_amount,0) as total_amount, quantity as qty, "Fingerling" as type')
            ->orderBy('date','DESC')->limit(5)->get()->getResultArray();
        $broodSales = $db->table('brood_sales')
            ->select('date, species, COALESCE(total_amount,0) as total_amount, (COALESCE(females,0)+COALESCE(males,0)) as qty, "Brood" as type')
            ->orderBy('date','DESC')->limit(5)->get()->getResultArray();
        $recentSales = array_slice((function($a,$b){ $m=array_merge($a,$b); usort($m,function($x,$y){ return strcmp($y['date'],$x['date']);}); return $m;} )($fingerSales,$broodSales),0,5);

        // Revenue by month for last 6 months
        $labels = [];
        $series = [];
        for ($i = 5; $i >= 0; $i--) {
            $ym = date('Y-m', strtotime("-$i months"));
            $start = $ym . '-01';
            $end = date('Y-m-t', strtotime($start));
            $rf = (float) ($db->table('fingerling_sales')->select('COALESCE(SUM(total_amount),0) as t')->where('date >=', $start)->where('date <=', $end)->get()->getRowArray()['t'] ?? 0);
            $rb = (float) ($db->table('brood_sales')->select('COALESCE(SUM(total_amount),0) as t')->where('date >=', $start)->where('date <=', $end)->get()->getRowArray()['t'] ?? 0);
            $labels[] = date('M Y', strtotime($start));
            $series[] = $rf + $rb;
        }

        $page = [
            'metrics' => [
                'revenue_month' => $revenueMonth,
                'experiments_month' => $experimentsMonth,
                'fingerlings_qty' => $stockTotals['finger'],
                'brood_total' => $broodTotals['females'] + $broodTotals['males'],
            ],
            'brood_totals' => $broodTotals,
            'stock_totals' => $stockTotals,
            'recent_productions' => $recentProductions,
            'recent_sales' => $recentSales,
            'revenue_labels' => $labels,
            'revenue_series' => $series,
        ];

        $data['page'] = view('dashboard', $page);
        return view('template', $data);
    }
  
}
