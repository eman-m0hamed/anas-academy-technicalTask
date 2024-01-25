
    @extends('Template')

@section('title')
    <title>Payment Confirmation</title>
@endsection

@section('main')
<section class="container">

    <h1 class="alert alert-success">Payment Successful!</h1>

    <p>Thank you for your payment. Here are the transaction details:</p>

    <ul>
        <li>Transaction ID: {{ $transactionId }}</li>
        <li>Transaction Data: {{ json_encode($transactionData) }}</li>
    </ul>
</section>
@endsection
