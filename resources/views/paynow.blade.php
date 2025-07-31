<!DOCTYPE html>
<html>

<head>
    <title>Razorpay Payment</title>

</head>

<body>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <form method="POST" action="{{ route('razorpay.order') }}">
        @csrf
        <button type="submit">Pay Now</button>
    </form>

    @if(isset($orderId))
        <script>
            var options = {
                "key": "{{ $razorpayKey }}",
                "amount": "{{ $amount }}",
                "currency": "INR",
                "name": "Test App",
                "description": "Test Transaction",
                "order_id": "{{ $orderId }}",
                "handler": function (response) {
                    // Send payment details to Laravel backend
                    fetch('{{ route("razorpay.success") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            payment_id: response.razorpay_payment_id,
                            order_id: response.razorpay_order_id,
                            signature: response.razorpay_signature
                        })
                    }).then(res => res.text())
                        .then(msg => alert("Payment Success! " + msg));
                },
                "modal": {
                    "ondismiss": function () {
                        alert("Payment was cancelled or failed.");
                        // Optionally redirect or show a message
                    }
                },
                "theme": {
                    "color": "#528FF0"
                }
            };
            var rzp = new Razorpay(options);
            rzp.open();
        </script>
    @endif
</body>

</html>