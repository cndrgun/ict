<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderListRequest;
use App\Http\Resources\OrderListResource;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class Api
{

    public function orders(OrderListRequest $request)
    {
        try {
            // FIXME order_no ile de liste çekilebilecek, order_no alanı gönderilmiyorsa tüm siparişler listelenecek.

             $orders = Orders::with([
                'products',
                'customer',
                'status',
            ])
            ->where('customer_id', $request->get('customer_id'))
            ->orderBy('id', 'DESC');
            

            if(isset($request->order_no)) $orders->where('order_no', $request->get('order_no'));

            $data = OrderListResource::collection($orders->get());

            return response()->json([
                'orders' => $data->resolve(),
            ], 200);
            

        } catch (\Exception $e) {
            ;
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => 'Hata'
            ], 500);

        }
    }
}
