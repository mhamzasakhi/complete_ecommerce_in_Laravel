<div class="links">
    <form class="w3-container w3-display-middle w3-card-4 " method="POST" id="payment-form"
          action="{{route('paytm-submit')}}">
        {{ csrf_field() }}
        <button type="submit">submit</button>
    </form>
</div>
