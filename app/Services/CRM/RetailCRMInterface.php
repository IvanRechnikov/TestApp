<?php


namespace App\Services\CRM;


interface RetailCRMInterface
{
    public function fetchProducts(): array;

    public function createOrder(array $data): array;
}
