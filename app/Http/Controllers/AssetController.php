<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Asset;
use Illuminate\Support\Str;
use File;


class AssetController extends Controller
{

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        

        $request->validate([
            'name'      => 'required',
            'file'     => 'required|image|mimes:jpeg,png,jpg,gif,svg,pdf,xlx,csv|max:5048',

        ]);

        $data = new Asset();

        $name = str_replace(' ', '_', $request->name);
        $image = $request->file('file');
        if ($image) {

            $randomName = Str::random(10);
            $destinationPath = 'documents/';
            $profileImage =  $name.'_'.date('YmdHis'). "$randomName" . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data->file = $profileImage;

            $data->doc_type = $image->getClientOriginalExtension();

        }
         

        $data->status = 1;
        $data->name = $request->name;
        $success = $data->save();

    

        return redirect()->route('home')->with('success','Asset created successfully.');

    }


    public function edit($id)
    {   
        $assets = Asset::findOrFail($id);
        return view('edit',compact('assets'));
    }


    public function update(Request $request, $id)
    {

        //dd($request->all());

        $request->validate([
            'name'      => 'required',
            'file'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        $data = Asset::findOrFail($id);

        $name = str_replace(' ', '_', $request->name);

        $image = $request->file('file');

        //dd($image);

        if ($image) {

            //dd($image);
            
            File::delete(public_path('documents/'.$data->file));
            $randomName = Str::random(10);
            $destinationPath = 'documents/';
            $profileImage =  $name.'_'.date('YmdHis'). "$randomName" . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data->file = $profileImage;

            $data->doc_type = $image->getClientOriginalExtension();
        }
        
        $data->name = $request->name;

        $data->save();

        return redirect()->route('home')->with('success','Asset updated successfully');

    }


    public function change_status($id){

      
        $data = Asset::findOrFail($id);

        if($data->status==1){
            $data->status= null;

            File::move(public_path('documents/'.$data->file), public_path('inactive/'.$data->file));
        }else{
            $data->status= 1;

            // $destinationPath = 'documents/' ;
            // $moveable = $data->file ;
            // File::move($destinationPath, $moveable);

            File::move(public_path('inactive/'.$data->file), public_path('documents/'.$data->file));
        }

        $data->save(); 

        return redirect()->route('home')->with('success','Status change successfully');
    }



    public function destroy($id)
    {
        $data = Asset::findOrFail($id);


        File::delete(public_path('documents/'.$data->file));

        $data->delete();
        
        return redirect()->route('home')->with('success','Asset deleted successfully');

    }
}
