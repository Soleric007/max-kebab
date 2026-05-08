<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Order Update</title>
</head>
<body style="margin:0;background:#0b0b0d;color:#ffffff;font-family:Arial,Helvetica,sans-serif;">
    <div style="max-width:680px;margin:0 auto;padding:32px 20px;">
        <div style="background:#17181d;border:1px solid rgba(255,255,255,0.08);border-radius:24px;overflow:hidden;">
            <div style="background:#ff5a1f;padding:18px 24px;">
                <div style="font-size:28px;font-weight:800;letter-spacing:0.08em;text-transform:uppercase;">Max Kebab</div>
            </div>

            <div style="padding:28px 24px 16px;">
                <p style="margin:0 0 14px;font-size:14px;letter-spacing:0.18em;text-transform:uppercase;color:#ffb28f;">Order Status Update</p>
                <h1 style="margin:0 0 16px;font-size:34px;line-height:1.1;">Order {{ $order->reference }}</h1>
                <p style="margin:0 0 20px;font-size:17px;line-height:1.7;color:rgba(255,255,255,0.82);">
                    Hi {{ $order->customer_name }}, your order status has changed from <strong>{{ $previousStatusLabel }}</strong> to <strong>{{ $currentStatusLabel }}</strong>.
                </p>

                <div style="background:#101114;border-radius:18px;padding:18px 20px;margin-bottom:20px;">
                    <p style="margin:0 0 10px;color:#ffb28f;font-weight:700;">Order details</p>
                    <p style="margin:0 0 8px;color:rgba(255,255,255,0.82);">Type: {{ ucfirst(str_replace('_', ' ', $order->order_type)) }}</p>
                    @if ($order->collection_time)
                        <p style="margin:0 0 8px;color:rgba(255,255,255,0.82);">Preferred time: {{ $order->collection_time }}</p>
                    @endif
                    @if ($order->order_type === 'delivery' && $order->delivery_address)
                        <p style="margin:0 0 8px;color:rgba(255,255,255,0.82);">Delivery address: {{ $order->delivery_address }}</p>
                    @endif
                    @if ($order->order_type === 'delivery' && $order->delivery_postcode)
                        <p style="margin:0;color:rgba(255,255,255,0.82);">Postcode: {{ $order->delivery_postcode }}</p>
                    @endif
                </div>

                <div style="margin-bottom:20px;">
                    @foreach ($order->items as $item)
                        <div style="display:block;padding:14px 0;border-bottom:1px solid rgba(255,255,255,0.08);">
                            <div style="font-weight:700;margin-bottom:4px;">{{ $item->product_name }} x{{ $item->quantity }}</div>
                            @if ($item->selected_option)
                                <div style="font-size:14px;color:rgba(255,255,255,0.65);margin-bottom:4px;">Option: {{ $item->selected_option }}</div>
                            @endif
                            <div style="color:#ffcc4d;">£{{ number_format((float) $item->line_total, 2) }}</div>
                        </div>
                    @endforeach
                </div>

                <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;background:#101114;border-radius:18px;padding:18px 20px;">
                    <div>
                        <div style="font-size:13px;letter-spacing:0.14em;text-transform:uppercase;color:rgba(255,255,255,0.55);">Total</div>
                        <div style="font-size:28px;font-weight:800;color:#ffcc4d;">£{{ number_format((float) $order->total, 2) }}</div>
                    </div>
                    <div style="text-align:right;color:rgba(255,255,255,0.75);font-size:14px;line-height:1.6;">
                        <div>{{ $brand['service_modes'] }}</div>
                        <div><a href="tel:{{ preg_replace('/\s+/', '', $brand['phone']) }}" style="color:#ffb28f;text-decoration:none;">{{ $brand['phone_display'] }}</a></div>
                    </div>
                </div>
            </div>

            <div style="padding:0 24px 28px;color:rgba(255,255,255,0.65);font-size:14px;line-height:1.7;">
                Need anything else? Call the shop on <a href="tel:{{ preg_replace('/\s+/', '', $brand['phone']) }}" style="color:#ffb28f;text-decoration:none;">{{ $brand['phone_display'] }}</a> or visit us at {{ $brand['address'] }}.
            </div>
        </div>
    </div>
</body>
</html>
