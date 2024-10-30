<h1>Thank you for your order!</h1>
<p>Dear {{ $order->name }},</p>
<p>We have received your order for {{ $order->product_title }}.</p>
<p>Your order details are as follows:</p>
<ul>
    <li>Product: {{ $order->product_title }}</li>
    <li>Quantity: {{ $order->quantity }}</li>
    <li>Price: &#8369; {{ $order->price }}</li>
    <li>Delivery Address: {{ $order->address }}, {{ $order->city }}, {{ $order->province }}, {{ $order->barangay }}</li>
</ul>
<p>Thank you for shopping with us!</p>
