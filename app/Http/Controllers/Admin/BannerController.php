<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        // dd($banners);
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        $data = new Banner();
        $data->title =$request->title;
        $data->description =$request->description;
        $data->banner_link =$request->banner_link;
        if ($request->button_text != '' && $request->button_text != null) {
            $data->button_text = $request->button_text;
        } else {
            $data->button_text = 'BUY NOW';
        }

        if($request->hasFile('image'))
        {
            $destination_path = 'public/banner';
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path, $imageName);
            $data->image = $imageName;
        }
        if($data->save()){
            return redirect()->back()->with('success', 'Banner has been created');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        $data = Banner::find($banner->id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->banner_link = $request->banner_link;
        $data->button_text = $request->button_text;

        //code for remove old file
        // if($data->image != ''  && $data->image != null){
        //     $destination_path = 'public/banner';
        //     $file_old = $path.$data->image;
        //     unlink($file_old);
        // }


        if($request->hasFile('image'))
        {
            $destination_path = 'public/banner';
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path, $imageName);
            $data->image = $imageName;
        }
        if($data->save()){
            return redirect()->back()->with('success', 'Banner has been updated');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banners = Banner::find($banner->id);
        $banners->delete();
        return redirect()->back()->with('success','Banner has been deleted');

    }

    public function changeBannerStatus(Request $request)
    {
        $banners = Banner::find($request->user_id);
        $banners->status = $request->status;
        $banners->save();

        return response()->json(['success'=>'Banner status changed successfully.']);
    }
}
