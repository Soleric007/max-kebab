<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdatedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public Order $order,
        public string $previousStatus,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Max Kebab order '.$this->order->reference.' is now '.$this->statusLabel($this->order->status),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.orders.status-updated',
            with: [
                'brand' => config('maxkebab.brand'),
                'currentStatusLabel' => $this->statusLabel($this->order->status),
                'previousStatusLabel' => $this->statusLabel($this->previousStatus),
            ],
        );
    }

    private function statusLabel(string $status): string
    {
        return match ($status) {
            'ready_for_collection' => 'Ready for collection',
            'out_for_delivery' => 'Out for delivery',
            default => ucfirst(str_replace('_', ' ', $status)),
        };
    }
}
