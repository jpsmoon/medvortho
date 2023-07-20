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
                    <div class="row">
                        <div class="col-2 mt-4"></div>
                        <div class="col-8 mt-4">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-8 col-sm-8 col-xs-8">&nbsp;</div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">

                                        <i class="fa fa-file-word-o" onClick="saveDoc()"></i>&nbsp;
                                        <i class="fa fa-print" onClick="genratePrint();"></i>&nbsp;
                                        <i class="fa fa-pencil-square-o" onClick="div_show();"></i>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div class="demand" align="justify" id="exportContent">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div align="center">
                                                    <font face="Century Gothic"; size="+2"> Progressive Orthopedic
                                                        Solutions, LLC. </font><br>
                                                    <font face="Century Gothic";><b>PO BOX 2906, SANTA FE SPRINGS CA
                                                            90670-6043</b></font><br>
                                                    <font face="Century Gothic";>(877)285-2686-PHONE, (877) 318-9686-FAX
                                                    </font>
                                                    <div style="margin-top:-16px;">
                                                        ___________________________________________________________________________________________________________________________
                                                    </div><br>
                                                    <font face="Century Gothic"; size="+2"><b><u>CORRECTED BILLING/VOID
                                                                OF ORIGINAL</u></b></font>
                                                </div><br><br>
                                            </div>
                                        </div>

                                        <table style="font-family:Century Gothic; font-size:15px">
                                            <tr>
                                                <td>INSURANCE NAME</td>
                                                <td style="padding-left:10px">:</td>
                                                <td style="padding-left:10px">Testing</td>
                                            </tr>

                                            <tr>
                                                <td>ADDRESS</td>
                                                <td style="padding-left:10px">:</td>
                                                <td style="padding-left:10px">Testing</td>
                                            </tr>

                                            <tr>
                                                <td>FAX</td>
                                                <td style="padding-left:10px">:</td>
                                                <td style="padding-left:10px">Testing</td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px; padding-top:18px; font-weight:bold">PROVIDER:
                                                </td>
                                                <td style="padding-left:10px">:</td>
                                                <td style="padding-left:10px; font-size:16px; font-weight:bold">PROGRESSIVE
                                                    ORTHOPEDIC SOLUTIONS; TAX ID: 20-8889991</td>
                                            </tr>

                                            <tr>
                                                <td style="padding-top:12px;">PATIENT NAME</td>
                                                <td style="padding-left:10px">:</td>
                                                <td style="padding-left:10px">
                                                    Testing</td>
                                            </tr>

                                            <tr>
                                                <td>CLAIM #</td>
                                                <td style="padding-left:10px">:</td>
                                                <td style="padding-left:10px">Testing</td>
                                            </tr>

                                            <tr>
                                                <td>Date of Services (S)</td>
                                                <td style="padding-left:10px">:</td>
                                                <td style="padding-left:10px">Testing</td>
                                            </tr>

                                            <tr>
                                                <td>BALANCE AMOUNT</td>
                                                <td style="padding-left:10px">:</td>

                                                <td style="padding-left:10px"> Testing</td>
                                            </tr>
                                        </table><br>

                                        <p style="font-family:Century Gothic; font-size:16px">To whom it may
                                            concern:–<br><br>

                                            Please be advised this office was retained by the above provider to recover
                                            moneys owed to them for claims previously submitted by this office on their
                                            behalf.<br><br>

                                            This letter will serve as notice that penalties and interest are now owed on the
                                            attached billing, due to your failure to comply with 4603.2 (b). The Labor Code
                                            states that an employer has either 30 days from the day of receiving itemization
                                            to properly object in writing to the medical bills or has 45 working days to
                                            issue payment from the day that the bill was received. Furthermore, the LC
                                            4603.2 (b) points out that a 15% penalty increase will be applied along with a
                                            10% interest on the time accrued of the overdue payment.<br><br>

                                            Please be advised we are accordingly demanding the full OMFS amount be paid
                                            along with the accrued penalty and interest. If you decide to litigate this case
                                            without any valid objection, be aware this office will request sanctions at the
                                            time of hearing for unreasonable delay as per LC 5814 and for your bad faith
                                            actions as per LC 5813.<br><br>

                                            Immediate payment is expected. I sincerely hope we can resolve this matter
                                            without being compelled to taking up the courts' time.<br><br>

                                            Thank you, <br><br>

                                            Austin Pathak<br>
                                            Billing Department<br>
                                            <b>Ph: (877) 285-2686 x 472, Fax (877) 318-9686 </b><br>
                                            <b>Email: austin.pathak@gmail.com <br><br>

                                                Additional information enclosed with this letter: </b><br><br>

                                            <input type="checkbox"> Health Insurance Claim Form (CMS-1500)<br>
                                            <input type="checkbox"> Authorization for Service/RFA<br>
                                            <input type="checkbox"> Prescription for DME<br>
                                            <input type="checkbox"> Delivery Ticket<br>
                                            <input type="checkbox"> Purchase Invoice for Miscellaneous HCPCS E1399
                                        </p><br>
                                        <hr style="border-bottom:#000 groove; margin: 15px -120px;">
                                        </hr>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div align="center"><br>
                                                    <font face="Century Gothic" size="+2";> Progressive Orthopedic
                                                        Solutions, LLC. </font><br>
                                                    <font face="Century Gothic";><b>PO BOX 2906, SANTA FE SPRINGS CA
                                                            90670-6043</b></font><br>
                                                    <font face="Century Gothic";>(877)285-2686-PHONE, (877) 318-9686-FAX
                                                    </font>
                                                    <div style="margin-top:-16px;">
                                                        ___________________________________________________________________________________________________________________________
                                                    </div><br>

                                                    <font face="Century Gothic";><b>PROOF OF SERVICE (Second Submission)<br>

                                                            On 31 July 2019, I served the foregoing documents described as:
                                                            <br>

                                                            PAST DUE BILLING RESUBMISSION, HCFA, PRESCRIPTION, PROOF OF
                                                            SERVICE </b></font><br><br>

                                                    <p align="left" style="font-family:Century Gothic; font-size:16px">[ ]
                                                        BY MAIL: In this action I have placed a true copy enclosed in an
                                                        envelope with postage thereon fully prepaid in the United States and
                                                        mailed to Addressed: <br><br>

                                                        [X] BY FACSIMILE TRANSMISSION: From Fax (877) 318-9686 to the fax
                                                        number .......... Claims the facsimile machine I used complied with
                                                        Rule 2003 (3) and no error was reported by the machine. I caused the
                                                        machine to print a record of the transaction.<br><br>

                                                        I am readily familiar with the practice of collection and processing
                                                        correspondence for mailing. Under that practice, it would be
                                                        deposited with the United States Postal Service on the same day with
                                                        postage thereon fully prepaid at 01 September 2015 in the ordinary
                                                        course of business. I am aware that on motion of the party served,
                                                        service is presumed invalid if postage cancellation date or postage
                                                        meter date on the envelope is more than one day after the date for
                                                        mailing contained in this affidavit.<br><br>

                                                        <b>Sincerely,<br>
                                                            <img src="../images/Apathak.jpg"><br>
                                                            Austin Pathak </b>
                                                    </p><br><br>

                                                </div><br><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-2 mt-4"></div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-1 mt-4"></div>
    </div>
@endsection
