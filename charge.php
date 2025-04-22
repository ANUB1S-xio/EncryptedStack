<?php
// This loads the Stripe library
require 'stripe/init.php';

// This will set your secret Stripe API key (it uses environment variables in production)
\Stripe\Stripe::setApiKey('sk_test_51RGVh9GhtDQiIcjcq8f3vTZRw83T8kx4oAAR8zdledu3UItY5PLmFqELejVvpxapcVnfFfQTyjcc4uqwmgqnmXiM00GY92gbLn');

// This will create a Stripe Checkout session for a simple purchase
$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'], // It accepts card payments
    'line_items' => [[
        'price_data' => [
            'currency' => 'usd',
            'product_data' => [
                'name' => 'The Cyber Dummy Guide' // This is a friendly, approachable product title
            ],
            'unit_amount' => 1 // Shows the amount in cents (example, $0.01) it's a  placeholder
        ],
        'quantity' => 1 // A Single unit
    ]],
    'mode' => 'payment',

    // This is where to go if the payment is successful. It will take the user to a friendly thank you page
    'success_url' => 'https://sec-reads-rg-bme6fxcdfbdxfngk.canadacentral-01.azurewebsites.net/success.php',

    // This is where to go if they cancel. It will go back to cart so the user can make changes
    'cancel_url' => 'https://sec-reads-rg-bme6fxcdfbdxfngk.canadacentral-01.azurewebsites.net/cart.php'
]);

// Redirect the user to Stripe’s secure checkout
header("Location: " . $session->url);
exit;
?>
