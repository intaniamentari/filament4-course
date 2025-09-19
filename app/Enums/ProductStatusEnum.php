<?php

namespace App\Enums;

enum ProductStatusEnum: string
{
    case IN_STOCK = "In stock";
    case SOLD_OUT = "Sold out";
    case COMING_SOON = "Coming soon";
}
