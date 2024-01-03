<?php
namespace App\Traits;
use App\Models\Status;

trait StatusTrait
{
    public function storeStatus($request, $id = false) {
        if(!$id){ //Add here
            $statuses = new Status();
            $statuses->status_name = $request->status_name;
            $statuses->display_order = $request->display_order;
            $statuses->description = $request->description;
            $statuses->status_type = $request->status_type;
            $statuses->slug_name = $request->status_aliase;
            $statuses->save();
            return $statuses;
        }else{ //Update here

            $updateArr = array(
                'status_name' => $request->status_name,
                'display_order'=> $request->display_order,
                'description' => $request->description,
                'status_type' => $request->status_type
            );        
            return Status::where("id", $id)->update($updateArr);
        }
    }

}