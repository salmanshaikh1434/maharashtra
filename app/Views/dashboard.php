
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <div>
                            <a href="/stock/experiment" class="btn btn-sm btn-primary shadow-sm">Add Experiment</a>
                            <a href="/stock/production" class="btn btn-sm btn-primary shadow-sm">Add Production</a>
                            <a href="/sales/fingerling" class="btn btn-sm btn-success shadow-sm">Record Sale</a>
                        </div>
                    </div>

                    <!-- KPI Cards -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Revenue (This Month)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹<?= number_format((float)($metrics['revenue_month'] ?? 0), 2) ?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-rupee-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Experiments (This Month)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= (int)($metrics['experiments_month'] ?? 0) ?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-flask fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Fingerlings (Stock)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format((float)($metrics['fingerlings_qty'] ?? 0)) ?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-fish fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Brood (Total)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= (int)($metrics['brood_total'] ?? 0) ?></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-water fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue - Last 6 Months</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area" style="height: 320px;">
                                        <canvas id="revenueChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Stock by Stage</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2" style="height: 300px;">
                                        <canvas id="stockStageChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent activity -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Recent Productions</h6>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table mb-0">
                                        <thead><tr><th>Date</th><th>Species</th><th>F (no/wt)</th><th>M (no/wt)</th></tr></thead>
                                        <tbody>
                                            <?php if (empty($recent_productions)) { ?>
                                                <tr><td colspan="4" class="text-center p-3">No recent productions</td></tr>
                                            <?php } else { foreach ($recent_productions as $r) { ?>
                                                <tr>
                                                    <td><?= esc($r['date']) ?></td>
                                                    <td><?= esc($r['species']) ?></td>
                                                    <td><?= esc($r['fno']) ?> / <?= esc($r['fwt']) ?></td>
                                                    <td><?= esc($r['mno']) ?> / <?= esc($r['mwt']) ?></td>
                                                </tr>
                                            <?php }} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Recent Sales</h6>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table mb-0">
                                        <thead><tr><th>Date</th><th>Type</th><th>Species</th><th>Qty</th><th>Total</th></tr></thead>
                                        <tbody>
                                            <?php if (empty($recent_sales)) { ?>
                                                <tr><td colspan="5" class="text-center p-3">No recent sales</td></tr>
                                            <?php } else { foreach ($recent_sales as $s) { ?>
                                                <tr>
                                                    <td><?= esc($s['date']) ?></td>
                                                    <td><?= esc($s['type']) ?></td>
                                                    <td><?= esc($s['species']) ?></td>
                                                    <td><?= esc($s['qty']) ?></td>
                                                    <td>₹<?= number_format((float)$s['total_amount'],2) ?></td>
                                                </tr>
                                            <?php }} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Scripts for charts (Chart.js) -->
                    <script src="/vendor/chart.js/Chart.min.js"></script>
                    <script>
                        (function(){
                            var labels = <?= json_encode($revenue_labels ?? []) ?>;
                            var series = <?= json_encode($revenue_series ?? []) ?>;
                            var ctx = document.getElementById('revenueChart');
                            if (ctx && window.Chart) {
                                new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Revenue',
                                            data: series,
                                            borderColor: '#4e73df',
                                            backgroundColor: 'rgba(78, 115, 223, 0.1)',
                                            lineTension: 0.3,
                                            pointRadius: 3,
                                        }]
                                    },
                                    options: { 
                                        maintainAspectRatio: false,
                                        scales: { yAxes: [{ ticks: { beginAtZero: true } }] }, 
                                        legend: { display: false }
                                    }
                                });
                            }

                            var stock = <?= json_encode($stock_totals ?? []) ?>;
                            var ctx2 = document.getElementById('stockStageChart');
                            if (ctx2 && window.Chart) {
                                new Chart(ctx2, {
                                    type: 'doughnut',
                                    data: {
                                        labels: ['Spawn','Fry','Semifinger','Fingerling'],
                                        datasets: [{
                                            data: [stock.spawn||0, stock.fry||0, stock.semi||0, stock.finger||0],
                                            backgroundColor: ['#1cc88a','#36b9cc','#f6c23e','#4e73df']
                                        }]
                                    },
                                    options: { 
                                        maintainAspectRatio: false,
                                        legend: { position: 'bottom' } 
                                    }
                                });
                            }
                        })();
                    </script>
