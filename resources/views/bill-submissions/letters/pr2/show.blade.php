<!-- @extends('layouts.home-app')-->
<style>
    .provider_heading_type {
        color: #858585;
        font-size: 14px;
        font-weight: 300;
        margin: -9px 0 10px;
    }

    .provider_heading {
        align-items: center;
        color: #3a3a3a;
        display: flex;
        font-size: 18px;
        font-weight: 600;
        line-height: normal;
        margin: 0;
        padding: 11px 0 9px;
    }

    .showImgaeInBack {
        background-image: url('/new_assets/app-assets/images/form-1500.jpg');
        background-size: auto 100%;
        background-repeat: no-repeat;
        background-position: left top;
    }

    #loadingForm {
        height: 1492px;
        width: 1153px;
    }

    #tdcontent td {
        font: Arial, Helvetica, sans-serif;
        font-size: 18px
    }
</style>

@section('content')
    <div class="row">
        <div class="col-1 mt-4"></div>
        <div class="col-10 mt-4">

            <div class="card row-background">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading"> Show Referring and Ordering Providers</h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ url('/injury/view', $pInjuries->id) }}"> Back</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <div style="border="1" bordercolor="#000000"" class="demand" align="justify" id="exportContent">
                    <div align="center">

                        <span style="font-size:16px; font-family:Arial Black; font-weight:bold";> PRIMARY TREATING
                            PHYSICIAN'S PROGRESS REPORT ADDENDUM </span><br>
                        <span style="font-size:12px; font-family:Times New Roman";><i> Any Information not provided in this
                                report, please refer to the last report submitted </i></span><br><br>
                    </div>
                    <form action="#" method="post" name="frm">
                        <table align="center" width="900px" border="1" bordercolor="#000000"
                            style="border-bottom-style:outset">
                            <input type="hidden" name="pt_id" id="pt_id" value="Testing" />
                            <tr>
                                <td colspan="2" style="padding-left:5px">
                                    <input type="checkbox" style="width:16px; height:16px" name="yes" value="yes">
                                    Prescription/Authorization Request for DME
                                    <span style="padding-left:50px"><input type="checkbox" style="width:16px; height:16px"
                                            name="yes" value="yes"> Prescription/Authorization Request for Treatment
                                    </span><br>
                                    <input type="checkbox" style="width:16px; height:16px" name="yes" value="yes">
                                    Other:
                                </td>
                            </tr>
                        </table>

                        <table align="center" width="900px">

                            <br>
                            <tr>
                                <td width="400px" style="padding-left:5px"> Patient :<label class="label"
                                        name="patientname" style="margin-left:12px">
                                        Testing
                                    </label>
                                    <hr style="margin-left:60px; margin-top:0; margin-bottom:5px" width="350px">

                                </td>

                                <td width="230px" style="padding-left:5px">Sex :<label class="label" name="patientname"
                                        style="margin-left:8px">
                                        Testing </label>
                                    <hr style="margin-left:40px; margin-top:0; margin-bottom:5px" width="200px">
                                </td>

                                <td width="230px" style="padding-left:5px">DOB :<label class="label" name="patientname"
                                        style="margin-left:5px">
                                        Testing </label>
                                    <hr style="margin-left:40px; margin-top:0; margin-bottom:5px;" width="160px">
                                </td>

                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">Address :<label class="label"
                                        name="patientname" style="margin-left:5px">
                                        Testing </label>
                                    <hr style="margin-left:60px; margin-top:0; margin-bottom:5px" width="350px">
                                </td>

                                <td colspan="2" width="400px" style="padding-left:5px">SSN :<label class="label"
                                        name="patientname" style="margin-left:5px">
                                        Testing </label>
                                    <hr style="margin-left:40px; margin-top:0; margin-bottom:5px" width="405px">
                                </td>

                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">City :<label class="label" name="patientname"
                                        style="margin-left:25px">
                                        Testing </label>
                                    <hr style="margin-left:60px; margin-top:0; margin-bottom:5px" width="350px">
                                </td>

                                <td width="230px" style="padding-left:5px">State :<label class="label" name="patientname"
                                        style="margin-left:5px">
                                        Testing</label>
                                    <hr style="margin-left:40px; margin-top:0; margin-bottom:5px" width="200px">
                                </td>

                                <td width="230px" style="padding-left:5px">Zip :<label class="label"
                                        name="patientname" style="margin-left:5px">
                                        Testing</label>
                                    <hr style="margin-left:30px; margin-top:0; margin-bottom:5px" width="170px">
                                </td>

                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">HM :<label class="label" name="patientname"
                                        style="margin-left:5px">
                                        Testing </label>
                                    <hr style="margin-left:60px; margin-top:0; margin-bottom:5px" width="350px">
                                </td>

                                <td colspan="2" width="400px" style="padding-left:5px"> WK # :<label class="label"
                                        name="patientname" style="margin-left:5px">
                                    </label>
                                    <hr style="margin-left:40px; margin-top:0; margin-bottom:5px" width="405px">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <hr style="margin-top:10px; margin-bottom:10px; border:outset; border-color:#CCC !important";
                                        width="900px">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3" width="900px" style="padding-left:5px"> Primary Ins. Co. <label
                                        class="label" name="patientname" style="margin-left:5px">
                                        Testing </label>
                                    <hr style="margin-left:100px; margin-top:0; margin-bottom:5px" width="767px">
                                </td>
                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">Address :<label class="label"
                                        name="patientname" style="margin-left:2px">
                                        Testing</label>
                                    <hr style="margin-left:60px; margin-top:0; margin-bottom:5px" width="350px">
                                </td>

                                <td width="230px" style="padding-left:5px">DOI :<label class="label"
                                        name="patientname" style="margin-left:8px">
                                        Testing </label>
                                    <hr style="margin-left:30px; margin-top:0; margin-bottom:5px" width="210px">
                                </td>

                                <td width="230px" style="padding-left:5px"><label class="label" name="patientname"
                                        style="margin-left:5px">
                                    </label>
                                    <hr style="margin-left:30px; margin-top:0; margin-bottom:5px" width="170px">
                                </td>

                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">City :<label class="label"
                                        name="patientname" style="margin-left:25px">
                                        Testing</label>
                                    <hr style="margin-left:60px; margin-top:0; margin-bottom:5px" width="350px">
                                </td>

                                <td width="230px" style="padding-left:5px">State :<label class="label"
                                        name="patientname" style="margin-left:5px">
                                        Testing </label>
                                    <hr style="margin-left:40px; margin-top:0; margin-bottom:5px" width="200px">
                                </td>

                                <td width="230px" style="padding-left:5px">Zip :<label class="label"
                                        name="patientname" style="margin-left:5px">
                                        Testing </label>
                                    <hr style="margin-left:30px; margin-top:0; margin-bottom:5px" width="170px">
                                </td>

                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">Adjuster :<label class="label"
                                        name="patientname" style="margin-left:0px">
                                        Testing </label>
                                    <hr style="margin-left:60px; margin-top:0; margin-bottom:5px" width="350px">
                                </td>

                                <td colspan="2" width="400px" style="padding-left:5px">Phone #<label class="label"
                                        name="patientname" style="margin-left:0px">
                                        Testing</label>
                                    <hr style="margin-left:40px; margin-top:0; margin-bottom:5px" width="405px">
                                </td>

                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">Claim # : <label class="label"
                                        name="patientname" style="margin-left:5px">
                                        Testing </label>
                                    <hr style="margin-left:60px; margin-top:0; margin-bottom:5px" width="350px">
                                </td>

                                <td colspan="2" width="400px" style="padding-left:5px">Fax # : <label class="label"
                                        name="patientname" style="margin-left:5px">
                                        Testing </label>
                                    <hr style="margin-left:40px; margin-top:0; margin-bottom:5px" width="405px">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <hr style="margin-top:10px; margin-bottom:10px; border:outset; border-color:#CCC !important";
                                        width="900px">
                                </td>
                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">Employer : <b><input type="text"
                                            name="employer" value="Testing"
                                            style="width:339px; margin-left:1px; margin-bottom:3px;"></b>
                                </td>

                                <td colspan="2" width="400px" style="padding-left:5px">Phone #: <b><input
                                            type="text" name="emp_phone" value="Testing" style="width:392px"></b>

                                </td>

                            </tr><br><br>

                            <tr>
                                <td width="400px" style="padding-left:5px">Address : &nbsp;&nbsp;&nbsp;<b><input
                                            type="text" name="emp_address"
                                            value="Testing		
                     "style="width:339px; margin-bottom:3px"></b>

                                </td>

                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">City : &nbsp;&nbsp; <b><input type="text"
                                            name="emp_city" value="Testing" style="width:339px; margin-left:23px"></b>

                                </td>

                                <td width="230px" style="padding-left:5px">State : <b><input type="text"
                                            name="emp_state" value="Testing" style="width:182px; margin-left:14px"></b>

                                </td>

                                <td width="230px" style="padding-left:5px">Zip : <b><input type="text"
                                            name="emp_zip" value="Testing" style="width:171px"></b>

                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <hr style="margin-top:10px; margin-bottom:10px; border:outset; border-color:#CCC !important";
                                        width="900px">
                                </td>
                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">Attorney : <b><input type="text"
                                            name="attorney" value="Testing"
                                            style="width:339px; margin-left:7px; margin-bottom:3px"></b>

                                </td>

                                <td colspan="2" width="400px" style="padding-left:5px">Phone #: <b><input
                                            type="text" name="phone" value="Testing" style="width:392px"></b>

                                </td>

                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">Address : &nbsp;<b><input type="text"
                                            name="address" value="Testing"
                                            style="width:339px; margin-left:7px; margin-bottom:3px"></b>

                                </td>
                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">City : &nbsp;<b><input type="text"
                                            name="city" value="Testing" style="width:339px; margin-left:31px"></b>

                                </td>

                                <td width="230px" style="padding-left:5px">State : <b><input type="text"
                                            name="state" value="Testing" style="width:182px; margin-left:14px"></b>

                                </td>

                                <td width="230px" style="padding-left:5px">Zip : <b><input type="text"
                                            name="zip" value="Testing" style="width:171px"></b>

                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <hr style="margin-top:10px; margin-bottom:10px; border-top-width:4px; border-color:#000 !important";
                                        width="900px">
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-family:Times New Roman; font-weight:bold; font-size:18px">
                                    DIAGNOSIS</td>
                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">1. <b><input type="text"
                                            name="diagnosis1" value="Testing" style="width:390px"></b>
                                    <hr style="margin-left:15px; margin-top:0; margin-bottom:5px" width="390px">
                                </td>

                                <td colspan="2" width="230px" style="padding-left:5px">ICD-10 :<label class="label"
                                        name="patientname" style="margin-left:8px">
                                    </label>
                                    <hr style="margin-left:50px; margin-top:0; margin-bottom:5px" width="390px">
                            </tr>

                            <tr>
                                <td width="400px" style="padding-left:5px">2. <b><input type="text"
                                            name="diagnosis2" value="Testing" style="width:390px"></b>
                                    <hr style="margin-left:15px; margin-top:0; margin-bottom:5px" width="390px">
                                </td>

                                <td colspan="2" width="230px" style="padding-left:5px">ICD-10 :<label class="label"
                                        name="patientname" style="margin-left:8px">
                                    </label>
                                    <hr style="margin-left:50px; margin-top:0; margin-bottom:5px" width="390px">
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <hr style="margin-top:10px; margin-bottom:10px; border-top-width:4px; border-color:#000 !important";
                                        width="900px">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3" align="left"
                                    style="font-family:Times New Roman; font-weight:bold; font-size:18px">SUBJECTIVE
                                    COMPLAINTS/ OBJECTIVE FINDINGS</td>
                            </tr>

                            <tr>
                                <td colspan="3" style="padding-left:5px">
                                    <input type="checkbox" style="width:16px; height:16px;" name="1"
                                        value="yes"> Patient is scheduled for surgery
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <input type="checkbox" style="width:16px; height:16px;" name="2"
                                        value="yes"> Patient exhibits signs of swelling
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <input type="checkbox" style="width:16px; height:16px;" name="3"
                                        value="yes"> Patient exhibits impaired Range of Motion
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3" style="padding-left:5px">
                                    <input type="checkbox" style="width:16px; height:16px;" name="1"
                                        value="yes"> Patient exhibits loss of Strength
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <input type="checkbox" style="width:16px; height:16px;" name="2"
                                        value="yes"> Patient complains of Pain
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <input type="checkbox" style="width:16px; height:16px;" name="3"
                                        value="yes">
                                    <label class="label" name="patientname" style="margin-left:5px"> </label>
                                    <hr style="margin-left:530px; margin-top:-5px; margin-bottom:5px" width="255px">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <hr style="margin-top:10px; margin-bottom:10px; border-top-width:4px; border-color:#000 !important";
                                        width="900px">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3" align="left"
                                    style="font-family:Times New Roman; font-weight:bold; font-size:18px">TREATMENT PLAN
                                    AND AUTHORIZATION REQUEST (in addition to current treatment plan)</td>
                            </tr>

                            <tr>
                                <td><input type="checkbox" style="width:16px; height:16px;" name="3"
                                        value="yes"> DO NOT SUBSTITUTE</td>
                            </tr>

                            <table align="center" width="900px" border="1" bordercolor="#000000"
                                style="border-bottom-style:outset">

                                <tr>
                                    <td colspan="2" valign="top">
                                        <textarea name="dme_des" rows="20" cols="111">Testing</textarea>
                                    </td>
                                </tr>
                            </table>

                            <table align="center" width="900px">
                                <tr>
                                    <td align="left"
                                        style="font-family:'Times New Roman', Times, serif; font-size:18px; font-weight:bold">
                                        TREATMENT GOALS :</td>
                                </tr>
                                <tr>
                                    <td width="400px"> 1. To reduce or eliminate pain </td>
                                    <td width="400px"> 4. Improve range of motion </td>

                                </tr>
                                <tr>
                                    <td width="400px"> 2. To reduce or eliminate edema </td>
                                    <td width="400px"> 5. Protect the surgical repair </td>

                                </tr>
                                <tr>
                                    <td width="400px"> 3. Improve activities of daily living </td>
                                    <td width="400px"> 6.
                                        <hr style="margin-left:15px; margin-top:-4px; margin-bottom:15px" width="500px">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p> <br> The treatment plan as described above is both reasonable and medically
                                            necessary. Not using these devices can have traumatic results and diminish the
                                            likelihood of recovery. ACOEM and ODG support the use of medical devices at the
                                            home and state so in several chapters of both guidelines. ACOEM also
                                            specifically states, "ACOEM develops and publishes these guidelines to promote
                                            health of injured workers. ACOEM does not publish the Practice Guidelines in
                                            order to rigidly mandate treatments and, in fact, the guidelines fully
                                            acknowledge that in some cases alternative treatments outside the recommended
                                            course of action may be warranted. It is important to re-emphasize that the
                                            ACOEM Practice Guidelines are not intended to be used to deny patients care or
                                            reimbursement. Each patient is unique and cases must be handled on an individual
                                            basis." (Hegmann, Editor-in-Chief 2008) Therefore, it is my opinion that these
                                            devices are medically necessary and should be provided. Furthermore, in order to
                                            obtain maximum results, the patient should be instructed on the proper use of
                                            these devices in a one on one setting by a manufacturers approved representative
                                            that speaks and understands the patient's primary language. It is also necessary
                                            to provide follow up with the patient to ensure compliance. </p><br>
                                    </td>

                                </tr><br>
                                <tr>
                                    <td colspan="2">
                                        <span
                                            style="font-family:'Times New Roman', Times, serif; font-weight:bold; font-size:18px"><b>
                                                WORK STATUS </b></span>
                                        <span style="padding-left:100px"> Remain off work </span>
                                        <span style="padding-left:100px"> Return to modified work </span>
                                        <span style="padding-left:100px"> Return to full duty </span>

                                </tr>
                                <tr>
                                    <td align="left"
                                        style="font-family:'Times New Roman', Times, serif; font-size:15px; font-weight:bold">
                                        PRIMARY TREATING PHYSICIAN :</td>
                                </tr>
                                <tr>
                                    <table align="center">
                                        <tr>
                                            <td width="300px">Address
                                                <hr style="margin-left:55px; margin-top:0; margin-bottom:5px"
                                                    width="250px">
                                            </td>

                                            <td width="300px">City
                                                <hr style="margin-left:30px; margin-top:0; margin-bottom:5px"
                                                    width="250px">
                                            </td>
                                            <td width="150px">State
                                                <hr style="margin-left:30px; margin-top:0; margin-bottom:5px"
                                                    width="120px">
                                            </td>
                                            <td width="150px">Zip
                                                <hr style="margin-left:30px; margin-top:0; margin-bottom:5px"
                                                    width="100px">
                                            </td>

                                        </tr>

                                        <tr>
                                            <td width="300px">Phone
                                                <hr style="margin-left:55px; margin-top:0; margin-bottom:5px"
                                                    width="250px">
                                            </td>

                                            <td width="300px">Fax
                                                <hr style="margin-left:30px; margin-top:0; margin-bottom:5px"
                                                    width="250px">
                                            </td>

                                        </tr>
                                        <table align="center" width="900px" border="1" bordercolor="#000000"
                                            style="border-bottom-style:outset">
                                            <tr>
                                                <td style="padding-left:2px"> Name: <label class="label">Testing</label>
                                                </td>
                                                <td style="padding-left:2px"> Specialty: <label
                                                        class="label">Testing</label> </td>
                                                <td style="padding-left:2px"> Lic. # <label class="label">Testing</label>
                                                </td>
                                            </tr>
                                        </table><br>
                                        <table align="center">
                                            <tr>
                                                <td>Signature
                                                    <hr style="margin-left:55px; margin-top:-4px; margin-bottom:15px"
                                                        width="630px">
                                                </td>
                                                <td> Date
                                                    <hr style="margin-left:15px; margin-top:-4px; margin-bottom:15px"
                                                        width="190px">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" align="center"><input type="submit" name="btnSend"
                                                        value="submit"></td>

                                            </tr>
                                        </table>

                                    </table>

                                </tr>
                            </table>
                        </table>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-1 mt-4"></div>
    </div>
@endsection
