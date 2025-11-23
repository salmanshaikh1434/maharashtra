<div class="row">
    <div class="card shadow mb-4 w-100">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Production</h6>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#productionFormModal">
                <?= !empty($info) ? 'Edit Production' : 'Add Production' ?>
            </button>
        </div>
        <div class="card-body">
            <small class="text-muted">Use the button above to <?= !empty($info) ? 'edit the selected' : 'add a new' ?> production.</small>
        </div>
    </div>
</div>

<!-- Production Modal -->
<div class="modal fade" id="productionFormModal" tabindex="-1" role="dialog" aria-labelledby="productionFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productionFormLabel"><?= !empty($info) ? 'Edit Production' : 'Add Production' ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputState">Species</label>
                    <select id="inputState" name="species" class="form-control">
                        <option value="<?= isset($info['species']) ? $info['species'] :'' ?>" selected><?= isset($info['species']) ? $info['species'] :'Choose...' ?></option>
                        <option value="catla">Catla</option>
                        <option value="Rohu">Rohu</option>
                        <option value="Mrigala">Mrigala</option>
                        <option value="Sliver Carp">Sliver Carp</option>
                        <option value="Cyprinus">Cyprinus</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputState">Experiment</label>
                    <select id="inputState" name="experiment_id" class="form-control" required>
                        <?php foreach ($experiments as  $value) { 
                            $selected = (isset($info['experiment_id']) && (string)$value['id'] === (string)$info['experiment_id']) ? 'selected' : '';
                        ?>
                            <option value="<?= $value['id'] ?>" <?= $selected ?>><?= $value['name'] ?></option>
                        <?php  } ?>
                    </select>
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputCity">Female Nos</label>
                    <input type="text" name="fno" class="form-control" id="fnos" value="<?= isset($info['fno']) ? $info['fno'] : '' ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputCity">Female Wt</label>
                    <input type="text" name="fwt" class="form-control" id="fwt" value="<?= isset($info['fwt']) ? $info['fwt'] : '' ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputCity">male Nos</label>
                    <input type="text" name="mno" class="form-control" id="mnos" value="<?= isset($info['mno']) ? $info['mno'] : '' ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputCity">male Wt</label>
                    <input type="text" name="mwt" class="form-control" id="mwt" value="<?= isset($info['mwt']) ? $info['mwt'] : '' ?>" required>
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
      window.jQuery('#productionFormModal').modal('show');
    } else {
      setTimeout(waitForJQ, 50);
    }
  })();
  </script>
<?php } ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Production List</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Experiment</th>
                    <th>Species</th>
                    <th>Female No.</th>
                    <th>Female Wt.</th>
                    <th>Male No.</th>
                    <th>Male Wt.</th>
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
                        <td><?= $value['species'] ?></td>
                        <td><?= $value['fno'] ?></td>
                        <td><?= $value['fwt'] ?></td>
                        <td><?= $value['mno'] ?></td>
                        <td><?= $value['mwt'] ?></td>
                        <td><?= $value['date'] ?></td>
                        <td>
                            <a href="/stock/production/<?= $value['id'] ?>" class="btn btn-info">Update</a>
                            <a href="/stock/production/<?= $value['id'] ?>/delete" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php  } ?>


            </tbody>
        </table>
    </div>
</div>
