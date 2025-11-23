<?php

namespace App\Controllers;

use App\Models\BroodStock;

class Brood extends BaseController
{
    public function index($id = null, $action = null)
    {
        $model = new BroodStock();

        if ($action === 'delete' && $id) {
            $model->delete($id);
            return redirect()->to('/brood');
        }

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost([
                'species','females','female_weight','males','male_weight','date','notes'
            ]);
            if ($id) {
                $model->update($id, $data);
            } else {
                $model->insert($data);
            }
            return redirect()->to('/brood');
        }

        $page['info'] = $id ? $model->find($id) : null;
        $page['data'] = $model->orderBy('id','desc')->findAll();
        $data['page'] = view('brood/index', $page);
        return view('template', $data);
    }
}

