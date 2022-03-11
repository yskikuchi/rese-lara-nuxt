<script src="https://js.stripe.com/v3/"></script>

{{$session->id}}
<button id="checkoutBtn">購入</button>

<script>
    const stripe = Stripe('pk_test_51KYWicFX2AvtAV4rRtkrcegf5zili5IPohljLA9Lyos3F8XrXUbV0olDhJ1UmrLdB8EsG5rZ6i7ZD5MJcYQmaPzE00qbvskp5i');

  const checkout = document.getElementById('checkoutBtn');
  checkout.addEventListener("click", () => {
    console.log('a');
    stripe.redirectToCheckout({
      sessionId: '{{ $session->id }}'
    }).then(function (result) {
    if (result.error) {
      console.log(result.error);
    }
    });
  });


</script>
