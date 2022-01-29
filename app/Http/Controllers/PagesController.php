<?php

namespace App\Http\Controllers;

use App\Services\CRM\RetailCRM;
use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    private RetailCRM $retailCRM;

    public function __construct(RetailCRM $retailCRM)
    {
        $this->retailCRM = $retailCRM;
    }

    public function index()
    {
        try {
            return view('index', $this->retailCRM->fetchArticlesAndBrands());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return abort(500);
        }

    }
}
