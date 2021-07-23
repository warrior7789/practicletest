<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategories;
use Carbon\Carbon;

use Auth;
use DB;

class ApiController extends Controller
{
   public function signup(Request $request){

         $input = $request->all();
         if(!empty($input['email'])){
             $this->validate($request, [
                 'email' => 'required|email|unique:users',
                 'password' => 'required',
             ]);
         }else{
             $this->validate($request, [
                 //'email' => 'required_without:phone|email',
                 'phone' => 'required|numeric|unique:users',
                 'password' => 'required',
             ]);
         }

        $user = new User([
           'name' => $request->name,
           'email' => $request->email,
           'phone' => $request->phone,
           'password' => bcrypt($request->password)
        ]);

        $user->save();

        return response()->json([
           'message' => 'Successfully created user!'
        ], 201);
    }

    public function login(Request $request){

        $input = $request->all();
        if(!empty($input['email'])){
            $request->validate([
               'email' => 'required|string|email',
               'password' => 'required|string',
               'remember_me' => 'boolean'
            ]);
            $credentials = request(['email', 'password']);
        }else{
            $request->validate([
               'phone' => 'required',
               'password' => 'required|string',
               'remember_me' => 'boolean'
            ]);
            $credentials_phone = request(['phone', 'password']);
        }      
        
        if(!Auth::attempt($credentials))
           return response()->json([
               'message' => 'Unauthorized'
           ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
           $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
         return response()->json([
           'access_token' => $tokenResult->accessToken,
           'token_type' => 'Bearer',
           'expires_at' => Carbon::parse(
               $tokenResult->token->expires_at
           )->toDateTimeString()
         ]);
    }

    public function logout(Request $request){
       $request->user()->token()->revoke();
       return response()->json([
           'message' => 'Successfully logged out'
       ]);
    }

    public function user(Request $request){
       return response()->json($request->user());
    }

   public function categories(){
      $categorys = Category::get();
      return response()->json($categorys);
   }
   public function ProductByCategory($category){
      $product= Product::with(['categories', 'categories.category'])
         ->whereHas('categories', function ($query) use($category){
            $query->where('categories_id', $category);
         })->get();

      return response()->json($product);
   }
   public function searchproduct($query){
      $product= Product::with(['categories', 'categories.category'])->where('products.title', 'like', $query.'%')->get();
      return response()->json($product);

   }
   public function getproduct($product){
      $product= Product::with(['categories', 'categories.category','images'])->where('id',$product)->get();
      return response()->json($product);

   }
   
}


