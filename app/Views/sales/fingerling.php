<div class="row">
    <div class="card shadow mb-4 w-100">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Seed Sale (All Stages)</h6>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#fingerlingSaleModal">
                Add Sale
            </button>
        </div>
        <div class="card-body">
            <small class="text-muted">Use the button above to record spawn, fry, semifinger or fingerling sales.</small>
        </div>
    </div>
</div>

<!-- Seed Sale Modal -->
<div class="modal fade" id="fingerlingSaleModal" tabindex="-1" role="dialog" aria-labelledby="fingerlingSaleLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fingerlingSaleLabel">Add Seed Sale</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Experiment</label>
                    <select name="experiment_id" class="form-control">
                        <option value="">-- optional --</option>
                        <?php foreach ($experiments as $e) { ?>
                            <option value="<?= $e['id'] ?>"><?= esc($e['name']) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Production</label>
                    <select name="production_id" class="form-control">
                        <option value="">-- optional --</option>
                        <?php foreach ($productions as $p) { ?>
                            <option value="<?= $p['id'] ?>"><?= esc($p['species']) ?> #<?= $p['id'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label>Species</label>
                    <input type="text" name="species" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Stage</label>
                    <select name="stage" class="form-control">
                        <?php foreach ($stages as $key => $label) { ?>
                            <option value="<?= esc($key) ?>"<?= $key === 'fingerling' ? ' selected' : '' ?>><?= esc($label) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Quantity</label>
                    <input type="number" step="0.01" name="quantity" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <label>Unit Price</label>
                    <input type="number" step="0.01" name="unit_price" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Total Amount</label>
                    <input type="number" step="0.01" name="total_amount" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Buyer</label>
                    <input type="text" name="buyer" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Remarks</label>
                    <input type="text" name="remarks" class="form-control">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sales</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Date</th>
                    <th>Species</th>
                    <th>Stage</th>
                    <th>Qty</th>
                    <th>Buyer</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($sales as $s) { ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= esc($s['date']) ?></td>
                        <td><?= esc($s['species']) ?></td>
                        <td><?= esc($stages[$s['stage'] ?? 'fingerling'] ?? ($s['stage'] ?? '')) ?></td>
                        <td><?= esc($s['quantity']) ?></td>
                        <td><?= esc($s['buyer']) ?></td>
                        <td><?= esc($s['total_amount']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
