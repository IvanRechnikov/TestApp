<?php


namespace App\Services\CRM;


use Illuminate\Support\Facades\Http;

class RetailCRM implements RetailCRMInterface
{
    private const HOST = 'retailcrm.ru';
    private const PRODUCTS_LIST = '/api/v5/store/products';
    private const CREATE_ORDER = '/api/v5/orders/create';

    /**
     * @throws \Exception
     */
    public function fetchProducts(): array
    {
        try {
            return Http::withHeaders($this->headers())->get($this->host() . self::PRODUCTS_LIST)->json()['products'];
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @throws \Exception
     */
    public function createOrder(array $data): array
    {
        try {
            $res = Http::withHeaders($this->headers())->post($this->host() . self::CREATE_ORDER, $data);
            if ($res->json()['success'] !== true) {
                throw new \Exception('Ошибка при создании заказа');
            }
            return $res->json();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @throws \Exception
     */
    public function fetchArticlesAndBrands(): array
    {
        try {
            $products = $this->fetchProducts();
            return [
                'vendorCodes' => array_map(function ($product) {
                    return [
                        'value' => $product['article'],
                        'label' => $product['article'],
                    ];
                }, $products),
                'brands' => array_map(function ($product) {
                    return [
                        'value' => $product['manufacturer'],
                        'label' => $product['manufacturer'],
                    ];
                }, $products)
            ];
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function host(): string
    {
        return 'https://' . env('RETAIL_CRM_DOMAIN') . '.' . self::HOST;
    }

    private function headers(): array
    {
        return [
            'X-API-KEY' => env('RETAIL_CRM_KEY')
        ];
    }
}
