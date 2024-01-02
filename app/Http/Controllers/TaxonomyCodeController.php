<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Taxonomy_code;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Toastr;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TaxonomyCodesImport;


class TaxonomyCodeController extends Controller
{
    public function index()
    {
        $taxonomy_codes = Taxonomy_code::where('is_active', 1)->get();
        //dd($taxonomy_codes);
        //var_dump($taxonomy_codes); die();
        //return view('masters.taxonomycodes.index', compact('taxonomy_codes'))->with('i', (request()->input('page', 1) - 1) * 15);
        return view('masters.taxonomycodes.index', compact(['taxonomy_codes']));
    }

    public function store(Request $request)
    {
       
         request()->validate(['name' => 'required', 'code' => 'required']);
         $taxonomycode = Taxonomy_code::where('name', $request->name)->where('code', $request->code)->first();
         if($taxonomycode){
          return  $this->redirectToRoute('/taxonomycodes', 'This taxonomy codes  already exist', 'error', ["positionClass" => "toast-top-center"]);
         }
        $taxonomy_codes = new Taxonomy_code();
        $taxonomy_codes->name = $request->name;
        $taxonomy_codes->code = $request->code;
        $taxonomy_codes->save();
        return  $this->redirectToRoute('/taxonomycodes', 'Taxonomy codes  added successfully', 'success', ["positionClass" => "toast-top-center"]);
       
    }

    public function edit(taxonomy_codes $taxonomy_codes)    { }

    public function update(Request $request, Taxonomy_code $taxonomycode)
    {
      echo "<pre>";
      print_r($request->all());exit;
       // request()->validate(['name' => 'required', 'code' => 'required']);

        $taxonomycode->name = $request->name;
        $taxonomycode->code = $request->code;
        $taxonomycode->save();
        Session::flash('success', 'Data updated successfully!');
        //session()->now('message', 'Success! message.');
        //return  $this->redirectToRoute('/taxonomycodes', 'Taxonomy Codes  updated successfully', 'success', ["positionClass" => "toast-top-center"]);
    }

    public function destroy(Taxonomy_code $taxonomycode)
    {
        Taxonomy_code::where("id", $taxonomycode->id)->update(['is_active' => '0']);        
        $taxonomycode->delete();
         return  $this->redirectToRoute('/taxonomycodes', 'Taxonomy codes  deleted successfully', 'success', ["positionClass" => "toast-top-center"]);
    }

    public function restore(Request $request)
    {
        Taxonomy_code::withTrashed()->find($request->id)->restore(); 
        Taxonomy_code::where("id", $request->id)->update(['is_active' => '1']); 
        Session::flash('success', 'Data restore successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data restore successfully'
          ]
        );
    }
    public function updateTaxnomyCode(Request $request)
    {
       $taxonomycode = Taxonomy_code::where('id', $request->code_id)->first();
        if($taxonomycode){
          $taxonomycode->name = $request->name;
          $taxonomycode->code = $request->code;
          $taxonomycode->save(); 
        } 
        return  $this->redirectToRoute('/taxonomycodes', 'Taxonomy codes  updated successfully', 'success', ["positionClass" => "toast-top-center"]);
    }
    public function deleteTaxnomy(Request $request)
    {
      Taxonomy_code::where("id", $request->id)->update(['is_active' => '0']);
      $taxonomycode =  Taxonomy_code::where("id", $request->id)->first();        
      $taxonomycode->delete();
         return  $this->redirectToRoute('/taxonomycodes', 'Taxonomy codes  deleted successfully', 'success', ["positionClass" => "toast-top-center"]);
    }

    public function importTaxonomyCode(Request $request)
    {
      // echo "<pre>";
      // print_r($request->all());exit;
      try {
            DB::beginTransaction();
              if(isset($request->import_file)){ 
                $imported_Code = (new TaxonomyCodesImport)->toArray(request()->file('import_file'));
                $fullArray = $imported_Code[1];
                  //dd( $fullArray);
                  foreach($fullArray as $taxCode){
                     //echo $taxCode[0];
                    $checkTaxCOde = Taxonomy_code::where('code', $taxCode[0])->first();
                    if($checkTaxCOde){
                      $checkTaxCOde->code = $taxCode[0];
                      $checkTaxCOde->name = $taxCode[1];
                      $checkTaxCOde->update();
                    }
                    else{
                      $newTaxCode = new Taxonomy_code();
                      $newTaxCode->code = $taxCode[0];
                      $newTaxCode->name = $taxCode[1];
                      $newTaxCode->save();
                    }
                  }  
              }
            DB::commit();
            return $this->redirectToRoute('taxonomycodes', 'Taxonomy code import', 'success', ["positionClass" => "toast-top-center"]);
          } catch (\Exception $e) {
            DB::rollback();   
            return $this->redirectToRoute(redirect()->back(), 'Bill created successfully', 'error', ["positionClass" => "toast-top-center"]);
        }
    }
}
