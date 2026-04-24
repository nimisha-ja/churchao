<!DOCTYPE html>
<html>
<head>
    <title>Payment Status</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            text-align: center;
            padding: 50px;
        }
        .card {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            width: 400px;
        }
        .success {
            color: green;
        }
        .failed {
            color: red;
        }
        .btn {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .details {
            text-align: left;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="card">

    <?php if ($status == 'paid'): ?>
        <h2 class="success">✅ Payment Successful</h2>
    <?php else: ?>
        <h2 class="failed">❌ Payment Failed</h2>
    <?php endif; ?>

    <p><strong>Order ID:</strong> <?= esc($response['order_id'] ?? '') ?></p>
    <p><strong>Amount:</strong> ₹<?= esc($response['amount'] ?? '') ?></p>
    <p><strong>Message:</strong> <?= esc($response['response_message'] ?? '') ?></p>

    <div class="details">
        <p><strong>Transaction ID:</strong> <?= esc($response['transaction_id'] ?? '') ?></p>
        <p><strong>Payment Mode:</strong> <?= esc($response['payment_mode'] ?? '') ?></p>
        <p><strong>Date:</strong> <?= esc($response['payment_datetime'] ?? '') ?></p>
    </div>

    <a href="<?= base_url() ?>" class="btn">Go Home</a>

</div>

</body>
</html>