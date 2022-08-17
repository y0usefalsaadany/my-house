<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\HouseImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HouseController extends Controller
{
    private $house,$image;

    public function __construct() {
        // $this->middleware('auth:admin-api');
        $this->house = new House();
        $this->image = new HouseImage();
    }

    function store(Request $request){
        $request->validate([
            'title'=>'required|min:10|max:255|string',
            'price'=>'required|min:3',
            'description'=>'required|string|min:10:max:2000',
            'image'=>'required|image|mimes:jpg,png'
        ]);
        try{
            DB::beginTransaction();
            $this->house->title = $request['title'];
            $this->house->price = $request['price'];
            $this->house->description = $request['description'];
            $this->house->admin_id = 1 ; //auth()->guard('admin-api')->user()->id;
            $this->house->save();
            $this->image->image = $request['description'];
            $name = 'house' . time() . '.' . $this->image->image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $this->image->image->move($destinationPath, $name);
            $this->image->house_id = $this->house->id;
            $this->image->save();
            return response()->json($this->house);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }catch(\Error $e){
            DB::rollback();
            return $e->getMessage();
        }
    }

    function showAll(){
        return response()->json($this->house->all());
    }

    function show($id){
        return response()->json($this->house->findOrFail($id));
    }

    function update(Request $request,$id){
        $request->validate([
            'title'=>'required|min:10|max:255|string',
            'price'=>'required|min:3',
            'description'=>'required|string|min:10:max:2000',
            'image'=>'required|image|mimes:jpg,png'
        ]);
        try{
            $this->house->find($id);
            DB::beginTransaction();
            $this->house->title = $request['title'];
            $this->house->price = $request['price'];
            $this->house->description = $request['description'];
            $this->house->admin_id = 1 ; //auth()->guard('admin-api')->user()->id;
            $this->house->save();
            $this->image->image = $request['description'];
            $name = 'house' . time() . '.' . $this->image->image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $this->image->image->move($destinationPath, $name);
            $this->image->house_id = $this->house->id;
            $this->image->save();
            return response()->json($this->house);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }catch(\Error $e){
            DB::rollback();
            return $e->getMessage();
        }

        return response()->json($this->house);
    }

    function destroy($id){
        $this->house->findOrFail($id)->delete();
        // $this->house->delete();
        return response()->json('deleted');
    }
}
