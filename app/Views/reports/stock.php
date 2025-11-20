<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Stock Summary</h6>
    </div>
    <div class="card-body">
        <?php $filters = $filters ?? []; include(APPPATH.'Views/reports/_filters.php'); ?>

        <div class="row">
            <?php
                $sections = [
                    'spawn' => 'Spawn',
                    'fry' => 'Fry',
                    'semi' => 'Semifinger',
                    'finger' => 'Fingerling',
                ];
            ?>
            <?php foreach ($sections as $key => $title) { $rows = $summary[$key] ?? []; ?>
                <div class="col-md-6">
                    <h5 class="mt-3"><?= $title ?></h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Species</th>
                                <th>Total Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($rows)) { ?>
                                <tr><td colspan="2">No data</td></tr>
                            <?php } else { foreach ($rows as $r) { ?>
                                <tr>
                                    <td><?= esc($r['species']) ?></td>
                                    <td><?= esc($r['qty']) ?></td>
                                </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

