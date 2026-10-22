
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping Purchase Prediction</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
            padding: 30px 16px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #1d4ed8, #6366f1);
            color: white;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 24px;
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.15);
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            color: #e0e7ff;
            line-height: 1.6;
        }

        .form-card {
            background: white;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(15, 23, 42, 0.06);
        }

        .form-card h2 {
            font-size: 21px;
            margin-bottom: 8px;
        }

        .description {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .section-title {
            font-size: 16px;
            color: #1d4ed8;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
            margin: 26px 0 18px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            color: #0f172a;
            background: white;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .form-actions {
            margin-top: 28px;
            display: flex;
            gap: 12px;
        }

        .predict-btn,
        .reset-btn {
            padding: 13px 22px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }

        .predict-btn {
            background: #2563eb;
            color: white;
            flex: 1;
        }

        .predict-btn:hover {
            background: #1d4ed8;
        }

        .reset-btn {
            background: #e2e8f0;
            color: #334155;
        }

        .reset-btn:hover {
            background: #cbd5e1;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            body {
                padding: 16px 10px;
            }

            .header,
            .form-card {
                padding: 20px;
            }

            .header h1 {
                font-size: 23px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <header class="header">
        <h1>Online Shopping Purchase Prediction</h1>
        <p>Analyze visitor activity and predict the likelihood of a purchase using machine learning.</p>
    </header>

    <div class="form-card">
        <h2>Predict Customer Purchase</h2>
        <p class="description">
            Enter the shopping session details below to estimate whether the visitor is likely to make a purchase.
        </p>

        <form action="predict.php" method="POST">

            <h3 class="section-title">Page Activity</h3>
            <div class="form-grid">

                <div class="form-group">
                    <label>Administrative Pages</label>
                    <input type="number" name="Administrative" min="0" required>
                </div>

                <div class="form-group">
                    <label>Administrative Duration (seconds)</label>
                    <input type="number" name="Administrative_Duration" min="0" step="any" required>
                </div>

                <div class="form-group">
                    <label>Informational Pages</label>
                    <input type="number" name="Informational" min="0" required>
                </div>

                <div class="form-group">
                    <label>Informational Duration (seconds)</label>
                    <input type="number" name="Informational_Duration" min="0" step="any" required>
                </div>

                <div class="form-group">
                    <label>Product Related Pages</label>
                    <input type="number" name="ProductRelated" min="0" required>
                </div>

                <div class="form-group">
                    <label>Product Related Duration (seconds)</label>
                    <input type="number" name="ProductRelated_Duration" min="0" step="any" required>
                </div>

                <div class="form-group">
                    <label>Bounce Rate (0–1)</label>
                    <input type="number" name="BounceRates" min="0" max="1" step="any" required>
                </div>

                <div class="form-group">
                    <label>Exit Rate (0–1)</label>
                    <input type="number" name="ExitRates" min="0" max="1" step="any" required>
                </div>

                <div class="form-group">
                    <label>Special Day (0–1)</label>
                    <input type="number" name="SpecialDay" min="0" max="1" step="any" required>
                </div>

                <div class="form-group">
                    <label>Month</label>
                    <select name="Month" required>
                        <option value="" disabled selected>Select a month</option>
                        <option value="Feb">February</option>
                        <option value="Mar">March</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="Jul">July</option>
                        <option value="Aug">August</option>
                        <option value="Sep">September</option>
                        <option value="Oct">October</option>
                        <option value="Nov">November</option>
                        <option value="Dec">December</option>
                    </select>
                </div>

            </div>

            <h3 class="section-title">Visitor Information</h3>
            <div class="form-grid">

                <div class="form-group">
                    <label>Operating System</label>
                    <input type="number" name="OperatingSystems" min="1" required>
                </div>

                <div class="form-group">
                    <label>Browser</label>
                    <input type="number" name="Browser" min="1" required>
                </div>

                <div class="form-group">
                    <label>Region</label>
                    <input type="number" name="Region" min="1" required>
                </div>

                <div class="form-group">
                    <label>Traffic Type</label>
                    <input type="number" name="TrafficType" min="1" required>
                </div>

                <div class="form-group">
                    <label>Visitor Type</label>
                    <select name="VisitorType" required>
                        <option value="" disabled selected>Select Visitor Type</option>
                        <option value="Returning_Visitor">Returning Visitor</option>
                        <option value="New_Visitor">New Visitor</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Is it a Weekend?</label>
                    <select name="Weekend" required>
                        <option value="" disabled selected>Select Weekend</option>
                        <option value="false">No</option>
                        <option value="true">Yes</option>
                    </select>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="predict-btn">Predict Purchase</button>
                <button type="reset" class="reset-btn">Clear Form</button>
            </div>

        </form>

        <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
    </div>

</div>

</body>
</html>
