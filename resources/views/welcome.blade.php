<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Menu practictal test Uros Stosic</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Styles -->
        <style>
            .title {
                margin: 80px;
            }
        </style>
    </head>
    <body>

    {{--show errors--}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{--show success status--}}
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <h3 class="text-center title">What currency you want to purchase?</h3>


    <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
            <form method="post" action="{{ action('OrderController@store') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select currency:</label>
                    <select name="currency_id" class="form-control" id="exampleFormControlSelect1">
                        @foreach($currencies as $currency)
                        <option value="{{ $currency->id }}" data-currency="{{ $currency->exchange_rate }}" selected>{{ $currency->name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" placeholder="amount" autocomplete="off">
                </div>

                <div>
                    <p>You need to pay USD: <b id="paid-amount"></b></p>
                </div>

                <button id="calculate-button" class="btn btn-info" style="display: none">Calculate</button>
                <button id="submit-button" class="btn btn-primary" style="display: none">Purchase</button>
            </form>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        /*store input amount in variable*/
        let amountInput = $('#amount');
        let amount;
        let currencyRate = $( "select option:selected" ).data('currency');
        let currencyId = $( "select option:selected" ).attr('value');
        let usdToPay;
        let wrapperForShowUsdAmount = $('#paid-amount');
        let calculateButton = $('#calculate-button');;

        /*select currency on change and store in variable*/
        $('select').on('change', function() {
            currencyRate = $( "select option:selected" ).data('currency');
            currencyId = $( "select option:selected" ).attr('value');

            // if currency is changed and amount is chosen then calculate again for new currency
            if(amount > 0) {
                showCalculateButton();
            }
        });

        /*on key up for currency amount*/
        amountInput.keyup(function () {
            // set amount number
            amount = amountInput.val();

            // set how much is needed to pay usd for chosen currency
            usdToPay = amount * currencyRate;

            showCalculateButton();
        });

        // show submit button if it's invisible and amount is greater then 0
        function showCalculateButton() {
            if(amount > 0) {
                calculateButton.show();
            } else {
                calculateButton.hide();
            }
        }

        calculateButton.on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: "/api/calculate_paid_in_usd",
                type: 'GET',
                data: {
                    'amount': amount,
                    'currency_id': currencyId
                },
                success: function (res) {
                    wrapperForShowUsdAmount.text(res);
                    $('#submit-button').show();
                }
            });
        })
    </script>
    </body>
</html>
