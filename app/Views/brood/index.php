<div class="row">
    <div class="card shadow mb-4 w-100">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Brood Stock</h6>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#broodFormModal">
                <?= !empty($info) ? 'Edit Brood' : 'Add Brood' ?>
            </button>
        </div>
        <div class="card-body">
            <small class="text-muted">Use the button above to <?= !empty($info) ? 'edit the selected' : 'add a new' ?> record.</small>
        </div>
    </div>
</div>

<!-- Brood Form Modal -->
<div class="modal fade" id="broodFormModal" tabindex="-1" role="dialog" aria-labelledby="broodFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="broodFormLabel"><?= !empty($info) ? 'Edit Brood Stock' : 'Add Brood Stock' ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Species</label>
                    <input type="text" name="species" class="form-control" value="<?= isset($info['species']) ? $info['species'] : '' ?>" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Females</label>
                    <input type="number" name="females" class="form-control" value="<?= isset($info['females']) ? $info['females'] : '' ?>" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Female Wt</label>
                    <input type="text" name="female_weight" class="form-control" value="<?= isset($info['female_weight']) ? $info['female_weight'] : '' ?>">
                </div>
                <div class="form-group col-md-2">
                    <label>Males</label>
                    <input type="number" name="males" class="form-control" value="<?= isset($info['males']) ? $info['males'] : '' ?>" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Male Wt</label>
                    <input type="text" name="male_weight" class="form-control" value="<?= isset($info['male_weight']) ? $info['male_weight'] : '' ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" value="<?= isset($info['date']) ? $info['date'] : '' ?>">
                </div>
                <div class="form-group col-md-9">
                    <label>Notes</label>
                    <input type="text" name="notes" class="form-control" value="<?= isset($info['notes']) ? $info['notes'] : '' ?>">
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

<?php if (!empty($info)) { ?>
<script>
  (function waitForJQ(){
    if (window.jQuery && window.jQuery.fn && window.jQuery.fn.modal) {
      window.jQuery('#broodFormModal').modal('show');
    } else {
      setTimeout(waitForJQ, 50);
    }
  })();
  </script>
<?php } ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Brood Stock List</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Species</th>
                    <th>F (no/wt)</th>
                    <th>M (no/wt)</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($data as $row) { ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= esc($row['species']) ?></td>
                        <td><?= esc($row['females']) ?> / <?= esc($row['female_weight']) ?></td>
                        <td><?= esc($row['males']) ?> / <?= esc($row['male_weight']) ?></td>
                        <td><?= esc($row['date']) ?></td>
                        <td>
                            <a href="/brood/<?= $row['id'] ?>" class="btn btn-info btn-sm">Update</a>
                            <a href="/brood/<?= $row['id'] ?>/delete" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
