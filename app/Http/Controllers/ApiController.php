<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{


    public function assignRole(Request $request)
    {
        $input = $request->all();

        $role_id = DB::table('roles')->where(['name'=>$input['role']])->first();
        
        if(!empty($role_id)){
            $findassinmodal = DB::table('model_has_roles')->where(['model_id'=>$input['user_id']])->first();

            if(!empty($findassinmodal)){
                $findassinmodal = DB::table('model_has_roles')->where(['model_id'=>$input['user_id']])->update(['role_id'=>$role_id->id]);

            } else {

                $data_main = array("role_id"=>$role_id->id,"model_id"=>$input['user_id'],"model_type"=>"App\User");
                $findassinmodal = DB::table('model_has_roles')->insert($data_main);

            }

            return $this->sendResponse1('Role assign successfully',$request->path()); 

        } else {
            return $this->sendError($request->path(),'You enter wrong role');
        }
    }

    public function nearproductlist(Request $request,$user_id)
    {
        $user = User::find($user_id);
        $product = Product::get();

        $return_array = array();

        foreach($product as $value){
           
            if($this->distance($value->lat,$value->log,$user->lat,$user->log,"K") < 50){
                $return_array[] = $value; 
            }
        }


        return $this->sendResponse($return_array, 'Product list retrieved successfully',$request->path()); 


    }

    public function sendError($requestkey,$errorMessages)
    {
        $response = [
            'status' => 'FAILURE',
            'message' => $errorMessages,
            'requestKey'=>$requestkey,
        ];


        return response()->json($response, 200);
    }


    public function sendResponse($result, $message,$requestkey)
    {
        $response = [
            'status' => 'SUCCESS',
             'data'  => $result,
            'message' => $message,
            'requestKey'=>$requestkey,
        ];


        return response()->json($response, 200,[],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function sendResponse1($message,$requestkey)
    {
        $response = [
            'status' => 'SUCCESS',
            'message' => $message,
            'requestKey'=>$requestkey,
        ];


        return response()->json($response, 200,[],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {
          if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
          }
          else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
              return ($miles * 1.609344);
            } else if ($unit == "N") {
              return ($miles * 0.8684);
            } else {
              return $miles;
            }
          }
        }

}
