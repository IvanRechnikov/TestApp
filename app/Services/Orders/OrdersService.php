<?php


namespace App\Services\Orders;


use App\Services\CRM\RetailCRM;

class OrdersService implements OrdersServiceInterface
{
    private RetailCRM $retailCRM;

    public function __construct(RetailCRM $retailCRM)
    {
        $this->retailCRM = $retailCRM;
    }

    /**
     * @throws \Exception
     */
    public function create(string $fullName, string $comment, string $vendorCode, string $brand): array
    {
        try {
            $products = $this->retailCRM->fetchProducts();
            $filteredProducts = array_filter($products, function ($item) use ($vendorCode, $brand) {
                return $item['manufacturer'] === $brand && $item['article'] === $vendorCode;
            });
            if (!empty($filteredProducts)) {
                $product = array_shift($filteredProducts);
            }
            $name = explode(' ', $fullName);
            $order = $this->retailCRM->createOrder([
                'order' => json_encode([
                    'status' => 'trouble',
                    'orderType' => 'fizik',
                    'number' => '09032003',
                    'firstName' => $name[0],
                    'lastName' => $name[1],
                    'patronymic' => $name[2],
                    'orderMethod' => 'test',
                    'items' => [
                        [
                            'id' => $product['offers'][0]['id'],
                            'comment' => $comment,
                            'productName' => $product['offers'][0]['name'],
                            'properties' => [
                                'article' => [
                                    'name' => 'Артикул',
                                    'value' => $vendorCode
                                ],
                                'brand' => [
                                    'name' => 'Бренд',
                                    'value' => $brand
                                ]
                            ]
                        ]
                    ]
                ])
            ]);
            return $order;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
