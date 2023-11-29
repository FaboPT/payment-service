<?php

namespace App\emuns;

enum DeliveryCosts: string
{
    case CREDIT_CARD_DELIVERY_COST = '2.00';
    case PAYPAL_DELIVERY_COST = '2.5';
    case BANK_TRANSFER_DELIVERY_COST = '0';
    case CASH_ON_DELIVERY_DELIVERY_COST = '5.50';

}
