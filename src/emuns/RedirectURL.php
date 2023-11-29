<?php

namespace App\emuns;

enum RedirectURL: string
{
    case CREDIT_CARD_URL = 'https://partseurope.info/testingng-credit-card/';
    case PAYPAL_URL = 'https:///partseurope.info/testing-paypal/';
    case BANK_TRANSFER_URL = 'https://partseurope.info/testing-bank-transfer-card/';
    case CASH_ON_DELIVERY_URL = 'https://partseurope.info/testing-cod/';
}