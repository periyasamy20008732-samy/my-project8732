<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $settings->site_title ?? 'Green Biller' }} | Paynow </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('home-assets/css/paynow.css')}}">
</head>

<body>
    <div class="bg-particles"></div>

    <div class="checkout-container">
        <div class="checkout-header">
            <div class="checkout-title">
                <i class="fas fa-shopping-cart"></i> Paynow
            </div>
            <div class="checkout-subtitle">Complete your purchase</div>
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill"></div>
            </div>
        </div>

        <div class="checkout-summary" id="checkoutSummary">
            <div class="summary-row">
                <span class="summary-label">Name</span>
                <span class="summary-value">{{ $user->name }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Mobile</span>
                <span class="summary-value">{{ $user->mobile }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Package</span>
                <span class="summary-value">{{ $package->package_name }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Amount</span>
                <span class="summary-value">₹ {{ $package->price }}</span>
            </div>
            <!-- <div class="summary-row">
                <span class="summary-label">Platform Fee (2.5%)</span>
                <span class="summary-value">$${fees.toLocaleString()}</span>
            </div> -->
            <div class="summary-row">
                <span class="summary-label">Total</span>
                <span class="summary-value total-value">₹ {{ $package->price }}</span>
            </div>
        </div>


        tet

        <div class="payment-methods">
            <!-- <div class="payment-method-title">
                <i class="fas fa-credit-card"></i> Payment Method
            </div> -->

            <div class="payment-tabs">
                <!-- <div class="payment-tab active" data-tab="card">
                    <i class="fas fa-credit-card"></i> Razorpay
                </div> -->
                <!-- <div class="payment-tab" data-tab="bank">
                    <i class="fas fa-university"></i> Bank
                </div>
                <div class="payment-tab" data-tab="crypto">
                    <i class="fab fa-bitcoin"></i> Crypto
                </div> -->
            </div>

            <!-- <div class="payment-content" id="cardContent">
                <div class="saved-cards">
                    <div class="saved-card selected" data-card="1">
                        <i class="fab fa-cc-visa card-icon"></i>
                        <div class="card-info">
                            <div class="card-number">•••• •••• •••• 4242</div>
                            <div class="card-type">Visa • Expires 12/25</div>
                        </div>
                        <i class="fas fa-check-circle" style="color: #667eea;"></i>
                    </div>

                    <div class="saved-card" data-card="2">
                        <i class="fab fa-cc-mastercard card-icon"></i>
                        <div class="card-info">
                            <div class="card-number">•••• •••• •••• 8888</div>
                            <div class="card-type">Mastercard • Expires 08/26</div>
                        </div>
                    </div>

                    <div class="add-new-card" id="addNewCard">
                        <i class="fas fa-plus"></i> Add New Card
                    </div>
                </div>
            </div> -->

            <!-- <div class="payment-content" id="bankContent" style="display: none;">
                <div class="saved-cards">
                    <div class="saved-card" data-bank="1">
                        <i class="fas fa-university card-icon"></i>
                        <div class="card-info">
                            <div class="card-number">Chase Bank •••• 5678</div>
                            <div class="card-type">Checking Account</div>
                        </div>
                    </div>

                    <div class="saved-card" data-bank="2">
                        <i class="fas fa-university card-icon"></i>
                        <div class="card-info">
                            <div class="card-number">Wells Fargo •••• 9012</div>
                            <div class="card-type">Savings Account</div>
                        </div>
                    </div>

                    <div class="add-new-card" id="addNewBank">
                        <i class="fas fa-plus"></i> Add New Bank Account
                    </div>
                </div>
            </div>

            <div class="payment-content" id="cryptoContent" style="display: none;">
                <div class="saved-cards">
                    <div class="saved-card" data-crypto="btc">
                        <i class="fab fa-bitcoin card-icon"></i>
                        <div class="card-info">
                            <div class="card-number">Bitcoin Wallet</div>
                            <div class="card-type">BTC • 1.2 BTC Available</div>
                        </div>
                    </div>

                    <div class="saved-card" data-crypto="eth">
                        <i class="fab fa-ethereum card-icon"></i>
                        <div class="card-info">
                            <div class="card-number">Ethereum Wallet</div>
                            <div class="card-type">ETH • 5.8 ETH Available</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form class="checkout-form" id="checkoutForm">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" required>
            </div>

            <div class="form-group">
                <label for="card">Card Number</label>
                <input type="text" id="card" maxlength="19" placeholder="1234 5678 9012 3456" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="exp">Expiry Date</label>
                    <input type="text" id="exp" maxlength="5" placeholder="MM/YY" required>
                </div>

                <div class="form-group">
                    <label for="cvc">CVC</label>
                    <input type="text" id="cvc" maxlength="4" placeholder="123" required>
                </div>
            </div>

            <div class="security-badge">
                <i class="fas fa-shield-alt"></i>
                <span>Secured with 256-bit SSL encryption</span>
            </div>
        </form> -->

            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <form method="POST" action="{{ route('razorpay.order') }}">
                @csrf
                <input type="text" name="username" value="{{ $user->name }}" hidden>
                <input type="text" name="mobile" value="{{ $user->mobile }}" hidden>
                <input type="text" name="email" value="{{ $user->email }}" hidden>
                <input type="text" name="amount" value="{{ $package->price }}" hidden>
                <!-- <button type="submit">Pay Now</button> -->


                <button class="checkout-btn" type="submit" id="checkoutBtn">
                    <i class="fas fa-lock"></i> Paynow
                </button>

            </form>

            <!-- <div class="checkout-success" id="checkoutSuccess" style="display:none;">
                <i class="fas fa-check-circle"></i>
                <div>Purchase successful!</div>
                <div style="font-size: 1rem; margin-top: 10px; opacity: 0.8;">
                    Redirecting to your dashboard...
                </div>
            </div> -->
        </div>
    </div>
    <center style="margin-top: 50px;">
        <div class="text-muted">Copyright &copy; {{ date('Y') }} {{ $settings->site_title}}
            v{{ $settings->app_version  }}
        </div>

    </center>

    @if(isset($orderId))
        <script>
            var options = {
                "key": "{{ $razorpayKey }}",
                "amount": "{{ $amount }}",
                "currency": "INR",
                "name": "Test App",
                "description": "Test Transaction",
                "order_id": "{{ $orderId }}",
                "prefill": {
                    "name": "{{ $user->name }}",
                    "email": "{{ $user->email }}",
                    "contact": "{{ $user->mobile }}"
                },
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