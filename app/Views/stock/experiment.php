<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Experiment</h6>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#experimentFormModal">
            <?= !empty($info) ? 'Edit Experiment' : 'Add Experiment' ?>
        </button>
    </div>
    <div class="card-body">
        <small class="text-muted">Use the button above to <?= !empty($info) ? 'edit the selected' : 'add a new' ?> experiment.</small>
    </div>
</div>

<!-- Experiment Modal -->
<div class="modal fade" id="experimentFormModal" tabindex="-1" role="dialog" aria-labelledby="experimentFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="experimentFormLabel"><?= !empty($info) ? 'Edit Experiment' : 'Add Experiment' ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date">Date</label>
                    <input type="date" name="date" class="form-control" id="date"
                        value="<?= isset($info['date']) ? $info['date'] :'' ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="name">Experiment</label>
                    <input type="text" name="name" class="form-control" value="<?= isset($info['name']) ? $info['name'] :'' ?>" id="name" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><?= isset($info) ? 'Update' : 'Add' ?></button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php if (!empty($info)) { ?>
<script>
  (function waitForJQ(){
    if (window.jQuery && window.jQuery.fn && window.jQuery.fn.modal) {
      window.jQuery('#experimentFormModal').modal('show');
    } else {
      setTimeout(waitForJQ, 50);
    }
  })();
  </script>
<?php } ?>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Experiment List</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Experiment</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach ($data as  $value) { ?>
                <tr>
                    <td scope="row"><?= $i++ ?></td>
                    <td><?= $value['name'] ?></td>
                    <td><?= $value['date'] ?></td>
                    <td>
                        <a href="/stock/experiment/<?= $value['id'] ?>" class="btn btn-info">Update</a>
                        <a href="/stock/experiment/<?= $value['id'] ?>/delete" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>
