<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 
use DB;

use App\Models\{BillModifier, ProviderBillingTemplateServiceItem, ProviderBillingTemplate, AllDocument,ReportType, City,State, BillReferingOrderProvider,BillingProvider, Taxonomy_code, User,BillPlaceService, 
    PlaceOfServiceCode,PlaceOfServices, MasterPlaceOfService, RequestingPhysician,MasterSpecility, PractceLocation, PracticeContact, WriteOffReason};

class BillingCustomSettingController extends Controller
{
    //
    
     public function addCustomSetting(Request $request)
    {
        
        // $practicecontacts = [];
        $providerId = $request->providerId;
        $patient = [];  $injury = [];
        $reportType = ReportType::orderBy('id', 'desc')->get();
         return view('billingprocess/billingCustomSetting.create',compact( 'providerId','reportType','patient','injury'));
    }
    
     public function viewCustomSetting(Request $request)
    {
        $bRenderings=[];
        $providerId = $request->providerId;
        $documents = AllDocument::where('provider_id',$providerId)->get();
        return view('billingprocess/billingCustomSetting.index',compact('providerId','documents'));
    } 
    
    public function addSecondReviewReasons(Request $request)
    {
        $providerId = $request->providerId;
        $reasons = WriteOffReason::where('provider_id', $providerId)->where('type', 2)->get();
        $id= null;
        return view('billingprocess/billingCustomSetting/secondReviewReason.index',compact(['providerId','reasons','id']));
    }
    
