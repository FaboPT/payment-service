<?php

namespace App\Services;

use App\emuns\DeliveryCosts;
use App\emuns\PaymentMethodType;
use App\emuns\RedirectURL;
use App\emuns\TransferCosts;
use App\Utils\Calculate;
use App\Utils\GenerateUrl;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

final class PaymentService
{
    public function __construct(
        private readonly float $amount,
        private readonly string $username,
        private readonly string $email,
        private readonly string $paymentMethod,
    ){
    }

    /**
     * @throws Exception
     */
    public function payment(): JsonResponse
    {
        $costs = Calculate::costsByPaymentMethodType($this->paymentMethod);
        $totalAmount = Calculate::totalAmount($this->amount,$costs);
        $totalVatAmount = Calculate::totalVatAmount($this->amount);
        $redirectUrl = GenerateUrl::url($totalVatAmount, $this->paymentMethod, $this->email, $this->username);


        return new JsonResponse(compact('totalAmount','totalVatAmount', 'redirectUrl'));
    }



}