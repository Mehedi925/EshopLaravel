<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Brand;
use Illuminate\Support\Str;
use DB;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Brand()
    {
        $brand= Brand::all();
        return view('admin.brand.brand',compact('brand'));

    }
    public function StoreBrand(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
            'brand_logo' => 'mimes:jpeg,jpg,png,gif,PNG|required|max:10000',
        ]);
        $data = array();
        $data['brand_name']=$request->brand_name;
        $image = $request->file('brand_logo');


        if ($image)
        {
            $image_name = Str::random(20);
            $ext= strtolower($image->getClientOriginalExtension());
            $image_full_name= $image_name.'.'.$ext;
            $upload_path='public/media/brand/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['brand_logo']=$image_url;
//            unlink($request->old_photo);
               $brand= DB::table('brands')->insert($data);
            $notification = array(
                'messege'=>'Successfully Brand Inserted',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
        else
        {
//            $data['image']=$request->old_photo;
            $brand= DB::table('brands')->insert($data);
            $notification = array(
                'messege'=>'Done',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        }

    }
}
