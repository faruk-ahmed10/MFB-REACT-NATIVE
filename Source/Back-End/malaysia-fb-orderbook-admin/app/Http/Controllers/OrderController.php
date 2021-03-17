<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->with('user')->get();

        return view('pages.orders')->with(['orders' => $orders]);
    }

    public function view($id = 0)
    {
        $statusList = ['PENDING', 'APPROVED', 'REJECTED', 'COMPLETED'];
        $data = Order::where('id', '=', $id)->with('order_details')->first();

        return view('pages.order_view')->with([
            'data' => $data,
            'statusList' => $statusList,
        ]);
    }

    public function form($id = 0)
    {
        $editMode = (int)$id > 0;
        $data = $editMode ? Order::where('id', '=', $id)->first() : null;

        return view('pages.order_form')->with([
            'editMode' => $editMode,
            'data' => $data,
        ]);
    }

    public function save(Request $request)
    {
        $id = (int)$request->input('id');

        if ($id > 0) {
            $Order = Order::find($id);
        } else {
            $Order = new Order();
        }

        if($request->input('status')) {
            $Order->status = $request->input('status');
        }

        $Order->save();

        $request->session()->flash('message', 'Saved successfully!');
        return redirect()->to('/orders');
    }

    public function delete($id)
    {
        Order::where('id', '=', $id)->delete();
        OrderDetail::where('order_id', '=', $id)->delete();
        Session::flash('message', 'Deleted successfully!');
        return redirect()->back();
    }
}
