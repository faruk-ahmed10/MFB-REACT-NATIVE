<?php

namespace App\Http\Controllers;

use App\Models\SalesTargetAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('pages.users')->with(['users' => $users]);
    }

    public function form($id = 0)
    {
        $editMode = (int)$id > 0;
        $user_types = ['ADMIN', 'SR', 'GM', 'AGM', 'DEALER', 'DIPO', 'RM'];
        $statusList = ['ACTIVE', 'INACTIVE', 'BANNED'];
        $data = $editMode ? User::where('id', '=', $id)->first() : null;

        return view('pages.user_form')->with([
            'editMode' => $editMode,
            'user_types' => $user_types,
            'statusList' => $statusList,
            'data' => $data,
        ]);
    }

    public function view($id = 0)
    {
        $statusList = ['PENDING', 'APPROVED', 'REJECTED', 'COMPLETED'];
        $data = User::where('id', '=', $id)->with('sales_target_assignments')->with('orders')->first();

        return view('pages.user_view')->with([
            'data' => $data,
            'statusList' => $statusList,
        ]);
    }

    public function save(Request $request)
    {
        $id = (int)$request->input('id');

        if ($id > 0) {
            $User = User::find($id);
        } else {
            $User = new User();
        }


        $User->type = $request->input('user_type');
        $User->status = $request->input('user_status');
        $User->name = $request->input('user_name');
        $User->email = $request->input('user_email');
        $User->phone = $request->input('user_phone');
        if ($User->password !== '') {
            $User->password = Hash::make($request->input('user_password'));
        }
        $User->save();

        $request->session()->flash('message', 'Saved successfully!');
        return redirect()->to('/users');
    }

    public function assignSalesTarget(Request $request)
    {
        $data = [
            'user_id' => $request->input('user_id'),
            'target_month' => date('M'),
            'target_year' => date('Y'),
            'amount' => $request->input('amount'),
        ];

        $sta = SalesTargetAssignment::where('user_id', '=', $request->input('user_id'))->where('target_month', '=', date('M'))->where('target_year', '=', date('Y'));
        if ($sta->exists()) {
            $sta->update($data);
        } else {
            SalesTargetAssignment::create($data);
        }

        return redirect()->back();
    }

    public function delete($id)
    {
        User::where('id', '=', $id)->delete();
        Session::flash('message', 'Deleted successfully!');
        return redirect()->back();
    }
}
