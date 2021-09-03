<form class="w3-container w3-display-middle w3-card-4 " method="POST" id="payment-form"
      action="{{route('pay-paypal')}}">
    {{ csrf_field() }}
    <h2 class="w3-text-blue">Payment Form</h2>
    <p>Demo PayPal form - Integrating paypal in laravel</p>
    <label class="w3-text-blue"><b>Enter Amount</b></label>
    <input class="w3-input w3-border" name="amount" type="text">
    <button class="w3-btn w3-blue">Pay with PayPal</button>
</form>
