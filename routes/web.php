<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, RoleController, ProductController, BillingProcessController, BillInfoController, PatientController,PatientInjuryController,
    ClaimAdministratorController,BillingProviderController,HealthProviderController, MedicalProviderController, BillingLetterController,
    TaxonomyCodeController,  DiagnosisCodeController,  ServiceCodeController, CompanyTypeController, ClaimStatusController,
    PayerTypeController, CountryController, StateController, CityController, TaskController, StatusController, UserTaskController,
    BillingCustomSettingController, UserInviteController, MasterHolidayController
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
return redirect(route('login'));
});


Route::get('bill-submissions/letters/demand-letter/{providerId}', [BillingLetterController::class, 'viewDemandLetter']);

Route::get('bill-submissions/letters/sbr-letter/{providerId}', [BillingLetterController::class, 'viewSbrLetter']);

Route::get('bill-submissions/letters/rfa-letter/{providerId}', [BillingLetterController::class, 'viewRFALetter']);

Route::get('bill-submissions/letters/resubmission-letter/{providerId}', [BillingLetterController::class, 'viewResubmissionLetter']);

Route::get('bill-submissions/letters/pr2-letter/{providerId}', [BillingLetterController::class, 'viewPr2Letter']);

Route::get('bill-submissions/letters/authorization-letter/{providerId}', [BillingLetterController::class, 'viewAuthorizationLetter']);




Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::get('logout', [LoginController::class, 'logout']);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);

    Route::get('billprocess/stepForm', [BillingProcessController::class, 'stepForm'])->name('billprocess.stepForm');
    Route::resource('billprocess', BillingProcessController::class);
    Route::post('patients/restore/{id}', [PatientController::class, 'restore'])->name('patients.restore');
    Route::resource('patients', PatientController::class);
    Route::post('patientinjuries/restore/{id}', [PatientInjuryController::class, 'restore'])->name('patientinjuries.restore');

    Route::resource('patientinjuries', PatientInjuryController::class);
    Route::post('billinfos/restore/{id}', [BillInfoController::class, 'restore'])->name('billinfos.restore');
    Route::post('billinfos/saveBillDocument', [BillInfoController::class, 'saveBillDocument'])->name('billinfos.saveBillDocument');
    Route::get('billinfos/printpdf/{id}', [BillInfoController::class, 'printpdf']);
    Route::get('billinfos/bills/{id}', [BillInfoController::class, 'billList']);
    Route::resource('billinfos', BillInfoController::class);


    Route::post('claimadministrators/restore/{id}', [ClaimAdministratorController::class, 'restore'])->name('claimadministrators.restore');
    Route::resource('claimadministrators', ClaimAdministratorController::class);

    Route::post('billingproviders/restore/{id}', [BillingProviderController::class, 'restore'])->name('billingproviders.restore');
    Route::resource('billingproviders', BillingProviderController::class);
    Route::post('healthproviders/restore/{id}', [HealthProviderController::class, 'restore'])->name('healthproviders.restore');
    Route::resource('healthproviders', HealthProviderController::class);
    Route::post('medicalproviders/restore/{id}', [MedicalProviderController::class, 'restore'])->name('medicalproviders.restore');
    Route::resource('medicalproviders', MedicalProviderController::class);
    Route::post('servicecodes/restore/{id}', [ServiceCodeController::class, 'restore'])->name('servicecodes.restore');
    Route::resource('servicecodes', ServiceCodeController::class);
    
    Route::post('diagnosiscodes/restore/{id}', [DiagnosisCodeController::class, 'restore'])->name('diagnosiscodes.restore');
    Route::resource('diagnosiscodes', DiagnosisCodeController::class);
    Route::post('companytypes/restore/{id}', [CompanyTypeController::class, 'restore'])->name('companytypes.restore');
    Route::resource('companytypes', CompanyTypeController::class);
    Route::post('claimstatuses/restore/{id}', [ClaimStatusController::class, 'restore'])->name('claimstatuses.restore');
    Route::resource('claimstatuses', ClaimStatusController::class);
    Route::post('payertypes/restore/{id}', [PayerTypeController::class, 'restore'])->name('payertypes.restore');
    Route::resource('payertypes', PayerTypeController::class);

    /*Country-State-City Masters*/
    Route::post('countries/restore/{id}', [CountryController::class, 'restore'])->name('countries.restore');
    Route::resource('countries', CountryController::class);
    // Route::get('state/restore/{id}', [StateController::class, 'restore'])->name('states.restore');
    Route::post('state/restore', [StateController::class, 'restore'])->name('states.restore');
    Route::post('get-states-by-country', [StateController::class, 'getStatesByCountry']);
    Route::post('get-cities-by-state', [CityController::class, 'getCitiesByState']);
    Route::resource('states', StateController::class);
    Route::post('city/restore', [CityController::class, 'restore'])->name('cities.restore');
    Route::resource('cities', CityController::class);

    Route::resource('tasks', TaskController::class);
    Route::post('tasks/restore/{id}', [TaskController::class, 'restore'])->name('tasks.restore');
    Route::resource('statuses', StatusController::class);
    Route::post('statuses/restore/{id}', [StatusController::class, 'restore'])->name('statuses.restore');

    Route::resource('usertasks', UserTaskController::class);
    Route::post('usertasks/restore/{id}', [UserTaskController::class, 'restore'])->name('usertasks.restore');

    Route::get('create/patients/billing/{id?}',[PatientController::class, 'createPatientBilling']);

    Route::post('searchPatient', [PatientController::class, 'searchPatient']);

    Route::post('patient/list',[PatientController::class, 'searchPatientList']);



    Route::post('searchClaimsAdministrator', [PatientController::class, 'searchClaimsAdministrator']);
    Route::post('get/patients',[PatientController::class, 'getAllPatients']);


    //Route::get('create/schedular/{id}', [PatientController::class, 'addSchedular']);
    Route::get('/patient/create/schedular/{id?}', [PatientController::class, 'addPatientSchedular'])->name('addPatientSchedular');

    Route::get('patients/view/{id?}',[PatientController::class, 'viewPatient']);
    Route::get('injury/view/{id?}',[PatientController::class, 'viewInjury']);

    Route::post('patientinjuries/create', [PatientInjuryController::class, 'savePatientInjury']);

    Route::post('patient/appointment/create', [PatientController::class, 'savePatientAppointment'])->name('savePatientSchedular');

    Route::get('create/patients/injury/{pid}',[PatientController::class, 'createInjury']);
    Route::get('edit/patients/injury/{id}',[PatientController::class, 'createInjury']);
    Route::get('add/injury/bill/{injuryId?}',[PatientController::class, 'createInjuryBill']);
    
    Route::get('view/patient/injury/bill/{injuryId?}',[PatientController::class, 'viewPatientInjuryBill']);
    

    Route::get('view/patient/injury/bill/info/{id?}',[PatientController::class, 'viewPatientInjuryBillInfomation']);

    Route::post('ajaxViewEvents',[PatientController::class, 'ajaxViewEvents']);
    Route::get('search/patient/list',[PatientController::class, 'searchPatientList']);

    Route::post('get/billing/Provider',[PatientController::class, 'getAllBillinProviders']);

    Route::post('get/search/patients',[PatientController::class, 'getAllSearchBasedPatients']);
    Route::get('edit/patients/injury/bill/{id}/{injuryId?}/{patientId?}',[PatientController::class, 'createInjuryBill']);
    Route::get('billing/providers/setting/{id}',[BillingProviderController::class, 'billingProvidersSetting']);
    Route::get('billing/rendering/{id}',[BillingProviderController::class, 'billingRendering']);


    Route::post('get-cities-state-by-zipCode', [CityController::class, 'getCitiesStateByZipCode']);
    Route::post('get-state-by-country', [CityController::class, 'getStateByCountry']);
    Route::post('get-cities-by-state-code', [CityController::class, 'getCityByStateCode']);
    Route::post('get-referning-providers', [BillingProviderController::class, 'getReferingOrderProvider']);

    //billing rendering provider
    Route::get('add/billing/rendering/{providerId}',[BillingProviderController::class, 'createBillingRendering']);
    Route::get('add/billing/referring/orderingProviders/{providerId}',[BillingProviderController::class, 'createBillingReferring']);

    Route::post('save-referning-providers', [BillingProviderController::class, 'storeBillRender'])->name('saveBillRender');
    Route::get('edit/billing/rendering/{providerId}/{id}',[BillingProviderController::class, 'createBillingRendering']);

    Route::get('view/billing/rendering/{id}',[BillingProviderController::class, 'viewBillingRendering']);
    Route::get('view/billing/referring/providers/{id}',[BillingProviderController::class, 'viewBillingReferring']);

    Route::get('places-of-service/{providerId}',[BillingProviderController::class, 'placesOfServices']);
    Route::get('view/places-of-service/{serviceId}',[BillingProviderController::class, 'viewPlacesOfServices']);


   // Route::get('/view/billing/place/of/services/{providerId}/{serviceId}',[BillingProviderController::class, 'placesOfServices1']);

    Route::get('add/places-of-service/{providerId}',[BillingProviderController::class, 'addPlacesOfServices']);
    Route::get('edit/places-of-service/{providerId}/{id}',[BillingProviderController::class, 'addPlacesOfServices']);

    Route::post('save-place-of-service', [BillingProviderController::class, 'storeBillOfServices'])->name('saveBillPlaceOfService');

    Route::post('save-billing-providers', [BillingProviderController::class, 'storeBillingProvider'])->name('saveBillProvider');

    Route::get('view/billing/provider/{id}',[BillingProviderController::class, 'viewBillingProvider']);
    Route::get('edit/billing/provider/{id}',[BillingProviderController::class, 'editBillingProvider']);

    Route::get('patients/injury/notes/{injuryId}',[PatientController::class, 'showInjuryNotes']);

     Route::get('patients/injury/documents/{injuryId}/{type}/{id?}',[PatientController::class, 'addDocuments']);

     Route::get('patients/injury/sbr/{injuryId}',[PatientController::class, 'addSbr']);

     Route::post('get-billing-info-view', [PatientController::class, 'getBillingInfo']);

    Route::get('billing/referring/{id}',[BillingProviderController::class, 'billingReferring']);

    Route::get('edit/billing/referring/{providerId}',[BillingProviderController::class, 'createBillingReferring']);

    Route::get('add/rfa/requesting/physicians/{providerId}',[BillingProviderController::class, 'addRfaRequestingPhysicians']);

    Route::get('add/rfa/practice/locations/{providerId}',[BillingProviderController::class, 'addRfaPracticeLocations']); 
    
    Route::get('add/rfa/template/{providerId}',[BillingProviderController::class, 'addRfaTemplate']);
   
   //View RFA Setting Create action route 
   Route::post('save-physician-setting', [BillingProviderController::class, 'savePhysicianSetting'])->name('savePhysicianSetting');
   Route::get('setting/billing/provider/charge/{providerId}',[BillingProviderController::class, 'viewBillingCharge']);
   
   Route::get('list/rfa/requesting/physicians/{providerId}',[BillingProviderController::class, 'requestingPhysicians']);

   Route::get('list/rfa/practice/locations/{providerId}',[BillingProviderController::class, 'practiceLocation']);

   Route::post('save-practice-location', [BillingProviderController::class, 'storePracticeLocation'])->name('storePracticeLocation');
    
   
   Route::post('searchDiagnosis', [PatientController::class, 'getSearchDiagnosis']);
   
   Route::get('add-document-billing-custom-setting/{providerId}', [BillingCustomSettingController::class, 'addCustomSetting']);
   
   Route::get('view-document-billing-custom-setting/{providerId}', [BillingCustomSettingController::class, 'viewCustomSetting']);

   Route::post('patients/injury/bill/document',[PatientController::class, 'saveInjuryBillDocuments'])->name('storeInjuryBillDocument');
   
   
   
   Route::get('add-second-review-reason/{providerId}', [BillingCustomSettingController::class, 'addSecondReviewReasons']);
   
   Route::get('add-box-19-reason/{providerId}', [BillingCustomSettingController::class, 'addBox19Reasons']);
   Route::post('billing/provider/document',[BillingCustomSettingController::class, 'saveDocuments'])->name('storeDocuments');

   
   Route::post('save-second-review-reason', [BillingCustomSettingController::class, 'storeSecondReviewReason'])->name('saveSecondReviewOfReason');
   Route::post('save-box19-reason', [BillingCustomSettingController::class, 'storeBox19Reason'])->name('saveBox19ReasonReason');
   Route::get('custom-billing-template/{providerId}', [BillingCustomSettingController::class, 'customBillingTemplate']); 
   
   Route::get('list-of-custom-referring-ordering-providers/{providerId}', [BillingCustomSettingController::class, 'listOfCustomOrdering']);
   Route::get('add-custom-referring-ordering-providers/{providerId}', [BillingCustomSettingController::class, 'addCustomOrdering']);
   Route::post('save-billing-provider-charge', [BillingProviderController::class, 'storeBillingProviderCharge'])->name('saveBillProviderCharge');
   
   
   
   Route::get('add-reimbursements/{providerId}', [BillingCustomSettingController::class, 'addReimbursements']);

