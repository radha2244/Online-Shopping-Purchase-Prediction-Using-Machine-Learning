
<?php
$datasetPath = __DIR__ . "/online_shoppers_intention.csv";

if (!file_exists($datasetPath)) {
    die("Dataset not found. Please check the CSV filename.");
}

$file = fopen($datasetPath, "r");

$headers = fgetcsv($file);
$totalSessions = 0;
$purchases = 0;
$noPurchases = 0;
$monthlyPurchases = [];

while (($row = fgetcsv($file)) !== false) {
    if (count($row) !== count($headers)) {
        continue;
    }

    $data = array_combine($headers, $row);

    $totalSessions++;

    if (strtolower(trim($data["Revenue"])) === "true") {
        $purchases++;

        $month = $data["Month"];
        if (!isset($monthlyPurchases[$month])) {
            $monthlyPurchases[$month] = 0;
        }
        $monthlyPurchases[$month]++;
    } else {
        $noPurchases++;
    }
}

fclose($file);

$purchaseRate = $totalSessions > 0
    ? round(($purchases / $totalSessions) * 100, 2)
    : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Analytics Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        header {
            background: #172554;
            color: white;
            padding: 24px 6%;
        }

        header h1 {
            margin: 0 0 8px;
        }

        header p {
            margin: 0;
            color: #cbd5e1;
        }

        main {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #0000000d;
        }

        .card p {
            color: #64748b;
            margin: 0 0 12px;
        }

        .card h2 {
            margin: 0;
            font-size: 30px;
            color: #1d4ed8;
        }

        .panel {
            margin-top: 25px;
            background: white;
            padding: 24px;
            border-radius: 12px;
        }

        .bar {
            height: 16px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            margin: 14px 0;
        }

        .bar-fill {
            height: 100%;
            background: #16a34a;
        }

        .button {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 20px;
            background: #1d4ed8;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }

        .button:hover {
            background: #1e40af;
        }
    </style>
</head>

<body>

<header>
    <h1>Online Shopping Analytics</h1>
    <p>Understand visitor behavior and purchase patterns</p>
</header>

<main>

    <div class="cards">
        <div class="card">
            <p>Total Sessions</p>
            <h2><?= number_format($totalSessions) ?></h2>
        </div>

        <div class="card">
            <p>Purchases</p>
            <h2><?= number_format($purchases) ?></h2>
        </div>

        <div class="card">
            <p>No Purchases</p>
            <h2><?= number_format($noPurchases) ?></h2>
        </div>

        <div class="card">
            <p>Purchase Rate</p>
            <h2><?= $purchaseRate ?>%</h2>
        </div>
    </div>

    
<section class="panel">
    <h2>Purchase vs No Purchase</h2>
    <div style="max-width: 360px; margin: auto;">
        <canvas id="purchaseChart"></canvas>
    </div>
</section>

<section class="panel">
    <h2>Monthly Purchases</h2>
    <div style="max-width: 800px; margin: auto;">
        <canvas id="monthlyChart"></canvas>
    </div>
</section>

    <section class="panel">
        <h2>Purchase Overview</h2>
        <p>
            <?= number_format($purchases) ?> of
            <?= number_format($totalSessions) ?>
            shopping sessions resulted in a purchase.
        </p>

        <div class="bar">
            <div class="bar-fill"
                 style="width: <?= $purchaseRate ?>%">
            </div>
        </div>

        <p>Purchase rate: <?= $purchaseRate ?>%</p>
    </section>

    <section class="panel">
        <h2>Purchases by Month</h2>

        <?php if (empty($monthlyPurchases)): ?>
            <p>No purchase data found.</p>
        <?php else: ?>
            <?php foreach ($monthlyPurchases as $month => $count): ?>
                <p>
                    <strong><?= htmlspecialchars($month) ?>:</strong>
                    <?= number_format($count) ?> purchases
                </p>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

    <section class="panel">
        <h2>Purchase Prediction</h2>
        <p>Explore the likelihood of a purchase using our machine learning model.</p>
        <a class="button" href="index.php">Open Prediction Form</a>
    </section>

</main>

<script>
    // Data calculated by PHP from the CSV file
    const purchaseCount = <?= json_encode($purchases) ?>;
    const noPurchaseCount = <?= json_encode($noPurchases) ?>;

    const monthlyData = <?= json_encode($monthlyPurchases) ?>;

    // Doughnut chart
    new Chart(document.getElementById("purchaseChart"), {
        type: "doughnut",
        data: {
            labels: ["Purchase", "No Purchase"],
            datasets: [{
                data: [purchaseCount, noPurchaseCount],
                backgroundColor: ["#16a34a", "#f59e0b"],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "bottom"
                }
            }
        }
    });

    // Monthly purchases bar chart
    new Chart(document.getElementById("monthlyChart"), {
        type: "bar",
        data: {
            labels: Object.keys(monthlyData),
            datasets: [{
                label: "Number of Purchases",
                data: Object.values(monthlyData),
                backgroundColor: "#2563eb",
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: "Number of Purchases"
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: "Month"
                    }
                }
            }
        }
    });
</script>

</body>
</html>
