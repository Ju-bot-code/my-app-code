<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class testApi extends Controller
{
    public function getData()
    {   
        return 'you are now logged in'; 

        // return [
        //     'name'=>'judith',
        //     'emai'=>'judithlobo44@gmail.com',
        //     'place'=>'delhi',
        //     ];

           
    }

    public function device()
    {

        $data=Device::all();
       

        return  $data;
    }

    public function deviceId($id=null)
    {

        $data=Device::find($id);
         return  $data;
    }

    public function deviceOption($id=null)
    {

        //optional id
        return  $id ? Device::find($id) : Device::all();
   }

   public function addDevice(Request $r)
   {

    // return 'hi';
    // // return $r;
    $data=new Device;
    $data->name=$r->name;
    $data->price=$r->price;
    $result=$data->save();

    if($result)
    {
        return['create status'=>'successful'];

    }else{

        return['create status'=>'unsuccessful']; 
    }

   }

   public function updateDevice(Request $r)
   {
       $data=Device::where('id',$r->id)->first();
    if($data ==null || $data == '')
    {
        return 'record not found';
    }
    $data->name=$r->name;
    $data->price=$r->price;
    $data->save();

    if($data)
    {
        return ['update status'=>'successful'];
    }else{
        return['update status'=>'unsuccessful'];
    }
    //  return Device::where('id',$r->id)->first();  
   }

   public function searchDevice($name)
   {
       $data=Device::where('name','like','%'.$name. '%')->get();
       if($data == null)
       {
           return 'Sorry, No match found';
       }
       return $data;
   }

   public function deleteDevice($id)
   {    
        $data=Device::where('id',$id)->get();

        if($data == null)
        {
            return 'No does not exist';
        }
        $data=Device::where('id',$id)->delete();

        
        // $data->delete();

        return 'Record has been deleted successfully';

   }


   public function testDevice(Request $req)
   {    
        $rules=array(
            'name'=>'required|min:2|max:5',
            'price'=>'required|min:2|max:6'
        );
        $validator=Validator::make($req->all(),$rules);
        if($validator->fails())
        {
            return $validator->errors();
        }
        else
        {
           $device=new Device;
           $device->name=$req->name;
           $device->price=$req->price;
           $result=$device->save();

           if($result)
           {
               return 'record has been saved successfully';
           }
           else{

            return 'operation was unsuccessful';

           }

        }
      
   }

   public function upload(Request $re)
   {   
    //    return $re; 

       $result=$re->file('file')->store('apiDocs');
        return ['result'=>$result];

       
   }
}
