<?php

namespace App\Http\Controllers\Android\Api\Order;

use App\Helper\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use \Exception;

class OrderController extends Controller
{
    public function getOrders()
    {
        try {
            $orders = Order::orderBy('id', 'desc')->get();

            foreach($orders as $order) {
                $order->date_time = date('h:ia d-m-Y', strtotime($order->created_at));
            }

            return CommonHelper::Response(true, 'Order list fetched successfully!', null, $orders);
        } catch (Exception $e) {
            return CommonHelper::Response(false, $e->getMessage(), 'UNKNOWN', null);
        }
    }

    public function saveOrder(Request $request)
    {
        try {
            $OrderId = (int)$request->input('OrderId');
            $CustomerName = $request->input('CustomerName');
            $CustomerPhone = $request->input('CustomerPhone');
            $CustomerAddress = $request->input('CustomerAddress');
            $Comment = $request->input('Comment');
            $InvoiceTotalPrice = $request->input('InvoiceTotalPrice');
            $CartItemList = $request->input('CartItemList');

            if ($OrderId !== 0) {
                $Order = Order::where('id', '=', $OrderId);
            } else {
                $Order = new Order();
            }

            $Order->customer_name = $CustomerName;
            $Order->customer_phone = $CustomerPhone;
            $Order->customer_address = $CustomerAddress;
            $Order->comment = $Comment;
            $Order->total_price = $InvoiceTotalPrice;
            $Order->created_by = auth()->user()->id;
            $Order->created_at = date('Y-m-d H:i:s', time());
            $Order->updated_at = date('Y-m-d H:i:s', time());

            $Order->save();

            if ($OrderId === 0) {
                $OrderId = $Order->id;
            }

            foreach ($CartItemList as $CartItem) {
                $_orderDetailData = [
                    'order_id' => $OrderId,
                    'product_id' => $CartItem['product_id'],
                    'unit_price' => $CartItem['unit_price'],
                    'qty' => $CartItem['quantity'],
                    'total_amount' => $CartItem['total_price'],
                ];

                $OrderDetail = OrderDetail::where('order_id', '=', $OrderId);
                if ($OrderDetail->exists()) {
                    $_orderDetailData['updated_at'] = date('Y-m-d h:i:s', time());
                    $OrderDetail->update($_orderDetailData);
                } else {
                    $_orderDetailData['created_at'] = date('Y-m-d h:i:s', time());
                    OrderDetail::Insert($_orderDetailData);
                }
            }

            return CommonHelper::Response(true, 'Order saved successfully!', null, null);
        } catch (Exception $e) {
            return CommonHelper::Response(false, $e->getMessage(), 'UNKNOWN', null);
        }
    }
}
