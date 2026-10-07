<?php

namespace App\Enums;

enum InquiryType: int
{
    case FarmerSupport = 1;
    case StockPoint = 2;
    case Partnership = 3;
    case Career = 4;
    case ProductEnquiry = 5;
    case Technology = 6;
    case GeneralEnquiry = 7;

    public function label(): string
    {
        return match ($this) {
            self::FarmerSupport => 'Farmer Support',
            self::StockPoint => 'Stock Point',
            self::Partnership => 'Partnership',
            self::Career => 'Career',
            self::ProductEnquiry => 'Product Enquiry',
            self::Technology => 'Technology',
            self::GeneralEnquiry => 'General Enquiry',
        };
    }
}
