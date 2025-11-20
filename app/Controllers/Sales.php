<?php

namespace App\Controllers;

use App\Models\FingerlingSale;
use App\Models\BroodSale;
use App\Models\Experiment;
use App\Models\Production;

class Sales extends BaseController
{
    public function fingerling()
    {
        $sale = new FingerlingSale();
        $experiments = (new Experiment())->findAll();
        $productions = (new Production())->findAll();
        $stages = [
            'spawn'       => 'Spawn',
            'fry'         => 'Fry',
            'semifinger'  => 'Semi-fingerling',
            'fingerling'  => 'Fingerling',
        ];

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost([
                'experiment_id','production_id','species','stage','quantity','unit_price','total_amount','buyer','date','remarks'
            ]);
            $data['stage'] = $data['stage'] ?: 'fingerling';
            // Calculate total if not provided
            if (empty($data['total_amount']) && ! empty($data['unit_price']) && ! empty($data['quantity'])) {
                $data['total_amount'] = (float)$data['unit_price'] * (float)$data['quantity'];
            }
            $sale->insert($data);
            return redirect()->to('/sales/fingerling');
        }

        $page['sales'] = $sale->orderBy('id','desc')->findAll();
        $page['experiments'] = $experiments;
        $page['productions'] = $productions;
        $page['stages'] = $stages;
        $data['page'] = view('sales/fingerling', $page);
        return view('template', $data);
    }

    public function brood()
    {
        $sale = new BroodSale();
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost([
                'brood_stock_id','species','females','males','female_weight','male_weight','unit_price','total_amount','buyer','date','remarks'
            ]);
            if (empty($data['total_amount']) && ! empty($data['unit_price'])) {
                $qty = ((int)($data['females'] ?? 0)) + ((int)($data['males'] ?? 0));
                $data['total_amount'] = (float)$data['unit_price'] * (float)$qty;
            }
            $sale->insert($data);
            return redirect()->to('/sales/brood');
        }

        $page['sales'] = $sale->orderBy('id','desc')->findAll();
        $data['page'] = view('sales/brood', $page);
        return view('template', $data);
    }
}
