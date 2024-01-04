function swapCurrencies() {
    var fromCurrency = document.getElementById('fromcurrency').value;
    var toCurrency = document.getElementById('tocurrency').value;

    document.getElementById('fromcurrency').value = toCurrency;
    document.getElementById('tocurrency').value = fromCurrency;
}