<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fromCurrency = $_POST['fromcurrency'];
    $toCurrency = $_POST['tocurrency'];
    $amount = $_POST['amount'];

    $convertedAmount = round(convertCurrency($fromCurrency, $toCurrency, $amount), 2);
}

if (isset($_POST['action']) && $_POST['action'] == 'swap') {
    $temp = $fromCurrency;
    $fromCurrency = $toCurrency;
    $toCurrency = $temp;
}

function convertCurrency($fromCurrency, $toCurrency, $amount) {
    switch ($fromCurrency) {
        case "EURO":
            switch ($toCurrency) {
                case "EURO":
                    return $amount;
                case "ZAR":
                    return $amount * 20.34; 
                case "USD":
                    return $amount * 1.09; 
            }
            break;
        case "ZAR":
            switch ($toCurrency) {
                case "EURO":
                    return $amount / 20.34; 
                case "ZAR":
                    return $amount;
                case "USD":
                    return $amount * 0.05; 
            }
            break;
        case "USD":
            switch ($toCurrency) {
                case "EURO":
                    return $amount * 1.09; 
                case "ZAR":
                    return $amount / 0.05; 
                case "USD":
                    return $amount;
            }
            break;
    }
    return $amount;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Dream</title>
    <link href="style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Space+Mono&display=swap" rel="stylesheet"> 
</head>
<body> 
    <h1>Currency Converter</h1><br>

    <form method="POST" id="currencyConverter">
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" step="0.01" placeholder='Enter amount'> 
    <label for="fromcurrency">From</label>
        <select id="fromcurrency" name="fromcurrency">
        <option value="select">Select</option>    
        <option value="EURO">EURO</option>
        <option value="ZAR">ZAR</option>
        <option value="USD">USD</option>
        </select>

        <button class='swap' type="button" onclick="swapCurrencies();" name="action" value="swap"><span class="icon">&#8644;</span></button> 

    <label for="tocurrency">To</label>
        <select id="tocurrency" name="tocurrency">
        <option value="select">Select</option>
        <option value="EURO">EURO</option>
        <option value="ZAR">ZAR</option>
        <option value="USD">USD</option>
        </select>
        <button type="submit" name="action" value="convert">Convert</button>
        <p class='result'>Converted Amount: <?php echo isset($convertedAmount) ? "$convertedAmount $toCurrency" : ""; ?> </p>
    </form>
    <script src="script.js" defer></script>
</body>
</html>