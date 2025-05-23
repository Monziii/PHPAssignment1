<?php 
    $investment = '';
    $interest_rate = '';
    $years = '';
    $future_value_f = '';
    $error_message = '';


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
        $investment = filter_input(INPUT_POST, 'investment', FILTER_VALIDATE_FLOAT);
        $interest_rate = filter_input(INPUT_POST, 'interest_rate', FILTER_VALIDATE_FLOAT);
        $years = filter_input(INPUT_POST, 'years', FILTER_VALIDATE_INT);

        if ($investment === FALSE) {
            $error_message = 'Investment must be a valid number.';
        } else if ($investment <= 0) {
            $error_message = 'Investment must be greater than zero.';
        } else if ($interest_rate === FALSE) {
            $error_message = 'Interest rate must be a valid number.';
        } else if ($interest_rate <= 0) {
            $error_message = 'Interest rate must be greater than zero.';
        } else if ($interest_rate > 15) {
            $error_message = 'Interest rate must be less than or equal to 15.';
        } else if ($years === FALSE) {
            $error_message = 'Years must be a valid whole number.';
        } else if ($years <= 0) {
            $error_message = 'Years must be greater than zero.';
        } else if ($years > 30) {
            $error_message = 'Years must be less than 31.';
        } else {

            $future_value = $investment;
            for ($i = 1; $i <= $years; $i++) {
                $future_value += $future_value * $interest_rate * 0.01;
            }

            $investment_f = '$' . number_format($investment, 2);
            $yearly_rate_f = $interest_rate . '%';
            $future_value_f = '$' . number_format($future_value, 2);

            $investment = '';
            $interest_rate = '';
            $years = '';
        }
    }
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
<main>
    <h1>Future Value Calculator</h1>

    <?php if (!empty($error_message)) { ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php } ?>

    <form action="" method="post">
        <div id="data">
            <label>Investment Amount:</label>
            <input type="text" name="investment" value="<?php echo htmlspecialchars($investment); ?>">
            <br>

            <label>Yearly Interest Rate:</label>
            <input type="text" name="interest_rate" value="<?php echo htmlspecialchars($interest_rate); ?>">
            <br>

            <label>Number of Years:</label>
            <input type="text" name="years" value="<?php echo htmlspecialchars($years); ?>">
            <br>
        </div>

        <div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" value="Calculate"><br>
        </div>
    </form>

    <?php if (!empty($future_value_f)) { ?>
        <h2>Result</h2>
        <label>Investment Amount:</label>
        <span><?php echo $investment_f; ?></span><br>

        <label>Yearly Interest Rate:</label>
        <span><?php echo $yearly_rate_f; ?></span><br>

        <label>Number of Years:</label>
        <span><?php echo htmlspecialchars($_POST['years']); ?></span><br>

        <label>Future Value:</label>
        <span><?php echo $future_value_f; ?></span><br>

        <p>This calculation was done on <?php echo date('m/d/Y'); ?>.</p>
    <?php } ?>
</main>
</body>
</html>
