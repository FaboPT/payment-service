<?php

namespace App\emuns;

enum TransferCosts: string
{
    case CREDIT_CARD_TRANSFER_COST = '0.40';
    case PAYPAL_OR_CASH_ON_DELIVERY_TRANSFER_COST = '0';
    case BANK_TRANSFER_TRANSFER_COST = '1.40';

}
