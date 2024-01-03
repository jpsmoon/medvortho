<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, RoleController, ProductController, BillingProcessController, BillInfoController, PatientController,PatientInjuryController,
ClaimAdministratorController,BillingProviderController,HealthProviderController, MedicalProviderController, BillingLetterController,
TaxonomyCodeController,  DiagnosisCodeController,  ServiceCodeController, CompanyTypeController, ClaimStatusController,
PayerTypeController, CountryController, StateController, CityController, TaskController, StatusController, UserTaskController,
BillingCustomSettingController, UserInviteController, MasterHolidayController, MasterCrudController, TallyFormController, PdfMergerController
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
Route::get('bill-submissions/letters/demand-letter/{providerId?}/{billId?}', [BillingLetterController::class, 'viewDemandLetter']);

Route::get('bill-submissions/letters/sbr-letter/{providerId?}/{billId?}', [BillingLetterController::class, 'viewSbrLetter']);

Route::get('bill-submissions/letters/rfa-letter/{providerId?}/{billId?}', [BillingLetterController::class, 'viewRFALetter']);

Route::get('bill-submissions/letters/resubmission-letter/{providerId?}/{billId?}', [BillingLetterController::class, 'viewResubmissionLetter']);

Route::get('bill-submissions/letters/pr2-letter/{providerId?}/{billId?}', [BillingLetterController::class, 'viewPr2Letter']);

Route::get('bill-submissions/letters/authorization-letter/{providerId?}/{billId?}', [BillingLetterController::class, 'viewAuthorizationLetter']);

Route::post('tally/form', [TallyFormController::class, 'tallyForm']);

Route::post('test/form', [PatientController::class, 'testForm']);

