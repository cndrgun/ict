<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;


class ProductController extends Controller
{

    public function get(int $productId)
    {

        try{

            $product = Products::find($productId);

            if (!$product) {

                return response()->json([
                    'status'    => false,
                    'error'     => '',
                    'message'   => 'Ürün Bulunamadı'
                ], 404);
                
            }

            return response()->json([
                'status'  => true,
                'message' => 'Başarılı',
                'product' => new ProductResource($product),
            ], 200);

        } catch (\Exception $e) {
            
            return response()->json([
                'status'    => false,
                'error'     => 'Sunucu Hatası',
                'message'   => 'Hata'
            ], 500);

        }
    }

    public function store(StoreProductRequest $request)
    {

        try{

            $product = Products::create($request->validated());

            return response()->json([
                'status'  => true,
                'message' => 'ürün Ekleme Başarılı',
                'product' => new ProductResource($product),
            ], 200);

        } catch (\Exception $e) {
            
            return response()->json([
                'status'    => false,
                'error'     => 'Sunucu Hatası',
                'message'   => 'Hata'
            ], 500);

        }
    }


    public function update(UpdateProductRequest $request, int $id)
    {
        try{

            $product = Products::withTrashed()->find($id);

            if (!$product) {

                return response()->json([
                    'status'    => false,
                    'error'     => '',
                    'message'   => 'Ürün Bulunamadı'
                ], 404);

            }

            $deletedMessage = $product->trashed() ? '(Ürün daha önce silinmiş.)' : '';

            $product->update($request->validated());

            return response()->json([
                'status'  => true,
                'message' => 'Başarılı '. $deletedMessage,
                'product' => new ProductResource($product),
            ], 200);

        } catch (\Exception $e) {
                
            return response()->json([
                'status'    => false,
                'error'     => 'Sunucu Hatası',
                'message'   => 'Hata'
            ], 500);

        }

    }


    public function destroy(int $id)
    {
        try{

            $product = Products::find($id);

            if (!$product) {

                return response()->json([
                    'status'    => false,
                    'error'     => '',
                    'message'   => 'Ürün Bulunamadı'
                ], 404);

            }

            $product->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Başarılı',
                'product' => new ProductResource($product),
            ], 200);

        } catch (\Exception $e) {
                    
            return response()->json([
                'status'    => false,
                'error'     => 'Sunucu Hatası',
                'message'   => 'Hata'
            ], 500);

        }
    }
}
