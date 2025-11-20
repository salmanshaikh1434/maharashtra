<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Production Report</h6>
    </div>
    <div class="card-body">
        <?php $filters = $filters ?? []; include(APPPATH.'Views/reports/_filters.php'); ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Species</th>
                    <th>Batches</th>
                    <th>F No</th>
                    <th>F Wt</th>
                    <th>M No</th>
                    <th>M Wt</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($summary)) { ?>
                    <tr><td colspan="6">No data</td></tr>
                <?php } else { foreach ($summary as $r) { ?>
                    <tr>
                        <td><?= esc($r['species']) ?></td>
                        <td><?= esc($r['batches']) ?></td>
                        <td><?= esc($r['fno']) ?></td>
                        <td><?= esc($r['fwt']) ?></td>
                        <td><?= esc($r['mno']) ?></td>
                        <td><?= esc($r['mwt']) ?></td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>

