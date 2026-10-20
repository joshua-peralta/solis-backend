<?php

namespace App\GraphQL\Mutations;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Support\Str;

class OrderMutator
{
    public function updateAddress($_, array $args, $context): Address
    {
        $user = $context->user();

        return Address::updateOrCreate(
            ['user_id' => $user->id, 'is_default' => true],
            [
                'street' => $args['street'],
                'city' => $args['city'],
                'state' => $args['state'],
                'postal_code' => $args['postal_code'],
            ]
        );
    }

    public function createOrder($_, array $args, $context): Order
    {
        $user = $context->user();
        $subtotal = 0;
        $orderItemsData = [];

        foreach ($args['items'] as $item) {
            $variant = ProductVariant::findOrFail($item['product_variant_id']);
            $lineTotal = $variant->price_cents * $item['quantity'];
            $subtotal += $lineTotal;

            $orderItemsData[] = [
                'product_variant_id' => $variant->id,
                'quantity' => $item['quantity'],
                'unit_price_cents' => $variant->price_cents,
            ];
        }

        // Free shipping if subtotal >= $50.00 (5000 cents), otherwise $5.00 (500 cents)
        $shipping = $subtotal >= 5000 ? 0 : 500;
        $total = $subtotal + $shipping;

        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'SOLIS-' . strtoupper(Str::random(6)),
            'status' => 'Processing',
            'subtotal_cents' => $subtotal,
            'shipping_cents' => $shipping,
            'total_cents' => $total,
        ]);

        foreach ($orderItemsData as $itemData) {
            $order->items()->create($itemData);
        }

        return $order->load('items.variant');
    }
}