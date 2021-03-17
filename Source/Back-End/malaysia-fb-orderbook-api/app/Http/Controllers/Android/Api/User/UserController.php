<?php

namespace App\Http\Controllers\Android\Api\User;

use App\Helper\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\SalesTargetAssignment;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getSessionUser()
    {
        try {




            $user = auth()->user();

            $sales_target_data = [
                'month' => date('M'),
                'year' => date('Y'),
                'amount' => 0.0,
            ];


            $sales_target = SalesTargetAssignment::where('user_id', '=', $user->id)->where('target_month', '=', date('M'))->where('target_year', '=', date('Y'));

            if ($sales_target->exists()) {
                $sales_target = $sales_target->first();
                $sales_target_data['amount'] = $sales_target->amount;
            }

            $user->current_sales_target = $sales_target_data;

            return CommonHelper::Response(true, "User profile fetched successfully!", null, $user);
        } catch (Exception $e) {
            return CommonHelper::Response(false, $e->getMessage(), 'UNKNOWN', null);
        }
    }
}
