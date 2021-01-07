<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

$destinationsArray = ['INDONESIA' => 'IDR', 'PHILIPPINES' => 'PHP', 'ARUBA' => 'AWG', 'UNITED STATES' => 'USD',  ];
$exchangeRateArray = ['IDR' => 17170.99, 'PHP' => 59.33, 'AWG' => 2.22, 'USD' => 1.23,  ];

// define variables and set to empty values
$destinationError = $localValueError = "";

$destination = $exchangeCurrency = "";
$localValue = $exchangeRate = $exchangeValue = 0.0;

if (isset($_POST['submit'])) {
/*    if (empty($_POST["destination"])) {
        $destinationError = "Destination is required";
    } elseif (!array_key_exists($_POST["destination"],$destinationsArray)) {
        $destinationError = "Destination is not found.";
    } else {
        $destination = $_POST["destination"];
    }*/

    if (empty($_POST["localValue"])) {
        $localValueError = "Local Value is required";
    } else {
        $localValue = $_POST["localValue"];
    }

    $exchangeCurrency = $_POST["exchangeCurrency"];

    if ($destinationError === "" && $localValueError === ""){
       // $exchangeCurrency = $destinationsArray[$destination];
        $exchangeRate = $exchangeRateArray[$exchangeCurrency];
        $exchangeValue = getExchangeValue($localValue,$exchangeRate);
    }

}

function getExchangeValue($value, $rate) {
    return $value * $rate;
}


?>

<h1><?php echo implode('-', array_keys($destinationsArray)) ?></h1>
<h2>SELECT YOUR DESTINATION</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="">

    <label for="destination" class="destination">Destination</label>
   <!-- <input id="destination" type="text" name="destination" value =<?php /*echo $destination;*/?> >-->
    <!--<span class="error">* <?php /*echo $destinationError;*/?></span>-->
    <select name = "exchangeCurrency">
        <?php foreach($destinationsArray as $key => $value) { ?>
            <option value="<?php echo $value ?>"><?php echo $key ?></option>
        <?php }?>
    </select>

    <label for="localCurrency" class="local-currency">Local currency</label>
    <input id="localCurrency" type="text" value="EUR" disabled>

    <label for="localValue" class="local-value">Local value</label>
    <input id="localValue" type="text" name="localValue" value =<?php echo $localValue;?> >
    <span class="error">* <?php echo $localValueError;?></span>

    <label for="exchangeCurrency" class="exchange-currency">Exchange currency</label>
    <input id="exchangeCurrency" type="text" disabled value =<?php echo $exchangeCurrency;?> >

    <label for="exchangeRate" class="exchange-rate">Exchange rate</label>
    <input id="exchangeRate" type="text" disabled value =<?php echo $exchangeRate;?> >

    <label for="exchangeValue" class="exchange-value">Exchange value</label>
    <input id="exchangeValue" type="text" disabled value =<?php echo $exchangeValue;?> >

    <input type="submit" name="submit" class="button" value="Submit">
</form>

</body>
</html>