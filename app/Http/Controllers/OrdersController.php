<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Services\Orders\OrdersService;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    private OrdersService $service;

    public function __construct(OrdersService $service)
    {
        $this->service = $service;
    }

    public function create(CreateOrderRequest $request)
    {
        try {
            $order = $this->service->create(
                $request->input('full_name'),
                $request->input('comment'),
                $request->input('vendor_code'),
                $request->input('brand'),
            );
            return redirect()->to('/')->with('order', $order);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return abort(500);
        }
    }
}
