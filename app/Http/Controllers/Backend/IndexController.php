<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use DB;
use Hash;
use Session;
use Illuminate\Support\Facades\File; 

class IndexController extends Controller
{
    public function index()
    {   


        return view('backend.adminHome');
    }
        

    public function userlist()
    {   

        $Users = User::paginate(10);
        return view('backend.userlist', compact('Users'));
    }


    public function upload(Request $request)
        {
            if($request->hasFile('upload')) {
                $originName = $request->file('upload')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('upload')->getClientOriginalExtension();
                $fileName = $fileName.'_'.time().'.'.$extension;
                $request->file('upload')->move(public_path('images'), $fileName);
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $url = asset('images/'.$fileName); 
                $msg = 'Image successfully uploaded'; 
                $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                   
                @header('Content-type: text/html; charset=utf-8'); 
                echo $response;
            }
        }

}