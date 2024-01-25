<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f8f8;
        }

        #payment-form {
            max-width: 400px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #payment-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        #payment-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #card-element {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 4px;
        }

        #card-errors {
            color: #dc3545;
            font-size: 14px;
            margin-top: 8px;
        }

        #submit {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #submit:hover {
            background-color: #0056b3;
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

    <form action="{{ route('process.payment') }}" method="post" id="payment-form" name="payment-form">
        <h2>Payment Form</h2>

        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" placeholder="Enter amount">

        <label for="card-element">Credit or debit card:</label>
        <div id="card-element"></div>
        <div id="card-errors" role="alert"></div>

        <button id="submit" type="submit">Pay</button>
    </form>

    <script>
        var stripe = Stripe('pk_test_51NMG5HBOd8aeuPCHE7GkxIOqtbWp04AOL38PUw8RvGeeAgI4UINEeZBa49XwSK5YbBsDbwOHoi8JPg7Va1g6mvqV00sC0xemgv');
        var elements = stripe.elements();

        var style = {
            base: {
                fontSize: '16px',
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        var card = elements.create('card', { style: style });

        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');

        // submit form
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createPaymentMethod({
                type: 'card',
                card: card,
            }).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.paymentMethod);
                }
            });
        });

        function stripeTokenHandler(paymentMethod) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method');
            hiddenInput.setAttribute('value', paymentMethod.id);
            form.appendChild(hiddenInput);
            console.log('stripeTokenHandler called!', paymentMethod);
           
            console.log('Form:', form);
            form.submit();
        }
    </script>

</body>
</html>