//injury notes routes
   Route::post('patientinjuries/note/create', [PatientInjuryController::class, 'saveInjuryNotes']);
   
   Route::get('edit/patient/{id?}',[PatientController::class, 'create']);
   Route::post('edit/update/{id?}',[PatientController::class, 'update'])->name('updatePatient');
   Route::post('patientinjuries/contact/create', [PatientInjuryController::class, 'saveInjuryContact']);

   
   Route::post('delete/procedure/code/{id}', [BillingProviderController::class, 'deleteProcedureCode']);
   Route::post('searchProcedureCodeForUnit', [BillingProviderController::class, 'searchProcedureCodeForUnit']);
   Route::get('billing/provider/view-cms-1500-form/{billId}', [BillingProviderController::class, 'viewCmsForm']);
   Route::post('matchICDCOdeWithDiagCode', [PatientController::class, 'getDiagnosisCodeInfo']);
   Route::post('patient/injury/diagnosis/code/add/update', [PatientController::class, 'patientInjuryDiagnosisCodeAddUpdate']);
   Route::post('patient/injury/contact/delete', [PatientController::class, 'patientInjuryContactDelete']);
   Route::post('ajaxBillingProvider',[PatientController::class, 'ajaxBillingProviders']);
   Route::post('ajaxBillingProviderLocations',[PatientController::class, 'ajaxBillingProviderLocations']);
   Route::post('ajaxBillingProviderRendering',[PatientController::class, 'ajaxBillingProviderRendering']);
 
   //
   Route::get('permissions', [RoleController::class, 'permissionList'])->name('permissions');

   Route::get('billing/provider/cms-1500-form/{providerId?}', [BillingProviderController::class, 'createCmsForm']);
   Route::get('billing/provider/preview/cms/form/{providerId}', [BillingProviderController::class, 'previewViewCmsFormForBillingProvider'])
   ->name('viewBillingCMS');

   Route::get('billing/provider/task/assignment/preferences/{providerId}', [BillingProviderController::class, 'viewAssignTaskForBillingProvider']);
   Route::get('provider-bill-write-off-reason/{providerId}/{type}', [BillingCustomSettingController::class, 'providerBillWriteOfReason']);
   Route::post('save-bill-write-of-reason', [BillingCustomSettingController::class, 'storeBillWriteOfReasonData'])->name('saveBillWriteOfReason');

   Route::get('add-custom-billing-template/{providerId}/{id?}', [BillingCustomSettingController::class, 'addCustomBillingTemplate']);
   Route::post('save-billing-provider-template', [BillingCustomSettingController::class, 'storeProviderBillingTemplate'])->name('saveProviderBillingTemplate');

   Route::get('setting/billing/provider/add/practice/charge/{providerId}/{ctype?}', [BillingProviderController::class, 'createPracticeCharge']);
   Route::post('save-practice-charge', [BillingProviderController::class, 'storePracticeCharge'])->name('savePracticeCharge');
   Route::get('/settings/charges/{chargeId}', [BillingProviderController::class, 'settingCharge']);
   Route::post('/settings/save/procedure/code', [BillingProviderController::class, 'saveProcedureCode'])->name('saveProcedureCode'); 
   Route::get('/settings/providers/expected/reimbursements/{providerId}/{ctype?}', [BillingProviderController::class, 'createBillingCharge']);
   Route::get('setting/billing/provider/charge/add/{providerId}/{ctype?}',[BillingProviderController::class, 'createBillingCharge']);

   Route::get('list/practice/contact/{providerId}',[BillingProviderController::class, 'practiceContactList']); 
   Route::get('view/practice/contact/{providerId}',[BillingProviderController::class, 'viewPracticeContact']);
   Route::get('add/practice/contact/{providerId}',[BillingProviderController::class, 'addPracticeContact']);
   Route::post('practice-contact', [BillingProviderController::class, 'savePracticeContact'])->name('practiceContact');
   Route::get('edit/practice/contact/{providerId}/{id}',[BillingProviderController::class, 'addPracticeContact']);
   Route::get('show/practice/contact/{id}',[BillingProviderController::class, 'showPracticeContact']);
   Route::post('store/permission', [RoleController::class, 'savePermission'])->name('savePermission');
   Route::post('delete/permission/{id}',[RoleController::class, 'deletePermission']);
   Route::post('delete/role/{id}',[RoleController::class, 'deleteRole']);

   // Users
   Route::get('edit/profile/{id?}', [HomeController::class, 'editProfile'])->name('editProfile');
   Route::get('manage/users', [UserInviteController::class, 'index'])->name('manageUsers');
   Route::get('invite/user', [UserInviteController::class, 'inviteUser'])->name('inviteUser');
   Route::post('inviteProcess', [UserInviteController::class, 'inviteProcess'])->name('inviteProcess');
   Route::get('users/invitation/accept/{token?}', [UserInviteController::class, 'acceptInvite'])->name('userRegistration'); 
   Route::post('accept/invite/proccess', [UserInviteController::class, 'acceptInviteProcess'])->name('acceptInviteProcess');
   Route::post('resend/invite', [UserInviteController::class, 'inviteProcess']);
   Route::post('delete/invite', [UserInviteController::class, 'deletUserInvite']);
   Route::post('delete/user', [UserInviteController::class, 'deleteUser']);
   
   Route::get('edit/injury/bill/{injuryId?}/{id?}',[PatientController::class, 'createInjuryBill']);
   Route::post('get/template/service/item', [PatientController::class, 'getTemplateProcedureCode']);
   Route::post('save/patients/injury/bill',[PatientController::class, 'savePatienInjurytBill']);

    Route::post('taxonomycodes/restore/{id}', [TaxonomyCodeController::class, 'restore'])->name('taxonomycodes.restore');
    Route::resource('taxonomycodes', TaxonomyCodeController::class);
    Route::post('taxonomycodes/update', [TaxonomyCodeController::class, 'updateTaxnomyCode'])->name('updatedTaxnoMyCode');

    Route::post('taxonomycodes/delete', [TaxonomyCodeController::class, 'deleteTaxnomy'])->name('deleteTaxnoMyCode');

    //uplaod pdf file for document

    Route::post('patients/document',[PatientController::class, 'saveTempDocumentForAllDocuments']);

    //bill letters
    Route::get('view/bill/letter/sbr/{patientId?}',[BillInfoController::class, 'sbrLetter']);
    Route::get('view/bill/letter/rfa/{patientId?}',[BillInfoController::class, 'rfaLetter']);
    Route::get('view/bill/letter/resubmission/{patientId?}',[BillInfoController::class, 'resubmissionLetter']);
    Route::get('view/bill/letter/pr2/{patientId?}',[BillInfoController::class, 'pr2Letter']);
    Route::get('view/bill/letter/demand/{patientId?}',[BillInfoController::class, 'demandLetter']); 
    Route::get('view/bill/letter/authorization/{patientId?}',[BillInfoController::class, 'authorizationLetter']);
    
    Route::post('updateUserProfile/{id?}', [UserInviteController::class, 'updateProfile'])->name('updateUserProfile');

    //
    Route::post('companytypes/update', [CompanyTypeController::class, 'updateCompanyType'])->name('companytypesUpdate');
    Route::get('patient/list/schedular',[PatientController::class, 'schedularList']);
    
    Route::get('billing/providers/reasons/{providerId}',[BillingProviderController::class, 'resaonsList']);
    Route::post('billing/save/reasons', [BillingProviderController::class, 'storeAppointmentResaon'])->name('storeResaon'); 
    Route::post('billing/delete/reasons', [BillingProviderController::class, 'deleteAppointmentResaon'])->name('deleteResaon');

    Route::post('ajaxPatientInjury',[BillingProviderController::class, 'ajaxPatientInjury']);
    Route::post('ajaxBillingProviderReasons',[PatientController::class, 'ajaxBillingProviderReasons']);
    
    Route::get('billing/providers/recurence/{providerId}',[BillingProviderController::class, 'recurrencesList']);
    Route::post('billing/save/recurence', [BillingProviderController::class, 'storeAppointmentRecurrecne'])->name('storeReecurence');
    Route::post('billing/delete/recurence', [BillingProviderController::class, 'deleteAppointmentReccurence'])->name('deleteRecurrecne');
    
    Route::post('changeAppointmentStatus',[PatientController::class, 'appointmentStatus']);
    Route::post('changeAppointmentBillStatus',[PatientController::class, 'appointmentBillStatus']);
    Route::post('delete/Appointment',[PatientController::class, 'appointmentDelete']);
    Route::get('master/holidays',[MasterHolidayController::class, 'index']);
    Route::post('save/holiday', [MasterHolidayController::class, 'storeHoliday']); 
    Route::post('delete/holiday', [MasterHolidayController::class, 'deleteHoliday']);
    Route::get('billing/providers/holidays/{providerId}',[BillingProviderController::class, 'billingProviderHolidayList']);

});