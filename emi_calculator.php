<html>
<head>
    <title>EMI Calculator</title>
</head>
<body>
<div class="emi_calc_div">
    <form method="post">
        <input type="text" name="amount" placeholder="Loan Amount">
        <input type="text" name="rate" placeholder="Interest Rate">
        <input type="text" name="tenure" placeholder="Loan Tenure (Years)">
        <input type="submit" name="submit" value="Calculate">
    </form>
</div>

<?php
if(isset($_POST['submit'])){
    // Check if all fields are filled
    if(empty($_POST['amount']) || empty($_POST['rate']) || empty($_POST['tenure'])){
        echo "<h3>Please enter all fields.</h3>";
    } else {
        // Retrieve and sanitize input values
        $amount = floatval($_POST['amount']);
        $rate = floatval($_POST['rate']) / 12 / 100; // Monthly interest rate
        $tenure = intval($_POST['tenure']) * 12; // Convert tenure to months

        // Check if rate and tenure are valid
        if($rate <= 0 || $tenure <= 0){
            echo "<h3>Interest rate and tenure must be greater than zero.</h3>";
        } else {
            // Calculate EMI
            $emi = ($amount * $rate * pow(1 + $rate, $tenure)) / (pow(1 + $rate, $tenure) - 1);
            // Calculate total payment
            $total = $emi * $tenure;

            // Output results
            echo "<h3>Loan EMI : " . round($emi, 2) . "</h3><br>";
            echo "<h3>Total Payment (Amount + Interest) : " . round($total, 2) . "</h3> <br>";
        }
    }
}
?>
</body>
</html>
