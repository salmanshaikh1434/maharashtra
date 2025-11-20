<div class="row">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Semifinger Stock</h6>
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
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($semifinger as  $value) { ?>
                        <tr>
                            <th><?= $i++ ?></th>
                            <th><?= $value['name'] ?></th>
                            <th><?= $value['species'] ?></th>
                            <th><?= $value['fno'] ?></th>
                            <th><?= $value['fwt'] ?></th>
                            <th><?= $value['mno'] ?></th>
                            <th><?= $value['mwt'] ?></th>
                            <th><?= $value['quantity'] ?></th>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>