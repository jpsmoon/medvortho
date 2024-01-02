                        <style type="text/css">
                            a:hover,
                            a:focus {
                                text-decoration: none;
                                outline: none;
                            }

                            .tab {
                                font-family: 'Montserrat', sans-serif;
                                padding: 0;
                                margin: 0;
                            }

                            .tab .nav-tabs {
                                margin: 0;
                                border: none;
                                position: relative;
                            }

                            .tab .nav-tabs li a {
                                color: #fff;
                                background-color: #ce5016;
                                font-size: 17px;
                                font-weight: 600;
                                letter-spacing: 0.5px;
                                text-align: center;
                                text-transform: capitalize;
                                padding: 5px 8px;
                                margin: 0 10px 10px 0;
                                border-radius: 0;
                                border: none;
                                display: block;
                                overflow: hidden;
                                position: relative;
                                z-index: 1;
                                transition: all 0.3s ease 0s;
                            }

                            .tab .nav-tabs li.active a,
                            .tab .nav-tabs li a:hover,
                            .tab .nav-tabs li.active a:hover {
                                color: #fff;
                                background-color: #ce5016;
                                border: none;
                            }

                            .tab .nav-tabs li a:before,
                            .tab .nav-tabs li a:after {
                                content: '';
                                background-color: #963207;
                                height: 100%;
                                width: 7px;
                                position: absolute;
                                left: 0;
                                top: -100%;
                                z-index: -1;
                                transition: all 0.3s;
                            }

                            .tab .nav-tabs li a:after {
                                left: auto;
                                right: -50%;
                                width: 50%;
                                clip-path: polygon(20% 0%, 100% 0, 100% 100%, 0% 100%);
                                transition: all 0.3s;
                            }

                            .tab .nav-tabs li.active a:before,
                            .tab .nav-tabs li a:hover:before,
                            .tab .nav-tabs li.active a:after,
                            .tab .nav-tabs li a:hover:after {
                                top: 0;
                            }

                            .tab .nav-tabs li.active a:after,
                            .tab .nav-tabs li a:hover:after {
                                right: 0;
                            }

                            .tab .tab-content table {
                                color: #000;
                                font-size: 14px;
                                font-weight: 600;
                                letter-spacing: 0.5px;
                                line-height: 25px;
                            }

                            @media only screen and (max-width: 479px) {
                                .tab .nav-tabs li {
                                    width: 100%;
                                    text-align: center;
                                }

                                .tab .nav-tabs li a {
                                    margin-right: 0;
                                }
                            }
                        </style>
                        <!--Grid column-->
                        <div class="col-12  col-md-12 mt-3">
                            @if ($claim)
                                <div class="tab" role="tabpanel">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active show"><a
                                                href="#SectionMain_{{ $claim->id }}" aria-controls="main"
                                                role="tab" data-toggle="tab">Main</a></li>
                                        <li role="presentation"><a href="#SectionBill_{{ $claim->id }}"
                                                aria-controls="bill-review" role="tab" data-toggle="tab">Bill
                                                Review</a></li>
                                        <li role="presentation"><a href="#SectionAuthorised_{{ $claim->id }}"
                                                aria-controls="authorization-info" role="tab"
                                                data-toggle="tab">Authorization Info</a></li>
                                        <li role="presentation"><a href="#SectionMAilling_{{ $claim->id }}"
                                                aria-controls="mailing-address" role="tab" data-toggle="tab">Mailing
                                                Addres</a></li>
                                        <li role="presentation"><a href="#SectionClaim_{{ $claim->id }}"
                                                aria-controls="claim-number-pattern" role="tab"
                                                data-toggle="tab">Claim Number Pattern</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabs">
                                        <div role="tabpanel" class="tab-pane fade in active show" id="SectionMain_{{ $claim->id }}">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td> <label for=""> Name </label> </td>
                                                        <td> {{ $claim ? $claim->name : null }} </td>
                                                        <td> <label> Description </label></td>
                                                         <td> {{ $claim ? $claim->description : null }}</td>
                                                    </tr>
                                                    <tr> 
                                                        <td> <label> Type </label> </td>
                                                        <td>{{ ($claim && $claim->getCompanyType && $claim->getCompanyType->name) ? $claim->getCompanyType->name : null }} </td>
                                                        <td> <label>Payer ID </label></td>
                                                        <td> {{ $claim ? $claim->payer_id : null }} </td>
                                                    </tr>
                                                    <tr> 
                                                        <td> <label for="affiliated_entries" >Affiliated Entries </label></td>
                                                        <td> {{ $claim ? $claim->affiliated_entries : null }} </td>
                                                        <td> <label> Website </label></td>
                                                        <td> {{ $claim ? $claim->website : null }} </td>
                                                    </tr>
                                                    <tr> 
                                                        <td> <label> Phone Number </label> </td>
                                                        <td>{{ $claim && $claim->phone_number ? $claim->phone_number : null }} </td>
                                                        <td><label> Start Time </label> </td>
                                                        <td>{{ ($claim->start_time) ? date('h:i A', strtotime($claim->start_time)) : ''}} </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <label> End Time </label> </td>
                                                        <td>{{ ($claim->end_time) ? date('h:i A', strtotime($claim->end_time)) : ''}}</td>
                                                        <td> <label> Time ZOne </label> </td>
                                                        <td>{{$claim->time_zone_type}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td> <label>Clearing House </label> </td>
                                                        <td>{{ $claim ? $claim->clearing_house : null }} </td>
                                                        <td> <label> Fax Number </label> </td>
                                                        <td>{{ $claim && $claim->admin_fax_no ? $claim->admin_fax_no : null }} </td>
                                                    </tr>
                                                    <tr>
                                                       <td> <label> Email ID </label> </td>
                                                        <td>{{ $claim && $claim->email ? $claim->email : null }} </td>
                                                        <td><label> Web Portal</label></td>
                                                        <td>{{ $claim && $claim->bill_portal ? $claim->bill_portal : null }} </td>
                                                    </tr>
                                                    <tr>
                                                         <td><label> Bill Process Flow Note </label> </td>
                                                        <td>{{ ($claim && $claim->bill_process_flow_note) ? $claim->bill_process_flow_note : null }} </td> 
                                                        <td> <label> Address </label> </td>
                                                        <td>{{ $claim ? $claim->admin_address : null }} </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                      <div role="tabpanel" class="tab-pane fade"  id="SectionBill_{{ $claim->id }}">
                                        <div class="form-row">
                                            <div class="form-holder col-md-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <thead>
                                                            <th>Name</th>
                                                            <th>Contact No.</th>
                                                            <th>Website</th>
                                                            <th>Email</th>
                                                            <th>Fax</th>
                                                            <th>Address</th> 
                                                         </thead>
                                                    </tr>
                                                    <tbody>
                                                         @if ($claim->getClaimReview)
                                                            @foreach ($claim->getClaimReview as $bill)
                                                                <tr>
                                                                    <td>{{$bill->name}}</td>
                                                                    <td>{{$bill->contact_no}}</td>
                                                                    <td>{{$bill->website}}</td>
                                                                    <td>{{$bill->email}}</td>
                                                                    <td>{{$bill->fax_no}}</td>
                                                                    <td>{{$bill->address_line1}} - {{$bill->address_line2}}</td> 
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div> 
                                        </div> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade"  id="SectionAuthorised_{{ $claim->id }}">
                                        <div class="form-row">
                                            <div class="form-holder col-md-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <thead>
                                                            <tr>
                                                                <th>RFA Fax No.</th>
                                                                <th>Contact No.</th>
                                                            </tr> 
                                                         </thead>
                                                    </tr>
                                                    <tbody>
                                                         @if ($claim->getClaimAuthContact)
                                                            @foreach ($claim->getClaimAuthContact as $contactInfo)
                                                                <tr>
                                                                    <td>{{$contactInfo->rfa_contact_no}}</td>
                                                                    <td>{{$contactInfo->rfa_fax_no}}</td> 
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div> 
                                        </div> 
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="SectionMAilling_{{ $claim->id }}">
                                        <div class="form-row">
                                            <div class="form-holder col-md-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <thead>
                                                            <tr>
                                                                <th>Company</th>
                                                                <th>Bill Treatment Type</th>
                                                                <th>Bill Submission Type</th>
                                                                <th>Address</th>
                                                                <th>Notes</th>
                                                                <th>Option</th>
                                                            </tr>
                                                         </thead>
                                                    </tr>
                                                    <tbody>
                                                         @if ($claim->getMailAddress)
                                                            @foreach ($claim->getMailAddress as $emailAddress)
                                                                <tr>
                                                                    <td>{{$emailAddress->company_name}}</td>
                                                                    <td>-</td> 
                                                                    <td>-</td> 
                                                                    <td>{{$emailAddress->address_line1}}</td>
                                                                    <td>{{$emailAddress->notes}}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!--Grid column-->