    public function addBox19Reasons(Request $request)
    {
        $providerId = $request->providerId;
        $reasons = WriteOffReason::where('provider_id', $providerId)->where('type', 3)->get();
        $id= null;
        return view('billingprocess/billingCustomSetting/box19Reasons.index',compact(['providerId','reasons','id']));
    }
    public function saveDocuments(Request $request){
        try {
            $this->storeInjuryDocuments($request);
            if($request->reasonId){
                $message = 'Document created successfully';
            }
            else{
                $message = 'Document updated successfully';
            }
            $toastr_title = trans('messages.toastr_success');
            Toastr::success($message, '', ["positionClass" => "toast-top-center"]);
            return redirect('/view-document-billing-custom-setting/'.$request->providerId );
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $toastr_title = trans('messages.toastr_error');
            Toastr::error($message, '', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
    }
    
    public function storeSecondReviewReason(Request $request){
        try {
            $this->saveSecondReviewReason($request);
            if($request->reasonId){
                $message = 'Second Review Reason added successfully';
            }
            else{
                $message = 'Second Review Reason updated successfully';
            }
            
            $toastr_title = trans('messages.toastr_success');
            Toastr::success($message, '', ["positionClass" => "toast-top-center"]);
            return redirect('/add-second-review-reason/'.$request->providerId );
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $toastr_title = trans('messages.toastr_error');
            Toastr::error($message, '', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
    }
    public function storeBox19Reason(Request $request){
        try {
            $this->saveBox19Reason($request);
            if($request->reasonId){
                $message = 'Box 19 Reason added successfully';
            }
            else{
                $message = 'Box 19 Reason updated successfully';
            }
            
            $toastr_title = trans('messages.toastr_success');
            Toastr::success($message, '', ["positionClass" => "toast-top-center"]);
            return redirect('/add-box-19-reason/'.$request->providerId );
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $toastr_title = trans('messages.toastr_error');
            Toastr::error($message, '', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
    }
    
    public function customBillingTemplate(Request $request)
    {
        $providerId = $request->providerId;
        $reasons = WriteOffReason::where('provider_id', $providerId)->where('type', 2)->get();
        $id= null;
        return view('billingprocess/billingCustomSetting/billingTemplate.index',compact(['providerId', 'reasons','id']));
    }
     
    public function listOfCustomOrdering(Request $request)
    {
        $providerId = $request->providerId;
        $bRenderings = BillReferingOrderProvider::with('state','taxonomyCode')->whereIn('type',[1,2,3])->where('billing_provider_id',$providerId)->orderBy('id', 'desc')->get();
        $id= null;
        return view('billingprocess/billingCustomSetting/referringAndOrderingProvider.index',compact(['providerId', 'bRenderings','id']));
    }
    
    public function addCustomOrdering(Request $request)
    {
        $providerId = $request->providerId;
        $reasons = WriteOffReason::where('provider_id', $providerId)->where('type', 2)->get();
        $id= null;
        return view('billingprocess/billingCustomSetting/referringAndOrderingProvider.create',compact(['providerId', 'reasons','id']));
    }
    
     public function listOfReimbursements(Request $request)
    {
        $providerId = $request->providerId;
        $reasons = WriteOffReason::where('provider_id', $providerId)->where('type', 2)->get();
        $id= null;
        return view('billingprocess/billingCustomSetting/reimbursements.index',compact(['providerId', 'reasons','id']));
    }
    
    public function addReimbursements(Request $request)
    {
        $providerId = $request->providerId;
        $reasons = WriteOffReason::where('provider_id', $providerId)->where('type', 2)->get();
        $id= null;
        return view('billingprocess/billingCustomSetting/reimbursements.create',compact(['providerId', 'reasons','id']));
    }
    public function providerBillWriteOfReason(Request $request)
    {
        $providerId = $request->providerId;
        $type =   $request->type; $title = null; $btnHeading = null;
        if($type ==1){
            $title = 'Bill Write Off Reasons';
            $btnHeading = 'Add Bill Write Off Reasons';
        }
       else if($type == 2){
            $title = 'Second Review Reasons';
            $btnHeading = 'Add Second Review Reasons';
        }
        else if($type == 3){
            $title = 'Box 19 Reasons';
            $btnHeading = 'Add Box 19 Reasons';
        }
        $reasons = WriteOffReason::where('provider_id', $providerId)->where('type', $type)->get();
        $id= null;
        return view('billingprocess/billingCustomSetting/billWriteOfReason.index',compact(['btnHeading','title','providerId','reasons','id', 'type']));
    }
    public function storeBillWriteOfReasonData(Request $request){
        try {
            $this->saveBillWriteOfReasonInfo($request); 
            $msgType = ($request->reasonId != '') ? ' updated' : ' added';
            $msg = ($request->reasonType == 1) ? 'Bill write off reason' : ( ($request->reasonType == 2) ? 'Second review reasons' : 'Box 19 reasons');
            $message = $msg. $msgType .' successfully';
            
            $toastr_title = trans('messages.toastr_success');
            Toastr::success($message, '', ["positionClass" => "toast-top-center"]);
            return redirect('/provider-bill-write-off-reason/'.$request->providerId.'/'. $request->reasonType);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $toastr_title = trans('messages.toastr_error');
            Toastr::error($message, '', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
    }
    public function addCustomBillingTemplate(Request $request)
    {
        $providerId = $request->providerId;
        
        $id= ($request->id) ? $request->id : null;
        $templateInfo = ProviderBillingTemplate::where('id', $id)->first();
        $billingTemplates = ProviderBillingTemplate::with('getTemplateServiceItems','getBillCount')->where('provider_id', $providerId)->get();
        $modifiersArray = BillModifier::where('status', 1)->get();
        return view('billingprocess/billingCustomSetting/billingTemplate.create',compact(['billingTemplates','providerId', 'templateInfo','id','modifiersArray']));
    }
    public function storeProviderBillingTemplate(Request $request){ 
        try { 
            DB::beginTransaction();
            $this->saveProviderBillingTemplate($request);
            DB::commit();
            $msg = 'Provider billing template created successfully';
            if($request->billingTemplateId ){
                $msg = 'Provider billing template updated successfully';
            } 
            $url = 'add-custom-billing-template/'.$request->billingProviderId;
            return $this->redirectToRoute($url, $msg , 'success', ["positionClass" => "toast-top-center"]); 
        } catch (\Exception $e) {
            DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
}
