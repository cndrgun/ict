<?php

namespace App\Libraries;

use Illuminate\Support\Facades\DB;

class OrderStatistics
{

    public function countProductsByStatus()
    {
        return DB::table('orders')
                    ->select(
                        'orders.status_id',
                        'order_statuses.status AS status_name',
                        DB::raw('COUNT(order_products.id) AS product_count')
                    )
                    ->join('order_statuses', 'order_statuses.id', '=', 'orders.status_id')
                    ->leftJoin('order_products', 'order_products.order_id', '=', 'orders.id')
                    ->groupBy('orders.status_id', 'order_statuses.status')
                    ->get();
    }

    
    public function getTopFiveNotStockProducts()
    {

        return DB::table('products')
                ->select('products.id', 'products.name', DB::raw('COUNT(order_products.id) AS usage_count'))
                ->join('order_products', 'order_products.product_id', '=', 'products.id')
                ->join('orders', 'orders.id', '=', 'order_products.order_id')
                ->where('products.stock_status', false) // Stokta olmayan ürünler
                ->where('orders.order_date', '>=', now()->subYear()) // Son 1 yıl 
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('orders as o')
                        ->whereColumn('o.id', 'order_products.order_id')
                        ->where('o.order_date', '>=', now()->subMonth()); // Son 1 ay 
                })
                ->groupBy('products.id', 'products.name')
                ->orderBy('usage_count', 'desc')
                ->limit(5)
                ->get();

    }
}
