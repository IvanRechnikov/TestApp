<?php


namespace App\Services\Orders;


use App\Services\CRM\RetailCRM;

interface OrdersServiceInterface
{
    public function create(string $fullName, string $comment, string $vendorCode, string $brand): array;
}
