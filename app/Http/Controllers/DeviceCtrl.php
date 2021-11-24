<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Validator;

class DeviceCtrl extends Controller
{
    function list($id=null)
    {
        return $id?Device::find($id):Device::all();
    }

    function add(Request $request)
    {
        $rules = array(
            "number_id" => "required|min:2|max:4"
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $device = new Device;
            $device->name = $request->name;
            $device->number_id = $request->number_id;
            $result = $device->save();

            if ($result) {
                return ["Result" => "Data has been saved"];
            } else {
                return ["Result" => "Operation Failed"];
            }
        }
    }

    function update(Request $request)
    {
        $device = Device::find($request->id);
        $device->name = $request->name;
        $device->number_id = $request->number_id;
        $result = $device->save();

        if ($result) {
            return ["Result" => "Data has been Update"];
        } else {
            return ["Result" => "Data operation has been Failed"];
        }
    }

    function delete($id)
    {
        $device = Device::find($id);
        $result = $device->delete();

        if ($result) {
            return ["Result" => "Data has been Delete". $id];
        } else {
            return ["Result" => "Data operation has been failed"];
        }
    }

    function search($name)
    {
        return Device::where('name', "like", "%".$name."%")->get();
    }
}
