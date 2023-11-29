<?php

namespace App\Utils;

use App\emuns\DeliveryCosts;
use App\emuns\PaymentMethodType;
use App\emuns\TransferCosts;

final class Calculate
{
    private const VAT_VALUE = 1.18;

    public static function costsByPaymentMethodType(string $paymentMethodType): float
    {
        return match ($paymentMethodType) {
            PaymentMethodType::CREDIT_CARD->value => (float)TransferCosts::CREDIT_CARD_TRANSFER_COST->value + (float) DeliveryCosts::CREDIT_CARD_DELIVERY_COST->value,
            PaymentMethodType::PAYPAL->value => (float)TransferCosts::PAYPAL_OR_CASH_ON_DELIVERY_TRANSFER_COST->value + (float) DeliveryCosts::PAYPAL_DELIVERY_COST->value,
            PaymentMethodType::BANK_TRANSFER->value => (float)TransferCosts::BANK_TRANSFER_TRANSFER_COST->value + (float) DeliveryCosts::BANK_TRANSFER_DELIVERY_COST->value,
            PaymentMethodType::CASH_ON_DELIVERY->value => (float)TransferCosts::PAYPAL_OR_CASH_ON_DELIVERY_TRANSFER_COST->value + (float) DeliveryCosts::CASH_ON_DELIVERY_DELIVERY_COST->value,
            default => 0
        };
    }

    public static function totalAmount(float $amount, float $costs): float
    {
        return number_format($amount + $costs,2);
    }

    public static function totalVatAmount(float $amount): float
    {
        return number_format($amount * self::VAT_VALUE, 2);
    }
}
