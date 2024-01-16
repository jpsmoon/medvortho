<?php

namespace App\Http\Controllers;
use App\Models\{TallyForm, TallyFormDataOption};

use Illuminate\Http\Request;

class TallyFormController extends Controller
{
    //
    function tallyForm(Request $request){
        //  echo "<pre>";
        //  print_r($request->all());exit;
        // Check if the request is a POST request (typical for webhooks) 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             if($request['data'] &&  $request['data']['fields'] && count($request['data']['fields']) > 0){
                foreach($request['data']['fields'] as $data){ 
                    // echo "<pre>";
                    // print_r($data);
                    // $valueArr = []; 
                    // if(is_array($data['value'])) {
                    //     $valueArr [] = $data['value'];
                    // }   
                    
                    $checkFrm = TallyForm::where('eventId', $request['eventId'])->where('fields_key', $data['key'])->first();
                    if($checkFrm){
                        $checkFrm->eventId            = $request['eventId'];
                        $checkFrm->eventType          = $request['eventType'];
                        $checkFrm->responseId         = $request['data']['responseId'];
                        $checkFrm->submissionId       = $request['data']['submissionId'];
                        $checkFrm->respondentId       = $request['data']['respondentId'];
                        $checkFrm->formId             = $request['data']['formId'];
                        $checkFrm->formName           = $request['data']['formName'];
                        $checkFrm->fields_key         = $data['key'];
                        $checkFrm->fields_label       = ($data['label']) ? $data['label'] : null;
                        $checkFrm->fields_type        = $data['type'];
                        $checkFrm->fields_value       = (is_array($data['value'])) ? implode(',',$data['value']) : $data['value'];
                        $checkFrm->update();
                         $this->addFormOptionData($checkFrm->id, $data);
                    }
                    else{
                        $newFrm = new TallyForm ();
                        $newFrm->createdAt          = $request['createdAt'];
                        $newFrm->eventId            = $request['eventId'];
                        $newFrm->eventType          = $request['eventType'];
                        $newFrm->responseId         = $request['data']['responseId'];
                        $newFrm->submissionId       = $request['data']['submissionId'];
                        $newFrm->respondentId       = $request['data']['respondentId'];
                        $newFrm->formId             = $request['data']['formId'];
                        $newFrm->formName           = $request['data']['formName'];
                        $newFrm->fields_key         = $data['key'];
                        $newFrm->fields_label       = ($data['label']) ? $data['label'] : null;
                        $newFrm->fields_type        = $data['type'];
                        $newFrm->fields_value       = (is_array($data['value'])) ? implode(',',$data['value']) : $data['value']; 
                        //$newFrm->fields_value       = $data['value']; 
                        $newFrm->save();
                        $this->addFormOptionData($newFrm->id, $data);   
                    } 
                } 
            } 
            http_response_code(200);
            echo "Webhook received and processed successfully!";
        } else {
            // If the request is not a POST request, handle it accordingly
            http_response_code(405); // Method Not Allowed
            echo "Only POST requests are allowed for this endpoint.";
        }
    }
    
    function addFormOptionData($formId, $data){
        if (array_key_exists("options",$data)){
            if($data['options'] && count($data['options']) > 0){
                $checkOption = TallyFormDataOption::where('tally_form_id' , $formId)->first();
                 if($checkOption){ 
                     $deleteOption = TallyFormDataOption::where('tally_form_id' , $formId)->delete();
                    foreach($data['options'] as $op){
                        // echo "<pre>";
                        // print_r($op);
                        $selectedTextId = null; $selectedText = null;
                        if(is_array($data['value'])){
                            foreach($data['value'] as $vall){
                                if($vall == $op['id']){
                                    $selectedTextId = $op['id'];
                                    $selectedText = $op['text'];
                                }
                            }
                        }  
                        $tallyOption = new TallyFormDataOption();
                        $tallyOption->tally_form_id =$formId;
                        $tallyOption->option_id = $op['id'];
                        $tallyOption->option_text = $op['text'];
                        $tallyOption->option_selected_id = $selectedTextId;
                        $tallyOption->option_selected_text = $selectedText;
                        $tallyOption->save();
                    } 
                }
                else{
                   foreach($data['options'] as $op){
                        // echo "<pre>";
                        // print_r($op);
                        $selectedTextId = null; $selectedText = null;
                        if(is_array($data['value'])){
                            foreach($data['value'] as $vall){
                                if($vall == $op['id']){
                                    $selectedTextId = $op['id'];
                                    $selectedText = $op['text'];
                                }
                            }
                        }  
                        $tallyOption = new TallyFormDataOption();
                        $tallyOption->tally_form_id =$formId;
                        $tallyOption->option_id = $op['id'];
                        $tallyOption->option_text = $op['text'];
                        $tallyOption->option_selected_id = $selectedTextId;
                        $tallyOption->option_selected_text = $selectedText;
                        $tallyOption->save();
                    }  
                }
            }
        }
    }
}
