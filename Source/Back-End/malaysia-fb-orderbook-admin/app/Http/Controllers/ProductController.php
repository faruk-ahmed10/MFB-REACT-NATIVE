<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();

        return view('pages.products')->with(['products' => $products]);
    }

    public function form($id = 0)
    {
        $editMode = (int)$id > 0;
        $categories = Category::all();
        $data = $editMode ? Product::where('id', '=', $id)->first() : null;

        return view('pages.product_form')->with([
            'editMode' => $editMode,
            'categories' => $categories,
            'data' => $data,
        ]);
    }

    public function save(Request $request)
    {
        $id = (int)$request->input('id');

        if ($id > 0) {
            $Product = Product::find($id);
        } else {
            $Product = new Product();
        }

        //Upload the profile photo
        $UploadsDir = "./uploads/products/";
        $NewFileName = null;
        if (isset($_FILES["product_image"]) && $_FILES["product_image"]["name"] != null) {
            $uploadOk = 1;
            $target_dir = $UploadsDir;
            $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["product_image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                return "The selected file is not an image!";
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $uploadOk = 0;
                return 'Sorry, only JPG, JPEG & PNG files are allowed!';
            } else {
                $temp = explode(".", $_FILES["product_image"]["name"]);
                $NewFileName = 'MFB__' . strtoupper(md5(time())) . '__' . round(microtime(true)) . '.' . end($temp);
                if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_dir . $NewFileName)) {
                    //do anything
                } else {
                    $NewFileName = null;
                    return 'The profile photo could not be uploaded!';
                }
            }
        }
        if ($NewFileName != null) {
            if ($id > 0 && $Product->image != null) {
                @unlink($UploadsDir . '/' . $Product->image);
            }
            //update the new logo
            $Product->image = $NewFileName;
        }


        $Product->category_id = $request->input('product_category');
        $Product->name = $request->input('product_name');
        $Product->description = $request->input('product_description');
        $Product->price = $request->input('product_price');
        $Product->save();

        $request->session()->flash('message', 'Saved successfully!');
        return redirect()->to('/products');
    }

    public function delete($id)
    {
        $Product = Product::where('id', '=', $id);
        $image = $Product->first()->image;

        if ($image != null) {
            @unlink("./uploads/products/" . $image);
        }

        $Product->delete();

        Session::flash('message', 'Deleted successfully!');
        return redirect()->back();
    }
}
