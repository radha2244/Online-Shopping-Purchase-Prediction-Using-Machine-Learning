
<?php
$result = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fields = [
        "Administrative",
        "Administrative_Duration",
        "Informational",
        "Informational_Duration",
        "ProductRelated",
        "ProductRelated_Duration",
        "BounceRates",
        "ExitRates",
        "SpecialDay",
        "Month",
        "OperatingSystems",
        "Browser",
        "Region",
        "TrafficType",
        "VisitorType",
        "Weekend"
    ];

    $data = [];

    foreach ($fields as $field) {
        if (!isset($_POST[$field])) {
            $error = "Missing field: " . $field;
            break;
        }

        $data[$field] = $_POST[$field];
    }

    if ($error === "") {
        $data["Administrative"] = (int)$data["Administrative"];
        $data["Administrative_Duration"] = (float)$data["Administrative_Duration"];
        $data["Informational"] = (int)$data["Informational"];
        $data["Informational_Duration"] = (float)$data["Informational_Duration"];
        $data["ProductRelated"] = (int)$data["ProductRelated"];
        $data["ProductRelated_Duration"] = (float)$data["ProductRelated_Duration"];
        $data["BounceRates"] = (float)$data["BounceRates"];
        $data["ExitRates"] = (float)$data["ExitRates"];
        $data["SpecialDay"] = (float)$data["SpecialDay"];
        $data["OperatingSystems"] = (int)$data["OperatingSystems"];
        $data["Browser"] = (int)$data["Browser"];
        $data["Region"] = (int)$data["Region"];
        $data["TrafficType"] = (int)$data["TrafficType"];
        $data["Weekend"] = $data["Weekend"] === "true";

        $options = [
            "http" => [
                "method" => "POST",
                "header" => "Content-Type: application/json\r\n",
                "content" => json_encode($data),
                "timeout" => 10,
                "ignore_errors" => true
            ]
        ];

        $context = stream_context_create($options);

        $response = @file_get_contents(
            "http://127.0.0.1:8000/predict",
            false,
            $context
        );

        if ($response === false) {
            $error = "Could not connect to the prediction API. Make sure your Python API is running.";
        } else {
            $result = json_decode($response, true);

            if (!is_array($result) || !isset($result["prediction"])) {
                $error = "The prediction API returned an unexpected response: " . $response;
                $result = null;
            }
        }
    }
} else {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Prediction Result</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 16px;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .result-card {
            max-width: 600px;
            margin: 50px auto;
            padding: 32px;
            background: white;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
        }

        h1 {
            margin-top: 0;
            font-size: 26px;
        }

        .prediction {
            margin: 24px 0;
            padding: 22px;
            border-radius: 12px;
            background: #eff6ff;
        }

        .prediction h2 {
            margin: 0 0 12px;
            color: #1d4ed8;
        }

        .probability {
            font-size: 28px;
            font-weight: bold;
        }

        .error {
            padding: 16px;
            background: #fef2f2;
            color: #b91c1c;
            border-radius: 8px;
            line-height: 1.6;
        }

        a {
            display: inline-block;
            margin: 10px 6px 0;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .primary {
            background: #2563eb;
            color: white;
        }

        .secondary {
            background: #e2e8f0;
            color: #334155;
        }
    </style>
</head>
<body>
    <main class="result-card">
        <h1>Purchase Prediction Result</h1>

        <?php if ($error !== ""): ?>
            <div class="error">
                <strong>Prediction could not be completed.</strong>
                <p><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></p>
            </div>
        <?php elseif ($result !== null): ?>
            <div class="prediction">
                <h2>
                    <?= htmlspecialchars($result["prediction"], ENT_QUOTES, "UTF-8") ?>
                </h2>

                <?php if (isset($result["purchase_probability"])): ?>
                    <p>Estimated purchase probability</p>
                    <div class="probability">
                        <?= number_format((float)$result["purchase_probability"] * 100, 2) ?>%
                    </div>
                <?php endif; ?>
            </div>

            <p>This result is an estimate from your machine-learning model.</p>
        <?php endif; ?>

        <a href="index.php" class="primary">Try Another Prediction</a>
        <a href="dashboard.php" class="secondary">Back to Dashboard</a>
    </main>
</body>
</html>
