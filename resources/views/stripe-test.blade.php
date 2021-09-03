<div class="links">
    <form class="w3-container w3-display-middle w3-card-4 " method="POST" id="payment-form" action="{{route('stripe-submit')}}">
        {{ csrf_field() }}
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_51HknLFEqp4RNAwQbQWgkeepcXd6Kk0c1T3LJGRYpb7qfJnlaPrAHaMSP5zAoJ5qceRZDIZIKn4LPPyDFFFQL7fqY00Jg2GfUDL"
            data-amount="10"
            data-name="Juang Salaz"
            data-description="Example charge"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="usd">
        </script>
    </form>
</div>
