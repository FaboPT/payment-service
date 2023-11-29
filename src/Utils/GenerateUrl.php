<?php

namespace App\Utils;

use App\emuns\PaymentMethodType;
use App\emuns\RedirectURL;
use Exception;

final class GenerateUrl
{
    private const MAX_LENGTH_RANDOM_STRING = 10;

    public static function url(float $totalAmountVat, string $paymentMethodType, string $email, string $username):string
    {
        return match ($paymentMethodType) {
            PaymentMethodType::CREDIT_CARD->value => self::generateUrlForCreditCard($totalAmountVat, $username),
            PaymentMethodType::PAYPAL->value => self::generateUrlForPaypal($totalAmountVat, $email),
            PaymentMethodType::BANK_TRANSFER->value => self::generateUrlForBank($totalAmountVat, $username ),
            PaymentMethodType::CASH_ON_DELIVERY->value => self::generateUrlCash($totalAmountVat),
        };
    }

    private static function generateUrlForBank(float $totalAmountVat, $username):string
    {
        return sprintf(RedirectURL::BANK_TRANSFER_URL->value.'/%s/%s', md5($username), $totalAmountVat);
    }

    private static function generateUrlForCreditCard(float $totalAmountVat, string $username): string
    {
        return sprintf(RedirectURL::CREDIT_CARD_URL->value.'/%s/%s', $username, $totalAmountVat);

    }

    private static function generateUrlForPaypal(float $totalAmountVat, string $email): string
    {
        return sprintf(RedirectURL::PAYPAL_URL->value.'/%s/%s', $email, $totalAmountVat);
    }

    /**
     * @throws Exception
     */
    private static function generateUrlCash(float $totalAmountVat): string
    {
        return sprintf(RedirectURL::CASH_ON_DELIVERY_URL->value.'/%s/%s', self::generateRandomString(), $totalAmountVat);
    }

    private static function generateRandomString(): string
    {
        $randomString = sha1(mt_rand());

        return substr($randomString,0, self::MAX_LENGTH_RANDOM_STRING);
    }

}