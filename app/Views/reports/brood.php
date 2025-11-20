<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Brood Stock Report</h6>
    </div>
    <div class="card-body">
        <?php $filters = $filters ?? []; include(APPPATH.'Views/reports/_filters.php'); ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Species</th>
                    <th>Total Females</th>
                    <th>Total Female Wt</th>
                    <th>Total Males</th>
                    <th>Total Male Wt</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($summary)) { ?>
                    <tr><td colspan="5">No data</td></tr>
                <?php } else { foreach ($summary as $r) { ?>
                    <tr>
                        <td><?= esc($r['species']) ?></td>
                        <td><?= esc($r['females']) ?></td>
                        <td><?= esc($r['female_weight']) ?></td>
                        <td><?= esc($r['males']) ?></td>
                        <td><?= esc($r['male_weight']) ?></td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>

