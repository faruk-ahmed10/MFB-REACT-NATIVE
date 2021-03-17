<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();

        return view('pages.units')->with(['units' => $units]);
    }

    public function form($id = 0)
    {
        $editMode = (int)$id > 0;
        $data = $editMode ? Unit::where('id', '=', $id)->first() : null;

        return view('pages.Unit_form')->with([
            'editMode' => $editMode,
            'data' => $data,
        ]);
    }

    public function save(Request $request)
    {
        $id = (int)$request->input('id');

        if ($id > 0) {
            $Unit = Unit::find($id);
        } else {
            $Unit = new Unit();
        }


        $Unit->name = $request->input('unit_name');
        $Unit->save();

        $request->session()->flash('message', 'Saved successfully!');
        return redirect()->to('/units');
    }

    public function delete($id)
    {
        Unit::where('id', '=', $id)->delete();
        Session::flash('message', 'Deleted successfully!');
        return redirect()->back();
    }
}
