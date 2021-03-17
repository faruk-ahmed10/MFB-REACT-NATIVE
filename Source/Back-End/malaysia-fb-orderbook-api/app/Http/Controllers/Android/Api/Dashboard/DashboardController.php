<?php

namespace App\Http\Controllers\Android\Api\Dashboard;

use App\Helper\CommonHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\SalesTargetAssignment;
use Carbon\Carbon;
use \Exception;

class DashboardController extends Controller
{
    public function getTodaySales() {
        try {
            $total_sales_amount = Order::whereBetween('created_at', [date('Y-m-d', time()) . " 00:00:00", date('Y-m-d', time()) ." 23:59:59"])->sum('total_price');
            return CommonHelper::Response(true, 'Todays total sales amount fetched successfully!', null, $total_sales_amount);
        } catch (Exception $e) {
            return CommonHelper::Response(false, $e->getMessage(), 'UNKNOWN', null);
        }
    }

    public function getSalesTarget() {
        try {
            $sales_target_amount = 0;
            $sales_target = SalesTargetAssignment::where('user_id', '=', auth()->user()->id)->where('target_month', '=', date('M'))->where('target_year', '=', date('Y'));

            if ($sales_target->exists()) {
                $sales_target = $sales_target->first();
                $sales_target_amount = $sales_target->amount;
            }

            return CommonHelper::Response(true, 'Target sales info fetched successfully!', null, $sales_target_amount);
        } catch (Exception $e) {
            return CommonHelper::Response(false, $e->getMessage(), 'UNKNOWN', null);
        }
    }
}
