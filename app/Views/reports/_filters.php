<div class="mb-3">
  <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#reportFiltersModal">
    Filters
  </button>
</div>

<!-- Report Filters Modal -->
<div class="modal fade" id="reportFiltersModal" tabindex="-1" role="dialog" aria-labelledby="reportFiltersLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reportFiltersLabel">Filter Reports</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="get">
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Start</label>
                    <input type="date" class="form-control" name="start" value="<?= esc($filters['start'] ?? '') ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>End</label>
                    <input type="date" class="form-control" name="end" value="<?= esc($filters['end'] ?? '') ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Species</label>
                    <input type="text" class="form-control" name="species" value="<?= esc($filters['species'] ?? '') ?>" placeholder="Optional">
                </div>
                <div class="form-group col-md-6">
                    <label>Stage</label>
                    <?php $stageOptions = ['' => 'Any', 'spawn' => 'Spawn', 'fry' => 'Fry', 'semifinger' => 'Semi-fingerling', 'fingerling' => 'Fingerling']; ?>
                    <select class="form-control" name="stage">
                        <?php foreach ($stageOptions as $value => $label) { ?>
                            <option value="<?= esc($value) ?>"<?= ($filters['stage'] ?? '') === $value ? ' selected' : '' ?>><?= esc($label) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Apply</button>
        </div>
      </form>
    </div>
  </div>
  </div>
