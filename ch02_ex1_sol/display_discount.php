<?php
	$product_description = filter_input(INPUT_POST, 'product_description');
	$list_price = filter_input(INPUT_POST, 'list_price');
    $sale_tax = filter_input(INPUT_POST, 'sale_tax');
	$discount_percent = filter_input(INPUT_POST, 'discount_percent');
	
    $errors = [];

    if (!$product_description) {
        $errors[] = "Please enter a product description.";
    }
    if ($list_price === false || $list_price <= 0) {
        $errors[] = "Please enter a valid positive list price.";
    }
    if ($discount_percent === false || $discount_percent < 0 || $discount_percent > 100) {
        $errors[] = "Please enter a discount percent between 0 and 100.";
    }
    if (count($errors) === 0) {
    
        $discount = $list_price * $discount_percent * 0.01;
        $discount_price = $list_price - $discount;

        $sales_tax_rate = 0.08;
        $sales_tax_amount = $discount_price * $sales_tax_rate;

        $total_price = $discount_price + $sales_tax_amount;

        $list_price_f = "$" . number_format($list_price, 2);
        $discount_percent_f = $discount_percent . "%";
        $discount_f = "$" . number_format($discount, 2);
        $discount_price_f = "$" . number_format($discount_price, 2);
        $sales_tax_rate_f = ($sales_tax_rate * 100) . "%";
        $sales_tax_amount_f = "$" . number_format($sales_tax_amount, 2);
        $total_price_f = "$" . number_format($total_price, 2);

        $sale_tax_f = htmlspecialchars($sale_tax);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Product Discount Calculator</h1>

        <label>Product Description:</label>
        <span><?php echo htmlspecialchars($product_description); ?></span><br>

        <label>List Price:</label>
        <span><?php echo htmlspecialchars($list_price_f); ?></span><br>

        <label>Sales Tax:</label>
        <span><?php echo htmlspecialchars($sale_tax_f); ?></span><br>

        <label>Standard Discount:</label>
        <span><?php echo htmlspecialchars($discount_percent_f); ?></span><br>
       
        <label>Discount Amount:</label>
            <span><?php echo $discount_f; ?></span><br>

            <label>Discount Price:</label>
            <span><?php echo $discount_price_f; ?></span><br>

            <label>Sales Tax Amount:</label>
            <span><?php echo $sales_tax_amount_f; ?></span><br>

            <label>Total Price:</label>
            <span><?php echo $total_price_f; ?></span><br>
    </main>
</body>
</html>