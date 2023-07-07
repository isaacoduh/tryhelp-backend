<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $orders = $user->orders;

        return response()->json([
            'message' => 'Data Recieved Successfully',
            'data' => $orders
        ]);
    }

    public function getASingleOrder(Request $request, $id)
    {
        $data = [];
        
        $order = Order::where('id',$id)->with('details.product')->first();
        $data['id'] = $order->id;
        $data['customer_name'] = $order->name;
        $data['customer_phone'] = $order->customer_phone;
        $data['address'] = $order->address;
        $data['order_status'] = $order->order_status;
        $data['payment_type'] = $order->payment_type;
        $data['vat'] = $order->vat;
        $data['subtotal'] = $order->subtotal;
        $data['total'] = $order->total;
        $data['created_at'] = $order->total;
        $data['updated_at'] = $order->total;
        $data['user'] = $order->user;

        $details = [];

        foreach ($order['details'] as $item) {
            $detail = [];
            $detail['id'] = $item->id;
            $detail['quantity'] = $item->quantity;
            $detail['unit_price'] = $item->unit_price;
            $detail['subtotal'] = $item->subtotal;
            $detail['product_name'] = $item->product->name;
            array_push($details, $detail);
        }

        $data['details'] = $details;

        return response()->json([
            'message' => 'Data Retrieved!',
            'data' => $data
        ]);
    }

    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $data = [];
        $details = [];
        $data['user_id'] = $user->id;
        $data['customer_name'] = $request->firstName . " " . $request->lastName;
        $data['customer_phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['subtotal'] = number_format($request->subtotal,2);
        $data['vat'] =  number_format($request->tax,2);
        $data['total'] = number_format($request->total,2);
        $data['order_status'] = 'pending';
        $data['payment_type'] = $request->paymentType === 'cash' ? 'cash_on_delivery': 'card';

        // $data['cart'] = $request->cart;

        // create an order
        try {
            $order = Order::create($data);
            foreach ($request->cart as $item) {
                $orderDetail = [];
                $orderDetail['order_id'] = $order->id;
                $orderDetail['product_id'] = $item['id'];
                $orderDetail['quantity'] = $item['quantity'];
                $orderDetail['unit_price'] = $item['price'];
                $orderDetail['subtotal'] = $item['price'] * $item['quantity'];

                $createOrderDetails = OrderDetails::create($orderDetail);
                // array_push($details, $orderDetail);
            }           

        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json([
            'message' => 'Order Placed Successfully',
            'data' => $order
        ]);
    }
}
