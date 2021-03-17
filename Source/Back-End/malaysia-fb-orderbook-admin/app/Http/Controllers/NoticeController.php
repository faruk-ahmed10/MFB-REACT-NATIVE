<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::orderBy('id', 'desc')->get();

        return view('pages.notices')->with(['notices' => $notices]);
    }

    public function form($id = 0)
    {
        $editMode = (int)$id > 0;
        $data = $editMode ? Notice::where('id', '=', $id)->first() : null;

        return view('pages.notice_form')->with([
            'editMode' => $editMode,
            'data' => $data,
        ]);
    }

    public function save(Request $request)
    {
        $id = (int)$request->input('id');

        if ($id > 0) {
            $Notice = Notice::find($id);
        } else {
            $Notice = new Notice();
        }


        $Notice->text = $request->input('notice_text');
        $Notice->save();

        $request->session()->flash('message', 'Saved successfully!');
        return redirect()->to('/notices');
    }

    public function delete($id)
    {
        Notice::where('id', '=', $id)->delete();
        Session::flash('message', 'Deleted successfully!');
        return redirect()->back();
    }
}
