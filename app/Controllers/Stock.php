<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Experiment;
use App\Models\Fingerling;
use App\Models\Fry;
use App\Models\Production;
use App\Models\Semifingerling;

use App\Models\Spawn;

class Stock extends BaseController
{
  public function advance()
  {
    // Run the stock:advance CLI command from the web UI
    $spark = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg(ROOTPATH . 'spark') . ' stock:advance';
    $message = 'Stock advance triggered.';
    try {
      if (function_exists('shell_exec')) {
        $output = shell_exec($spark);
        $message .= ' Check logs for full details.';
        if ($output) {
          log_message('info', 'stock:advance output: ' . trim($output));
        }
      } else {
        $message = 'Unable to run advance: shell_exec is disabled on this server.';
      }
    } catch (\Throwable $e) {
      $message = 'Stock advance failed: ' . $e->getMessage();
      log_message('error', $message);
    }

    return redirect()->back()->with('message', $message);
  }

  public function production($id = null, $action = null)
  {
    $produce = new Production();
    $expert = new Experiment();
    $spawn = new Spawn();
    $fry = new Fry();
    $semi = new Semifingerling();
    $fingerling = new Fingerling();
    $page['info'] = [];
    if ($action == 'delete') {
      $produce->delete($id);
    }
    if ($this->request->getMethod() == 'post') {
      $post = $this->request->getPost();
      if ($id != null) {
        $produce->update($id, $post);
        $quantity = $post['fwt'] * 0.80;
        // persist updated spawn quantity for this production
        $spawn->where('production_id', $id)->set('quantity', $quantity)->update();
      } else {

        $produce->insert($post);
        $data['production_id'] = $produce->insertID();
        $data['quantity'] = $post['fwt'] * 0.80;
        $data['experiment_id'] = $post['experiment_id'];
        $spawn->insert($data);
      }
    }

    // Info for edit form
    $page['info'] = $produce->find($id);

    $page['experiments'] = $expert->findAll();
    $page['data'] = $produce->select('productions.*,e.name,e.date,e.id as exp_id')->join('experiments as e', 'e.id = productions.experiment_id')->findAll();
    $data['page'] = view('stock/production', $page);
    return view('template', $data);
  }


  public function experiment($id = null, $action = null)
  {
    $expert = new Experiment();
    $page['info'] = [''];
    if ($action == 'delete') {
      $expert->delete($id);
    }
    if ($this->request->getMethod() == 'post') {
      $post = $this->request->getPost();
      if ($id != null && $action == null) {
        $expert->update($id, $post);
      } else {
        $expert->insert($post);
      }
    }
    if ($id != null) {
      $page['info'] = $expert->find($id);
    }
    $page['data'] = $expert->findAll();
    $data['page'] = view('stock/experiment', $page);
    return view('template', $data);
  }


  public function fingerling()
  {
    $finger = new Fingerling();
    $page['fingerling'] = $finger->select('fingerlings.quantity,p.species,e.name,p.fno,p.fwt,p.mno,p.mwt')
      ->join('productions as p', 'p.id = fingerlings.production_id')
      ->join('experiments as e', 'e.id = fingerlings.experiment_id')
      ->findAll();
    $data['page'] = view('stock/fingerling', $page);
    return view('template', $data);
  }
  public function fry()
  {
    $fry = new Fry();
    $page['fry'] = $fry->select('frys.quantity,p.species,e.name,p.fno,p.fwt,p.mno,p.mwt')
      ->join('productions as p', 'p.id = frys.production_id')
      ->join('experiments as e', 'e.id = frys.experiment_id')
      ->findAll();
    $data['page'] = view('stock/fry', $page);
    return view('template', $data);
  }
  public function semifinger()
  {
    $semi = new Semifingerling();
    $page['semifinger'] = $semi->select('semifingers.quantity,p.species,e.name,p.fno,p.fwt,p.mno,p.mwt')
      ->join('productions as p', 'p.id = semifingers.production_id')
      ->join('experiments as e', 'e.id = semifingers.experiment_id')
      ->findAll();
    $data['page'] = view('stock/semifinger', $page);
    return view('template', $data);
  }
  public function spawn()
  {
    $spw = new Spawn();
    $page['spawn'] = $spw->select('spawns.quantity,p.species,e.name,p.fno,p.fwt,p.mno,p.mwt')
      ->join('productions as p', 'p.id = spawns.production_id')
      ->join('experiments as e', 'e.id = spawns.experiment_id')
      ->findAll();
    $data['page'] = view('stock/spawn', $page);
    return view('template', $data);
  }
}
