<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Company_type;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use Toastr;
use DB;

class CompanyTypeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:CompanyType-list|CompanyType-create|CompanyType-edit|CompanyType-delete', ['only' => ['index','show']]);
         $this->middleware('permission:CompanyType-create', ['only' => ['create','store']]);
         $this->middleware('permission:CompanyType-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:CompanyType-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $company_types = Company_type::withTrashed()->paginate(5);
        //var_dump($company_types); die();
        $i =  (request()->input('page', 1) - 1) * 5;
        return view('masters.companytypes.index', compact('company_types', 'i'));  //->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function get_data(Request $request)
  {
      $company_types = Company_type::latest()->paginate(5);

      return Request::ajax() ? 
                   response()->json($company_types,Response::HTTP_OK) 
                   : abort(404);
  }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        request()->validate(['name' => 'required']);

        $company_type = new Company_type();
        $company_type->name = $request->name;
        $company_type->save();
    
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data inserted successfully',
            'records'  =>$company_type
          ]
        );
        //return Response::json($company_type);
    }

    public function show(Company_type $company_type)
    {
        //
    }

    public function edit(Company_type $company_type)
    {
        //
    }

    // public function update(Request $request, Company_type $company_type)
    // {
       
    //     request()->validate(['name' => 'required']);    
    //     $company_type =   Company_type::where('id', $request->companytype_id)->first();  
    //     dd($company_type);
    //     $company_type->name = $request->name;
    //     $company_type->save();

    //     Session::flash('success', 'Data updated successfully!');
    //     session()->now('message', 'Success! message.');
    //     return response()->json(
    //       [
    //         'success' => 1,
    //         'message' => 'Data updated successfully',
    //         'records'  =>$company_type
    //       ]
    //     );

    // }

    public function destroy(Company_type $companytype)
    {
        Company_type::where("id", $companytype->id)->update(['is_active' => '0']);        
        $companytype->delete();
        Session::flash('success', 'Data blocked successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data blocked successfully'
          ]
        );
    }

    public function restore(Request $request)
    {
        Company_type::withTrashed()->find($request->id)->restore(); 
        Company_type::where("id", $request->id)->update(['is_active' => '1']); 
        Session::flash('success', 'Data restore successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data restore successfully'
          ]
        );
    }
    public function updateCompanyType(Request $request)
    { 
      //dd($company_type);
         $validator = Validator::make($request->all(),[
            'editname' => 'required',
        ]);
        if ($validator->fails()) {
              return $this->redirectToRoute(redirect()->back(), $validator->errors()->first(), 'error', ["positionClass" => "toast-top-center"]); 
        } 
        try
        {
          DB::beginTransaction(); 
            $company_type =   Company_type::where('id', $request->companytype_id)->first();  
            //dd($company_type);
            $company_type->name = $request->editname;
            $company_type->save();
            DB::commit();
            return $this->redirectToRoute('/companytypes', 'Company Type updated successfully', 'success', ["positionClass" => "toast-top-center"]);
        }catch(\Exception $e){     
              DB::rollback();
              return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]); 
        } 
    }
}
