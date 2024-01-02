function getGetCityList(val){
    //alert(val);
    $.ajax({
        url: '/get-cities-by-state',
            type: 'POST',
            data: {
            _token: token, state_id:val
            },
            success: function(response) {
               // console.log('response',response.cities);
                var items = "";
                $.each(response.cities, function (i, item) {
                    items += `<option value="${item.id}">${item.city_name}</option>`;
                })
                $("#cityDD").html(items);
            },
            error: function(response) {
                alert(response.responseJSON.message);
            }
        });
}
//for maskin
function applyDataMask(field) {
    var mask = field.dataset.mask.split('');

    // For now, this just strips everything that's not a number
    function stripMask(maskedData) {
        function isDigit(char) {
            return /\d/.test(char);
        }
        return maskedData.split('').filter(isDigit);
    }

    // Replace `_` characters with characters from `data`
    function applyMask(data) {
        return mask.map(function(char) {
            if (char != '_') return char;
            if (data.length == 0) return char;
            return data.shift();
        }).join('')
    }

    function reapplyMask(data) {
        return applyMask(stripMask(data));
    }

    function changed() {
        var oldStart = field.selectionStart;
        var oldEnd = field.selectionEnd;

        field.value = reapplyMask(field.value);

        field.selectionStart = oldStart;
        field.selectionEnd = oldEnd;
    }

    field.addEventListener('click', changed)
    field.addEventListener('keyup', changed)
}
function getStatesByZipCode(val){
 //alert(val);
 $.ajax({
    url: '/get-cities-state-by-zipCode',
        type: 'POST',
        data: {
        _token: token, zipCode:val
        },
        success: function(response) {
           console.log('response',response);
           $("#cityDD").val(response.city_name);
                var dd = document.getElementById('stateDD');
                for (var i = 0; i < dd.options.length; i++) {
                    if (dd.options[i].text === response.state_name) {
                        dd.selectedIndex = i;
                        break;
                    }else{
                        dd.selectedIndex =  null
                    }
                }
        },
        error: function(response) {
            alert(response.responseJSON.message);
        }
    });
}
function getStateByCountry(val){
    //alert(val);
    $.ajax({
        url: '/get-state-by-country',
            type: 'POST',
            data: {
            _token: token, country_id:val
            },
            success: function(response) {
               // console.log('response',response.cities);
                var items = "";
                $.each(response.states, function (i, item) {
                    items += `<option value="${item.state_code}">${item.state_name}</option>`;
                })
                $("#stateDD").html(items);
            },
            error: function(response) {
                alert(response.responseJSON.message);
            }
        });
}




function getGetCityBySTateCOde(val,divId){
    //alert(val);
    $.ajax({
        url: '/get-cities-by-state-code',
            type: 'POST',
            data: {
            _token: token, state_name:val
            },
            success: function(response) {
                //console.log('response#',response);
               console.log('response',response.cities);
                var items = "";
                $("#"+divId).html(" ");
                $.each(response.cities, function (i, item) {
                    items += `<option value="${item.id}">${item.city_name}</option>`;
                })
                $("#"+divId).html(items);
            },
            error: function(response) {
                alert(response.responseJSON.message);
            }
        });
}

function getReferningProvider(type,injuryId,divId,columDiv){
   // alert(type);
   $.ajax({
        url: '/get-referning-providers',
        type: 'POST',
        data: {
        _token: token, type:type, injuryId:injuryId,
        },
        success: function(response) {
            if(response) {
                var items = "";
                $("#" + columDiv + ' input[name="bill_provider_type[]"]').val(type);
                if($("#"+columDiv).hasClass("d-none")){
                    $("#"+columDiv).removeClass("d-none");
                }
                else{
                    $("#"+columDiv).addClass("d-none");
                }

                $("#"+divId).html(" ");
                $.each(response, function (i, item) {
                    items += `<option value="${item.id}">${item.referring_provider_first_name} ${item.referring_provider_last_name}</option>`;
                })
                $("#"+divId).html(items);
            }
        },
        error: function(response) {
            alert(response.responseJSON.message);
        }
    });
}

function getBillingInfoForView(val,divId, hideDivId){
    $.ajax({
        url: '/get-billing-info-view',
            type: 'POST',
            data: {
            _token: token, billingId:val
            },
            success: function(response) {
               console.log('response##',response.professional_provider_name);
               $("#"+hideDivId).addClass('d-none');
                var items = "";
                $("#"+divId).html(" ");
                 items += `<div class="card-body2"><ul class="list-group list-group-flush rightBox"><li class="list-group-item"> <div class="card2"> <div class="card-header2"><div class="row"><div class="col-12 padB05"><h4 class="card-title"> ${response.professional_provider_name} </h4> <span>Billing Provider</span></div><div class="col-12"><ul class="list-inline"><li class="list-inline-item liItem">Tax ID <br> <span class="card-title">${response['tax_id']}</span></li> <li class="list-inline-item liItem">NPI <br>  <span class="card-title">${response['professional_npi']}</span>  </li></ul></div></div></div></li></ul></div>`;
                $("#"+divId).html(items);
            },
            error: function(response) {
                alert(items.responseJSON.message);
            }
        });
}

function californiaStateByCountry(val){
    //alert(val);
    $.ajax({
        url: '/get-state-by-country',
            type: 'POST',
            data: {
            _token: token, country_id:val
            },
            success: function(response) {
               // console.log('response',response.cities);
                var items = "";
                $.each(response.states, function (i, item) {
                    //items += `<option value="${item.state_code}"  (${item.state_code} == 'CA') ? 'selected' : ''>${item.state_name}</option>`;
                    items += `<option value="${item.state_code}" ${item.state_code === 'CA' ? 'selected' : ''}>${item.state_name}</option>`;
                })
                $("#stateDD").html(items);
            },
            error: function(response) {
                alert(response.responseJSON.message);
            }
        });
}

//bill Posting Function start here

function changeUrl(billId, type, paymentId){
    console.log('billId', billId);
    console.log('type', type);
    console.log('paymentId', paymentId);
    var fullUrl = ''; 
    fullUrl ="/bill/payment/postings/new/" + type + "/" + billId;
    //if(paymentId !== undefined || paymentId != null){ } 
    let _url = "/remove/all/payment/data/change/tab";
    $.ajax({
        url: _url,
        type: 'POST',
        data: {_token:token, billId: billId, paymentId: paymentId},
        success: function(response) {
            console.log('response', response);
            if(response){ 
                window.location.href=fullUrl;
            } 
        },
        error: function(response) {
            swal.fire(response.responseJSON.message, '', 'error');
        }
    }); 
}
