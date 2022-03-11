<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Redis;

class ApiController extends Controller
{
    /**
     * CREATE THE METHOD getItem RETURNING THE REQUESTED ITEM
     */
    /**
     * Show the item for the given id.
     *
     * @param  int  $id
     * @return array|false|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function getItem($id)
    {
        $cachedItem = Redis::get('item_' . $id);

        if(isset($cachedItem)) {
            $item = json_decode($cachedItem, FALSE);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from redis',
                'data' => $item,
            ]);
        }else {
            $item = Item::find($id);
            Redis::set('item_' . $id, $item);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from database',
                'data' => $item,
            ]);
        }
    }

    /**
     * CREATE THE METHOD calculatePrices RETURNING AN ARRAY WITH THE FINAL PRICE AND THE COSTS OF THE TAXES (21%)
     */
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculatePrices($id)
    {
        $cachedItem = Redis::get('item_' . $id);

        if(isset($cachedItem)) {
            $item = json_decode($cachedItem, FALSE);

            $vatDecimal = (float) (21 / 100); //0,21
            $vat = round(($item->price * $vatDecimal), 2);// 525
            $finalPrice = number_format($item->price + $vat, 2, ',', '.');

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from redis',
                'data' => [
                    'finalPrice' => $finalPrice,
                    'taxes' => $vat,
                ]
            ]);
        }else {
            $item = Item::find($id);
            Redis::set('item_' . $id, $item);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from database',
                'data' => $item,
            ]);
        }
    }

}
