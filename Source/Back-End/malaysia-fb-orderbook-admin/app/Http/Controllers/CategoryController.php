<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('pages.categories')->with(['categories' => $categories]);
    }

    public function form($id = 0)
    {
        $editMode = (int)$id > 0;
        $data = $editMode ? Category::where('id', '=', $id)->first() : null;

        return view('pages.category_form')->with([
            'editMode' => $editMode,
            'data' => $data,
        ]);
    }

    public function save(Request $request)
    {
        $id = (int)$request->input('id');

        if ($id > 0) {
            $Category = Category::find($id);
        } else {
            $Category = new Category();
        }


        $Category->name = $request->input('category_name');
        $Category->save();

        $request->session()->flash('message', 'Saved successfully!');
        return redirect()->to('/categories');
    }

    public function delete($id)
    {
        Category::where('id', '=', $id)->delete();
        Session::flash('message', 'Deleted successfully!');
        return redirect()->back();
    }
}