Auth::routes();
    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::get('/home-new', [HomeController::class, 'index2'])->name('home-new');

    Route::post('showTodayPatientAppointment',[HomeController::class, 'showTodayAppointmentList']);

    Route::group(['middleware' => ['auth']], function() {
        Route::get('bill-submissions/letters/coversheet/{billId?}', [BillingLetterController::class, 'coversheet']);
        Route::get('logout', [LoginController::class, 'logout']);
        Route::post('healthproviders/restore/{id}', [HealthProviderController::class, 'restore'])->name('healthproviders.restore');
        Route::resource('healthproviders', HealthProviderController::class);
        Route::post('medicalproviders/restore/{id}', [MedicalProviderController::class, 'restore'])->name('medicalproviders.restore');
        Route::resource('medicalproviders', MedicalProviderController::class);
        Route::resource('usertasks', UserTaskController::class);
        Route::post('usertasks/restore/{id}', [UserTaskController::class, 'restore'])->name('usertasks.restore');
        Route::get('create/patients/billing/{id?}',[PatientController::class, 'createPatientBilling']); 
        Route::post('get/template/service/item', [PatientController::class, 'getTemplateProcedureCode']);
        Route::resource('products', ProductController::class);


        //Permission routes start here// 
            Route::group(['middleware' => ['permission:publish patient-list|patient-create|patient-edit|patient-delete']], function () {
                Route::resource('patients', PatientController::class);
                Route::post('patients/restore/{id}', [PatientController::class, 'restore'])->name('patients.restore');
                Route::post('searchPatient', [PatientController::class, 'searchPatient']);
                Route::post('patient/list',[PatientController::class, 'searchPatientList']);
                Route::post('get/patients',[PatientController::class, 'getAllPatients']);
                Route::get('patients/view/{id?}',[PatientController::class, 'viewPatient']);
                Route::get('search/patient/list',[PatientController::class, 'searchPatientList']);
                Route::post('get/search/patients',[PatientController::class, 'getAllSearchBasedPatients']);
                Route::get('edit/patient/{id?}',[PatientController::class, 'create']);
                Route::post('edit/update/{id?}',[PatientController::class, 'update'])->name('updatePatient');
                Route::post('patients/document',[PatientController::class, 'saveTempDocumentForAllDocuments']);
            }); 
            
            Route::group(['middleware' => ['permission:publish user-list|user-create|user-edit|user-delete|user-invite']], function () {
                Route::resource('users', UserController::class);
                Route::get('edit/profile/{id?}', [HomeController::class, 'editProfile'])->name('editProfile');
                Route::get('manage/users', [UserInviteController::class, 'index'])->name('manageUsers');
                Route::get('invite/user', [UserInviteController::class, 'inviteUser'])->name('inviteUser');
                Route::post('inviteProcess', [UserInviteController::class, 'inviteProcess'])->name('inviteProcess');
                Route::get('users/invitation/accept/{token?}', [UserInviteController::class, 'acceptInvite'])->name('userRegistration'); 
                Route::post('accept/invite/proccess', [UserInviteController::class, 'acceptInviteProcess'])->name('acceptInviteProcess');
                Route::post('resend/invite', [UserInviteController::class, 'inviteProcess']);
                Route::post('delete/invite', [UserInviteController::class, 'deletUserInvite']);
                Route::post('delete/user', [UserInviteController::class, 'deleteUser']);
                Route::post('updateUserProfile/{id?}', [UserInviteController::class, 'updateProfile'])->name('updateUserProfile');

            }); 
            Route::group(['middleware' => ['permission:publish bill-process-list|bill-process-create|bill-process-edit|bill-process-delete']], function () {
                Route::resource('billprocess', BillingProcessController::class);
                Route::get('billprocess/stepForm', [BillingProcessController::class, 'stepForm'])->name('billprocess.stepForm'); 
            });
            Route::group(['middleware' => ['permission:publish injury-list|injury-create|injury-edit|injury-delete']], function () {
                Route::post('patientinjuries/restore/{id}', [PatientInjuryController::class, 'restore'])->name('patientinjuries.restore');
                Route::resource('patientinjuries', PatientInjuryController::class);
                Route::get('injury/view/{id?}',[PatientController::class, 'viewInjury']);
                Route::post('patientinjuries/create', [PatientInjuryController::class, 'savePatientInjury']);
                Route::get('create/patients/injury/{pid}',[PatientController::class, 'createInjury']);
                Route::get('edit/patients/injury/{id}',[PatientController::class, 'createInjury']);
                Route::get('patients/injury/notes/{injuryId}',[PatientController::class, 'showInjuryNotes']);
                Route::get('patients/injury/documents/{injuryId}/{type}/{id?}',[PatientController::class, 'addDocuments']);
                Route::get('patients/injury/sbr/{injuryId}',[PatientController::class, 'addSbr']); 
                Route::post('patientinjuries/note/create', [PatientInjuryController::class, 'saveInjuryNotes']);
                Route::post('patientinjuries/contact/create', [PatientInjuryController::class, 'saveInjuryContact']);
                Route::post('patient/injury/contact/delete', [PatientController::class, 'patientInjuryContactDelete']);
                Route::post('patient/injury/diagnosis/code/add/update', [PatientController::class, 'patientInjuryDiagnosisCodeAddUpdate']);
                Route::post('ajaxPatientInjury',[BillingProviderController::class, 'ajaxPatientInjury']);
                Route::post('deleteDocument',[PatientController::class, 'deleteDocument']);
                Route::post('addDocumentForBillServiceProcedure',[PatientController::class, 'saveBillServiceProcedureDoc']);
                Route::post('showAllBillDocuments',[PatientController::class, 'getAllDocuementsByBillId']);
                Route::post('downloadPdfForBill',[PatientController::class, 'downloadBillPdf']);
            });

            Route::group(['middleware' => ['permission:publish bill-process-list|bill-process-create|bill-process-edit|bill-process-delete']], function () {
                Route::post('billinfos/restore/{id}', [BillInfoController::class, 'restore'])->name('billinfos.restore');
                Route::post('billinfos/saveBillDocument', [BillInfoController::class, 'saveBillDocument'])->name('billinfos.saveBillDocument');
                Route::get('billinfos/printpdf/{id}', [BillInfoController::class, 'printpdf']);
                Route::get('billinfos/bills/{id}', [BillInfoController::class, 'billList']);
                Route::resource('billinfos', BillInfoController::class);
            }); 
            Route::group(['middleware' => ['permission:publish claim-admin-list|claim-admin-create|claim-admin-edit|claim-admin-delete']], function () {
                Route::post('claimadministrators/restore/{id}', [ClaimAdministratorController::class, 'restore'])->name('claimadministrators.restore');
                Route::resource('claimadministrators', ClaimAdministratorController::class);
                Route::post('searchClaimsAdministrator', [PatientController::class, 'searchClaimsAdministrator']);
                Route::post('claimadministrators' , [ClaimAdministratorController::class, 'storeClaimAdminInfo'])->name('storeClaimAdminInfo');
            });

            Route::group(['middleware' => ['permission:publish billing-provider-list|billing-provider-list|billing-provider-edit|billing-provider-edit']], function () {
                Route::post('billingproviders/restore/{id}', [BillingProviderController::class, 'restore'])->name('billingproviders.restore');
                Route::resource('billingproviders', BillingProviderController::class);
                Route::post('get/billing/Provider',[PatientController::class, 'getAllBillinProviders']);
                Route::get('billing/providers/setting/{id}',[BillingProviderController::class, 'billingProvidersSetting']);
                Route::get('billing/rendering/{id}',[BillingProviderController::class, 'billingRendering']);
                Route::post('get-referning-providers', [BillingProviderController::class, 'getReferingOrderProvider']);
                //billing rendering provider
                Route::get('add/billing/rendering/{providerId}',[BillingProviderController::class, 'createBillingRendering']);
                Route::get('add/billing/referring/orderingProviders/{providerId}',[BillingProviderController::class, 'createBillingReferring']);
                Route::post('save-referning-providers', [BillingProviderController::class, 'storeBillRender'])->name('saveBillRender');
                Route::get('edit/billing/rendering/{providerId}/{id}',[BillingProviderController::class, 'createBillingRendering']);
                Route::get('view/billing/rendering/{id}',[BillingProviderController::class, 'viewBillingRendering']);
                Route::get('view/billing/referring/providers/{id}',[BillingProviderController::class, 'viewBillingReferring']);
                //Place of services
                Route::get('places-of-service/{providerId}',[BillingProviderController::class, 'placesOfServices']);
                Route::get('view/places-of-service/{serviceId}',[BillingProviderController::class, 'viewPlacesOfServices']);
                Route::get('add/places-of-service/{providerId}',[BillingProviderController::class, 'addPlacesOfServices']);
                Route::get('edit/places-of-service/{providerId}/{id}',[BillingProviderController::class, 'addPlacesOfServices']);
                Route::post('save-place-of-service', [BillingProviderController::class, 'storeBillOfServices'])->name('saveBillPlaceOfService');
                Route::post('save-billing-providers', [BillingProviderController::class, 'storeBillingProvider'])->name('saveBillProvider');
                Route::get('view/billing/provider/{id}',[BillingProviderController::class, 'viewBillingProvider']);
                Route::get('edit/billing/provider/{id}',[BillingProviderController::class, 'editBillingProvider']);
                Route::post('get-billing-info-view', [PatientController::class, 'getBillingInfo']);
                Route::get('billing/referring/{id}',[BillingProviderController::class, 'billingReferring']);
                Route::get('edit/billing/referring/{providerId}',[BillingProviderController::class, 'createBillingReferring']);
                Route::get('add/rfa/requesting/physicians/{providerId}',[BillingProviderController::class, 'addRfaRequestingPhysicians']);
                Route::get('add/rfa/practice/locations/{providerId}',[BillingProviderController::class, 'addRfaPracticeLocations']); 
                Route::get('add/rfa/template/{providerId}',[BillingProviderController::class, 'addRfaTemplate']);
                Route::post('save-physician-setting', [BillingProviderController::class, 'savePhysicianSetting'])->name('savePhysicianSetting');
                Route::get('setting/billing/provider/charge/{providerId}',[BillingProviderController::class, 'viewBillingCharge']);
                
                Route::get('list/rfa/requesting/physicians/{providerId}',[BillingProviderController::class, 'requestingPhysicians']);
                Route::get('list/rfa/practice/locations/{providerId}',[BillingProviderController::class, 'practiceLocation']);
                Route::post('save-practice-location', [BillingProviderController::class, 'storePracticeLocation'])->name('storePracticeLocation');
                Route::get('add-document-billing-custom-setting/{providerId}', [BillingCustomSettingController::class, 'addCustomSetting']);
                Route::get('view-document-billing-custom-setting/{providerId}', [BillingCustomSettingController::class, 'viewCustomSetting']);
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
                Route::post('delete/procedure/code/{id}', [BillingProviderController::class, 'deleteProcedureCode']);
                Route::post('searchProcedureCodeForUnit', [BillingProviderController::class, 'searchProcedureCodeForUnit']);
                Route::get('billing/provider/view-cms-1500-form/{billId}', [BillingProviderController::class, 'viewCmsForm']);
                Route::post('matchICDCOdeWithDiagCode', [PatientController::class, 'getDiagnosisCodeInfo']);
                Route::post('ajaxBillingProvider',[PatientController::class, 'ajaxBillingProviders']);
                Route::post('ajaxBillingProviderLocations',[PatientController::class, 'ajaxBillingProviderLocations']);
                Route::post('ajaxBillingProviderRendering',[PatientController::class, 'ajaxBillingProviderRendering']);
                Route::get('billing/provider/cms-1500-form/{providerId?}', [BillingProviderController::class, 'createCmsForm']);
                Route::get('billing/provider/preview/cms/form/{providerId}', [BillingProviderController::class, 'previewViewCmsFormForBillingProvider'])
                ->name('viewBillingCMS');
                Route::post('assign/task/to/user', [BillingProviderController::class, 'assignTaskToUser']);
                
                Route::get('billing/provider/task/assignment/preferences/{providerId}', [BillingProviderController::class, 'viewAssignTaskForBillingProvider']);
                Route::get('provider-bill-write-off-reason/{providerId}/{type}', [BillingCustomSettingController::class, 'providerBillWriteOfReason']);
                Route::post('save-bill-write-of-reason', [BillingCustomSettingController::class, 'storeBillWriteOfReasonData'])->name('saveBillWriteOfReason');
            
                Route::get('add-custom-billing-template/{providerId}/{id?}', [BillingCustomSettingController::class, 'addCustomBillingTemplate']);
                Route::post('save-billing-provider-template', [BillingCustomSettingController::class, 'storeProviderBillingTemplate'])->name('saveProviderBillingTemplate');
            
                Route::get('setting/billing/provider/add/practice/charge/{providerId}/{ctype?}', [BillingProviderController::class, 'createPracticeCharge']);
                Route::post('save-practice-charge', [BillingProviderController::class, 'storePracticeCharge'])->name('savePracticeCharge');
                Route::get('/settings/charges/{chargeId}/{providerId?}', [BillingProviderController::class, 'settingCharge']);
                Route::post('/settings/save/procedure/code', [BillingProviderController::class, 'saveProcedureCode'])->name('saveProcedureCode'); 
                Route::get('/settings/providers/expected/reimbursements/{providerId}/{ctype?}', [BillingProviderController::class, 'createBillingCharge']);
                Route::get('setting/billing/provider/charge/add/{providerId}/{ctype?}',[BillingProviderController::class, 'createBillingCharge']);
            
                Route::get('list/practice/contact/{providerId}',[BillingProviderController::class, 'practiceContactList']); 
                Route::get('view/practice/contact/{providerId}',[BillingProviderController::class, 'viewPracticeContact']);
                Route::get('add/practice/contact/{providerId}',[BillingProviderController::class, 'addPracticeContact']);
                Route::post('practice-contact', [BillingProviderController::class, 'savePracticeContact'])->name('practiceContact');
                Route::get('edit/practice/contact/{providerId}/{id}',[BillingProviderController::class, 'addPracticeContact']);
                Route::get('show/practice/contact/{id}',[BillingProviderController::class, 'showPracticeContact']);
                Route::get('billing/providers/reasons/{providerId}',[BillingProviderController::class, 'resaonsList']);
                Route::post('billing/save/reasons', [BillingProviderController::class, 'storeAppointmentResaon'])->name('storeResaon'); 
                Route::post('billing/delete/reasons', [BillingProviderController::class, 'deleteAppointmentResaon'])->name('deleteResaon');
                Route::post('ajaxBillingProviderReasons',[PatientController::class, 'ajaxBillingProviderReasons']);

                Route::get('billing/providers/recurence/{providerId}',[BillingProviderController::class, 'recurrencesList']);
                Route::post('billing/save/recurence', [BillingProviderController::class, 'storeAppointmentRecurrecne'])->name('storeReecurence');
                Route::post('billing/delete/recurence', [BillingProviderController::class, 'deleteAppointmentReccurence'])->name('deleteRecurrecne');
                Route::get('billing/providers/holidays/{providerId}',[BillingProviderController::class, 'billingProviderHolidayList']);
                Route::post('billing/save/holiday', [BillingProviderController::class, 'storeBillingProviderHolidays']);
                Route::post('billing/delete/holiday', [BillingProviderController::class, 'deleteBillingProviderHolidays']);
                Route::post('billing/provider/practice/charge', [BillingProviderController::class, 'billProviderPracticeChargeImport']);
                Route::post('import/procedure/code', [BillingProviderController::class, 'importProcedureCode']);
                //Route::post('setProviderTabIdInSession', [BillingProviderController::class, 'saveProviderTabIdInSession']);
                Route::post('matchICDCOdeWithAllDiagCode', [PatientController::class, 'getDiagnosisCodesForDC']); 
                Route::post('searchProcedureCodeForAutoSearch', [BillingProviderController::class, 'searchProcedureCodeForAutoSearch']);


            });
            Route::group(['middleware' => ['permission:publish service-code-list|service-code-create|service-code-edit|service-code-delete']], function () {
                Route::post('servicecodes/restore/{id}', [ServiceCodeController::class, 'restore'])->name('servicecodes.restore');
                Route::resource('servicecodes', ServiceCodeController::class);
            }); 
            Route::group(['middleware' => ['permission:publish diagnosis-code-list|diagnosis-code-create|diagnosis-code-edit|diagnosis-code-delete']], function () {
                Route::post('diagnosiscodes/restore/{id}', [DiagnosisCodeController::class, 'restore'])->name('diagnosiscodes.restore');
                Route::resource('diagnosiscodes', DiagnosisCodeController::class);
                Route::post('searchDiagnosis', [PatientController::class, 'getSearchDiagnosis']);
            });
            Route::group(['middleware' => ['permission:publish company-type-list|company-type-create|company-type-edit|company-type-delete']], function () {
                Route::post('companytypes/restore/{id}', [CompanyTypeController::class, 'restore'])->name('companytypes.restore');
                Route::resource('companytypes', CompanyTypeController::class);
                Route::post('companytypes/update', [CompanyTypeController::class, 'updateCompanyType'])->name('companytypesUpdate');
            });
            Route::group(['middleware' => ['permission:publish claim-status-list|claim-status-create|claim-status-edit|claim-status-delete']], function () {
                Route::post('claimstatuses/restore/{id}', [ClaimStatusController::class, 'restore'])->name('claimstatuses.restore');
                Route::resource('claimstatuses', ClaimStatusController::class);
            });
            Route::group(['middleware' => ['permission:publish payer-type-list|payer-type-create|payer-type-edit|payer-type-delete']], function () {
                Route::post('payertypes/restore/{id}', [PayerTypeController::class, 'restore'])->name('payertypes.restore');
                Route::resource('payertypes', PayerTypeController::class);
            });
            Route::group(['middleware' => ['permission:publish country-list|country-create|country-edit|country-delete']], function () {
                Route::post('countries/restore/{id}', [CountryController::class, 'restore'])->name('countries.restore');
                Route::resource('countries', CountryController::class);
            });
            Route::group(['middleware' => ['permission:publish state-list|state-create|state-edit|state-delete']], function () {
                // Route::get('state/restore/{id}', [StateController::class, 'restore'])->name('states.restore');
                Route::post('state/restore', [StateController::class, 'restore'])->name('states.restore');
                Route::post('get-states-by-country', [StateController::class, 'getStatesByCountry']);
                Route::post('delete/state', [StateController::class, 'destroyState']);
                Route::resource('states', StateController::class);
            });
            Route::group(['middleware' => ['permission:publish city-list|city-create|city-edit|city-delete']], function () {
                Route::post('get-cities-by-state', [CityController::class, 'getCitiesByState']); 
                Route::post('city/restore', [CityController::class, 'restore'])->name('cities.restore');
                Route::resource('cities', CityController::class);
                Route::post('get-cities-state-by-zipCode', [CityController::class, 'getCitiesStateByZipCode']);
                Route::post('get-state-by-country', [CityController::class, 'getStateByCountry']);
                Route::post('get-cities-by-state-code', [CityController::class, 'getCityByStateCode']);
                Route::get('get-city-list', [CityController::class, 'getCities']);
                Route::post('delete/city', [CityController::class, 'deleteCity']);
                Route::post('get/city/byId', [CityController::class, 'getCityById']);
                Route::post('update/city', [CityController::class, 'updateCity']);
            });
            Route::group(['middleware' => ['permission:publish task-list|task-create|task-edit|task-delete']], function () {
                Route::resource('tasks', TaskController::class);
                Route::post('tasks/restore/{id}', [TaskController::class, 'restore'])->name('tasks.restore');
            });
            Route::group(['middleware' => ['permission:publish task-list|task-create|task-edit|task-delete']], function () {
                Route::resource('tasks', TaskController::class);
                Route::post('tasks/restore/{id}', [TaskController::class, 'restore'])->name('tasks.restore');
            });
            Route::group(['middleware' => ['permission:publish status-list|status-create|status-edit|status-delete']], function () {
                Route::resource('statuses', StatusController::class);
                Route::post('statuses/restore/{id}', [StatusController::class, 'restore'])->name('statuses.restore');
                Route::post('get/status/aliase', [StatusController::class, 'getFilteredAlias']);
            }); 
            Route::group(['middleware' => ['permission:publish status-list|status-create|status-edit|status-delete']], function () {
                Route::resource('statuses', StatusController::class);
                Route::post('statuses/restore/{id}', [StatusController::class, 'restore'])->name('statuses.restore');
            }); 
            Route::group(['middleware' => ['permission:publish appointment-list|appointment-create|appointment-edit|appointment-delete']], function () {
                Route::get('/patient/create/schedular/{id?}', [PatientController::class, 'addPatientSchedular'])->name('addPatientSchedular'); 
                Route::post('patient/appointment/create', [PatientController::class, 'savePatientAppointment'])->name('savePatientSchedular');
                Route::post('ajaxViewEvents',[PatientController::class, 'ajaxViewEvents']);
                Route::post('appointment/info',[PatientController::class, 'getApointmentInfoById']);
                Route::get('patient/list/schedular',[PatientController::class, 'schedularList']);
                Route::post('changeAppointmentStatus',[PatientController::class, 'appointmentStatus']);
                Route::post('changeAppointmentBillStatus',[PatientController::class, 'appointmentBillStatus']);
                Route::post('delete/Appointment',[PatientController::class, 'appointmentDelete']);
                Route::post('check/holiday/appointment', [MasterHolidayController::class, 'checkHolidayForAppointment']); 
            });
            Route::group(['middleware' => ['permission:publish bill-list|bill-create|bill-edit|bill-delete']], function () {
                Route::get('add/injury/bill/{injuryId?}',[PatientController::class, 'createInjuryBill']);
                Route::get('view/patient/injury/bill/{injuryId?}',[PatientController::class, 'viewPatientInjuryBill']);
                Route::get('view/patient/injury/bill/info/{id?}',[PatientController::class, 'viewPatientInjuryBillInfomation']);
                Route::get('edit/patients/injury/bill/{id}/{injuryId?}/{patientId?}',[PatientController::class, 'createInjuryBill']);
                Route::post('patients/injury/bill/document',[PatientController::class, 'saveInjuryBillDocuments'])->name('storeInjuryBillDocument');
                Route::get('edit/injury/bill/{injuryId?}/{id?}',[PatientController::class, 'createInjuryBill']);
                Route::post('save/patients/injury/bill',[PatientController::class, 'savePatienInjurytBill']);
                    //bill letters
                Route::get('view/bill/letter/sbr/{patientId?}',[BillInfoController::class, 'sbrLetter']);
                Route::get('view/bill/letter/rfa/{patientId?}',[BillInfoController::class, 'rfaLetter']);
                Route::get('view/bill/letter/resubmission/{patientId?}',[BillInfoController::class, 'resubmissionLetter']);
                Route::get('view/bill/letter/pr2/{patientId?}',[BillInfoController::class, 'pr2Letter']);
                Route::get('view/bill/letter/demand/{patientId?}',[BillInfoController::class, 'demandLetter']); 
                Route::get('view/bill/letter/authorization/{patientId?}',[BillInfoController::class, 'authorizationLetter']);
                Route::get('bill/list/status/wise/{statusId}/{statusType}',[BillInfoController::class, 'billListStatusWise']);
                Route::post('bill/sent/to/provider',[BillInfoController::class, 'billSentProcess']);
                Route::post('get-second-review-text-by-id',[BillingProviderController::class, 'getSecondReviewInfoById']); 
                Route::post('storeBillSbr',[BillingProviderController::class, 'saveBillSecondSBR']); 
                Route::post('checkICDForBill',[PatientController::class, 'getICDTypeForBill']);
                Route::post('genrateAndDownloadBillPacketForSend',[PdfMergerController::class, 'billPacketForSendBill']);
                Route::get('showCoversheet/{bill_id}',[PdfMergerController::class, 'showCover']);
                Route::get('showCMS/{bill_id}',[PdfMergerController::class, 'showCMSFOrm']);
                Route::get('downloadCoverSheet/{bill_id}',[PdfMergerController::class, 'downloadCoverSheet']);
                Route::post('bill/add/diagnosis/code',[PatientController::class, 'storeBillDianosisCode'])->name('addDiagnosisCode');
                Route::post('bill/add/procedure/code',[PatientController::class, 'storeBillProcedureCodeManual'])->name('addProcedureCode');
                Route::post('store/write/reason/for/bill/cose',[PatientController::class, 'storeWitreOfReasonForBillClose'])->name('addbillWriteOfReasonForCloseBill');
                Route::post('generateCMSForPacket',[PdfMergerController::class, 'generateCMSForPacket']);
                Route::get('bill/payment/postings/new/first/{billId?}/{id?}',[PatientController::class, 'addBillPaymentEORSingle']); 
                Route::get('bill/payment/postings/new/multiple/{billId?}/{id?}/{pType?}',[PatientController::class, 'addBillPaymentEORMultiple']); 
                Route::post('save/single/bill/payment',[PatientController::class, 'saveSingleBillPayment']);
                Route::get('bill/payment/postings/update/first/{billId?}/{id}',[PatientController::class, 'addBillPaymentEORSingle']);  
                Route::get('collection/eor/bills',[BillingCustomSettingController::class, 'eorBills']);
                Route::get('collection/br/bills',[BillingCustomSettingController::class, 'brills']);
                Route::post('save/multiple/first/step',[PatientController::class, 'saveMultiFIrstStep']);
                Route::post('save/multiple/bill/payment',[PatientController::class, 'saveMultiBillPayment']);
                Route::get('bill/payment/postings/submission/multiple/{billId?}/{id}',[PatientController::class, 'addBillEORSubmissionMultiple']);
                Route::get('search/bill/eor/multiple/{id}',[PatientController::class, 'searchBillForEORMultiple']);
                Route::get('add/multiple/bill/payment/post/{billId?}/{paymentId}',[PatientController::class, 'storeBillPaymentPCDAMount']);
                Route::post('save/multiple/bill/payment/post',[PatientController::class, 'saveMultiBillPaymentPost']);
                Route::get('review/multiple/bill/payment/{paymentId}',[PatientController::class, 'reviewStoremultipleBillPayment']);
                Route::post('get/total/payment/for/this/bill/',[PatientController::class, 'returnTotalPaymentForThisBill']);
                Route::get('edit/multiple/bill/payment/post/{paymentId}',[PatientController::class, 'editPaymentPosting']);
                Route::post('update/multiple/bill/payment/post',[PatientController::class, 'editMultiBillPaymentPost']);
                Route::post('add/bill/payment/post/document',[PatientController::class, 'addBillPaymentDocument']); 
                Route::get('delete/multiple/bill/payment/post/{id}/{paymentId}',[PatientController::class, 'deletePaymentPost']);
                Route::post('remove/all/payment/data/change/tab',[PatientController::class, 'deleteAllDataInTabChange']);
                Route::post('delete/bill/diagonisis',[PatientController::class, 'deleteBillDiagnosis']);
                 
            }); 
            Route::group(['middleware' => ['permission:publish taxonomy-code-list|taxonomy-code-create|taxonomy-code-edit|taxonomy-code-delete']], function () {
                Route::post('taxonomycodes/restore/{id}', [TaxonomyCodeController::class, 'restore'])->name('taxonomycodes.restore');
                Route::resource('taxonomycodes', TaxonomyCodeController::class);
                Route::post('taxonomycodes/update', [TaxonomyCodeController::class, 'updateTaxnomyCode'])->name('updatedTaxnoMyCode');
                Route::post('taxonomycodes/delete', [TaxonomyCodeController::class, 'deleteTaxnomy'])->name('deleteTaxnoMyCode');
                Route::post('taxonomycodes/importCode', [TaxonomyCodeController::class, 'importTaxonomyCode'])->name('importTaxonomyCode');
            }); 
            Route::group(['middleware' => ['permission:publish report-type-list|report-type-create|report-type-edit|report-type-delete']], function () {
                Route::get('reprt/type',[MasterCrudController::class, 'reprtTypeList']);
                Route::post('save/reprt/type', [MasterCrudController::class, 'storeReportType']); 
                Route::post('delete/reprt/type', [MasterCrudController::class, 'deleteReportType']);
                Route::get('bill/error',[MasterCrudController::class, 'billErrorList']);
            }); 

        //Permission routes end here//

        //role routes start here
            Route::group(['middleware' => ['role:SubAdmin|Admin']], function () {
                //Route::group(['middleware' => ['permission:publish role-list|role-create|role-edit|role-delete']], function () {
                    Route::get('permissions', [RoleController::class, 'permissionList'])->name('permissions');
                    Route::post('store/permission', [RoleController::class, 'savePermission'])->name('savePermission');
                    Route::post('delete/permission/{id}',[RoleController::class, 'deletePermission']);
                    Route::post('delete/role/{id}',[RoleController::class, 'deleteRole']);
                    Route::resource('roles', RoleController::class);
                    Route::get('master/holidays',[MasterHolidayController::class, 'index']);
                    Route::post('save/holiday', [MasterHolidayController::class, 'storeHoliday']); 
                    Route::post('delete/holiday', [MasterHolidayController::class, 'deleteHoliday']);
            }); 
        //role routes end here
    });
