<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    public function index()
    {
        return view('category.index');
    }

    public function readData()
    {
        $cats = Category::get();
        return view('category.inc.list',['categories' => $cats]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $cat = new Category();
        $cat->name = $request->name;
        $cat->image = $this->UploadImage($request);
        if($cat->save()){
            return response($cat);
        }

    }

    public function show(Request $request)
    {
        //
    }

    public function editData(Request $request)
    {
        $cat = Category::findOrFail($request->cat_id);
        return response($cat);
    }

    public function updatetData(Request $request)
    {
        $cat = Category::findOrFail($request->cat_id);
        $cat->name = $request->name;
        $cat->image = $this->UpdateImage($request);
        if($cat->save()){
            return response($cat);
        }
    }

    public function deleteData(Request $request)
    {
        $cat = Category::findOrFail($request->category_id);
        File::delete(public_path('upload/categories/'.$cat->image));
        if($cat->delete()){
            return response($cat);
        }
    }

    protected function UploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
			$image = $request->file('image');
			$fileExtension = $image->getClientOriginalExtension();
            $image_name = Str::slug($request->name) . '-' . rand() . '-' . time() . '.' . $fileExtension;
            //the method public_path use to connected location path on Public folder on your project folder.
			$destination = public_path('upload/categories/');
			// condition make directory
			if (!is_dir($destination)) {
				mkdir(($destination), 0777, true);
			}
			$image->move($destination, $image_name);
		} else {
			$image_name = null;
        }
        return $image_name;
    }

    protected function UpdateImage(Request $request)
    {
        $old_image = $request->old_image;
        if ($request->hasfile('image')) {
            $old_image_path = public_path('upload/categories/' . $old_image);
            if(file_exists($old_image_path)){
               unlink($old_image_path);
            }
			$image = $request->file('image');
			$fileExtension = $image->getClientOriginalExtension();
			$image_name = Str::slug($request->name) . '-' . rand() . '-' . time() . '.' . $fileExtension;
			$destination = public_path('upload/categories/');
			if (!is_dir($destination)) {
				mkdir(($destination), 0777, true);
			}
			$image->move($destination, $image_name);
		} else {
			$image_name = $old_image;
        }
        return $image_name;
    }

}
