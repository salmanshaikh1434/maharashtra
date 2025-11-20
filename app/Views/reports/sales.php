<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Seed Sales Report (All Stages)</h6>
    </div>
    <div class="card-body">
        <?php $filters = $filters ?? []; include(APPPATH.'Views/reports/_filters.php'); ?>
        <?php $stageLabels = ['spawn' => 'Spawn', 'fry' => 'Fry', 'semifinger' => 'Semi-fingerling', 'fingerling' => 'Fingerling']; ?>

        <h5>Summary by Stage &amp; Species</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Stage</th>
                    <th>Species</th>
                    <th>Total Qty</th>
                    <th>Total Revenue</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($grouped)) { ?>
                    <tr><td colspan="4">No data</td></tr>
                <?php } else { foreach ($grouped as $g) { ?>
                    <tr>
                        <td><?= esc($stageLabels[$g['stage'] ?? ''] ?? ($g['stage'] ?? '')) ?></td>
                        <td><?= esc($g['species']) ?></td>
                        <td><?= esc($g['qty']) ?></td>
                        <td><?= esc($g['revenue']) ?></td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>

        <h5 class="mt-4">Detailed Sales</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Stage</th>
                    <th>Species</th>
                    <th>Qty</th>
                    <th>Buyer</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($rows)) { ?>
                    <tr><td colspan="6">No data</td></tr>
                <?php } else { foreach ($rows as $r) { ?>
                    <tr>
                        <td><?= esc($r['date']) ?></td>
                        <td><?= esc($stageLabels[$r['stage'] ?? ''] ?? ($r['stage'] ?? '')) ?></td>
                        <td><?= esc($r['species']) ?></td>
                        <td><?= esc($r['quantity']) ?></td>
                        <td><?= esc($r['buyer']) ?></td>
                        <td><?= esc($r['total_amount']) ?></td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>
