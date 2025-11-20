<div class="row">
    <div class="card shadow mb-4 w-100">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Brood Sale</h6>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#broodSaleModal">
                Add Sale
            </button>
        </div>
        <div class="card-body">
            <small class="text-muted">Use the button above to add a sale.</small>
        </div>
    </div>
</div>

<!-- Brood Sale Modal -->
<div class="modal fade" id="broodSaleModal" tabindex="-1" role="dialog" aria-labelledby="broodSaleLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="broodSaleLabel">Add Brood Sale</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Species</label>
                    <input type="text" name="species" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Females</label>
                    <input type="number" name="females" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Males</label>
                    <input type="number" name="males" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Unit Price</label>
                    <input type="number" step="0.01" name="unit_price" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Female Wt</label>
                    <input type="text" name="female_weight" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Male Wt</label>
                    <input type="text" name="male_weight" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Total Amount</label>
                    <input type="number" step="0.01" name="total_amount" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Buyer</label>
                    <input type="text" name="buyer" class="form-control">
                </div>
                <div class="form-group col-md-6">
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
                    <th>Females</th>
                    <th>Males</th>
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
                        <td><?= esc($s['females']) ?></td>
                        <td><?= esc($s['males']) ?></td>
                        <td><?= esc($s['buyer']) ?></td>
                        <td><?= esc($s['total_amount']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
