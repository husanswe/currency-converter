<?php
    $result = ' ';
    $amount = 1;
    $from = "USD";
    $to = " ";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $amount = (float)$_POST['amount'];
        $from = strtoupper($_POST['from']);
        $to = strtoupper($_POST['to']);
        
        $url = "https://open.er-api.com/v6/latest/$from";

        $json = file_get_contents($url);
        $data = json_decode($json, true);

        if ($data && $data['result'] === 'success' && isset($data['rates'][$to])) {
            $rate = $data['rates'][$to];
            $result = $amount * $rate;
            $result = number_format($result, 2);
        } else {
            $result = 'Error: API failed or invalid currency';
        }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="dollar-symbol.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <title>Currency Converter</title>
    </head>

    <body>
        <div class="container my-5 text-center text-primary">
            <h1>Simple Currency Converter</h1>
        </div>
        
        <form class="container" action="" method="post">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-6"> 

                        <div class="row g-3 align-items-center">
                            <!-- Left side: Amount + From Currency -->
                            <div class="col-5">
                                <input 
                                    type="number" 
                                    class="form-control form-control-lg text-center fw-bold" 
                                    min="0" 
                                    step="any" 
                                    id="amount" 
                                    name="amount"
                                    placeholder="1"
                                    value="<?= htmlspecialchars($amount) ?>"
                                >
                                <select class="form-select form-select-lg mt-2" id="fromCurrency" name="from">
                                    <option value="USD" selected>USD - United States Dollar</option>
                                    <option value="EUR">EUR - Euro</option>
                                    <option value="UZS">UZS - Uzbekistani Soum</option>
                                    <option value="GBP">GBP - British Pound</option>
                                    <option value="AUD">AUD - Australian Dollar</option>
                                    <option value="CAD">CAD - Canadian Dollar</option>
                                    <option value="CHF">CHF - Swiss Franc</option>
                                    <option value="CNY">CNY - Chinese Yuan</option>
                                    <option value="JPY">JPY - Japanese Yen</option>
                                    <option value="INR">INR - Indian Rupee</option>
                                    <option value="NZD">NZD - New Zealand Dollar</option>
                                    <option value="SGD">SGD - Singapore Dollar</option>
                                    <option value="HKD">HKD - Hong Kong Dollar</option>
                                    <option value="KRW">KRW - South Korean Won</option>
                                    <option value="MXN">MXN - Mexican Peso</option>
                                    <option value="BRL">BRL - Brazilian Real</option>
                                    <option value="ZAR">ZAR - South African Rand</option>
                                    <option value="SEK">SEK - Swedish Krona</option>
                                    <option value="NOK">NOK - Norwegian Krone</option>
                                    <option value="DKK">DKK - Danish Krone</option>
                                    <option value="PLN">PLN - Polish Zloty</option>
                                    <option value="THB">THB - Thai Baht</option>
                                    <option value="MYR">MYR - Malaysian Ringgit</option>
                                    <option value="TRY">TRY - Turkish Lira</option>
                                </select>
                            </div>

                            <!-- Equals sign -->
                            <div class="col-2 text-center d-flex align-items-center justify-content-center">
                                <h3 class="mb-0">=</h3>
                            </div>

                            <!-- Right side: Result + To Currency -->
                            <div class="col-5">
                                <input 
                                    type="text" 
                                    class="form-control form-control-lg text-center fw-bold" 
                                    id="result"
                                    value="<?= htmlspecialchars($result) ?>" 
                                    value=" " 
                                    readonly
                                >
                                <select class="form-select form-select-lg mt-2" id="toCurrency" name="to">
                                    <option value="USD">USD - United States Dollar</option>
                                    <option value="EUR">EUR - Euro</option>
                                    <option value="UZS">UZS - Uzbekistani Soum</option>
                                    <option value="GBP">GBP - British Pound</option>
                                    <option value="AUD">AUD - Australian Dollar</option>
                                    <option value="CAD">CAD - Canadian Dollar</option>
                                    <option value="CHF">CHF - Swiss Franc</option>
                                    <option value="CNY">CNY - Chinese Yuan</option>
                                    <option value="JPY">JPY - Japanese Yen</option>
                                    <option value="INR">INR - Indian Rupee</option>
                                    <option value="NZD">NZD - New Zealand Dollar</option>
                                    <option value="SGD">SGD - Singapore Dollar</option>
                                    <option value="HKD">HKD - Hong Kong Dollar</option>
                                    <option value="KRW">KRW - South Korean Won</option>
                                    <option value="MXN">MXN - Mexican Peso</option>
                                    <option value="BRL">BRL - Brazilian Real</option>
                                    <option value="ZAR">ZAR - South African Rand</option>
                                    <option value="SEK">SEK - Swedish Krona</option>
                                    <option value="NOK">NOK - Norwegian Krone</option>
                                    <option value="DKK">DKK - Danish Krone</option>
                                    <option value="PLN">PLN - Polish Zloty</option>
                                    <option value="THB">THB - Thai Baht</option>
                                    <option value="MYR">MYR - Malaysian Ringgit</option>
                                    <option value="TRY">TRY - Turkish Lira</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5" id="convertBtn">
                                Convert
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>