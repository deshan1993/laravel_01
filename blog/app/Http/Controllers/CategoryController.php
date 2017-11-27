<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;
use Validator;

class CategoryController extends Controller
{
    //insert categories
    public function insertCategory(Request $request){
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'description' => 'required'
      ]);
      if($validator->fails()){
        return response()->json(['error'=>$request->errors()], 401);
      }
      else{
        $table = new Category();
        $table->name = $request->input('name');
        $table->description = $request->input('description');
        $table->save();
        if($table->save()){
          return response()->json("New category was inserted successfully");
        }
        else{
          return response()->json("There is an error");
        }
      }
    }

    //view Category
    public function viewCategory(){
      $table = new Category();
      $data = DB::table('categories')->pluck('description','name');
      return response()->json($data);
    }

    //update Category
    public function updateCategory(Request $request){
      $validator = Validator::make($request->all(), [
        'id' => 'required',
        'name' => 'required',
        'description' => 'required'
      ]);

      if($validator->fails()){
        return response()->json(['error'=>$validator->errors()], 401);
      }
      else{
        $id = $request->input('id');
        $update = [
          'name' => $request->input('name'),
          'description' => $request->input('description')
        ];
        $data = DB::table('categories')->whereIn('id', [$id])->update($update);
        if($data){
          return response()->json("Update successfully");
        }
        else{
          return response()->json("There is an error");
        }
      }
    }

    //delete Category
    public function deleteCategory(Request $request){
      $validator = Validator::make($request->all(), [
        'id' => 'required'
      ]);

    if($validator->fails()){
      return response()->json(['error'=>$request->errors()], 401);
    }
    else{
      $data = DB::table('categories')->where('id', [$request->input('id')])->delete();
      if($data){
        return response()->json("Updated successfully");
      }
      else{
        return response()->json("There is an error");
      }
    }
  }
}
