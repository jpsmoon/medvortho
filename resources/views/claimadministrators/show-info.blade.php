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
                            @if($claim)
                            <div class="tab" role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active show"><a href="#SectionMain_{{$claim->id}}" aria-controls="main"
                                            role="tab" data-toggle="tab">Main</a></li>
                                    <li role="presentation"><a href="#SectionBill_{{$claim->id}}" aria-controls="bill-review"
                                            role="tab" data-toggle="tab">Bill Review</a></li>
                                    <li role="presentation"><a href="#SectionAuthorised_{{$claim->id}}" aria-controls="authorization-info"
                                            role="tab" data-toggle="tab">Authorization Info</a></li>
                                    <li role="presentation"><a href="#SectionMAilling_{{$claim->id}}" aria-controls="mailing-address"
                                            role="tab" data-toggle="tab">Mailing Addres</a></li>
                                    <li role="presentation"><a href="#SectionClaim_{{$claim->id}}" aria-controls="claim-number-pattern"
                                            role="tab" data-toggle="tab">Claim Number Pattern</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabs">
                                    <div role="tabpanel" class="tab-pane fade in active show" id="SectionMain_{{$claim->id}}"> 
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{$claim->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Payer</td>
                                                    <td>Not Listed</td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td>{{ $claim->description}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Type</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>daisyBill Payer ID</td>
                                                    <td>{{ $claim->payer_id}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Website</td>
                                                    <td>
                                                    <a target="_blank" rel="noopener noreferrer" href="{{ $claim->website}}">{{ $claim->website}}</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Also Known As</td>
                                                    <td>{{ $claim->alias}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Affiliated Entities</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>Hours of Operation</td>
                                                    <td>{{ $claim->start_time}} - {{ $claim->end_time}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Telephone Numbers</td>
                                                    <td>
                                                        <li>Main: (866) 482-3535</li>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Email Addresses</td>
                                                    <td>
                                                        <li>
                                                        Claim Inquiries: 
                                                        <a href="mailto:info@athensadmin.com">info@athensadmin.com</a>
                                                        </li>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Web Portals</td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Bill Processing Workflow</td>
                                                    <td><p>Entity receives bills and forwards to Third Party Bill Review</p></td>
                                                </tr>
                                                <tr>
                                                    <td>Bill Processing Workflow Notes</td>
                                                    <td><p></p></td>
                                                </tr>
                                                <tr>
                                                    <td>Claim Number Hint</td>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="SectionBill_{{$claim->id}}">
                                        <h3>SecKtion 2</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna
                                            a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in
                                            tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius.</p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="SectionAuthorised_{{$claim->id}}">
                                        <h3>SecKtion 3</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna
                                            a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in
                                            tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius.</p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="SectionMAilling_{{$claim->id}}">
                                        <h3>SecKtion 4</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna
                                            a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in
                                            tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius.</p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="SectionClaim_{{$claim->id}}">
                                        <h3>SecKtion 5 child file</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna
                                            a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in
                                            tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius.</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <!--Grid column-->
