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

function getBillingInfoForView(val,divId){
    $.ajax({
        url: '/get-billing-info-view',
            type: 'POST',
            data: {
            _token: token, billingId:val
            },
            success: function(response) {
               console.log('response',response.professional_provider_name);
                var items = "";
                $("#"+divId).html(" ");
                items += `<div class="mb-0"> <h6 class="mb-0"> <a class="redial-dark d-block border redial-border-light"><i class="fa-solid fa-file-invoice-dollar"></i>
                Billing Provider </a> </h6> <div id="" class=" setCollapseBorder" role="tabpanel"><div class="card-body">
                <span  class="font-weight-bold pr-1">Name :</span><span class="text-muted font-weight-bold">${response.professional_provider_name}</span><br/><br/>
                <span  class="font-weight-bold pr-1">Tax ID :</span><span class="text-muted font-weight-bold">${response['tax_id']}</span><br/><br/>
                <span  class="font-weight-bold pr-1">NPI :</span><span class="text-muted font-weight-bold">${response['professional_npi']}</span><br/><br/>
                </div></div> </div>`;
                $("#"+divId).html(items);
            },
            error: function(response) {
                alert(items.responseJSON.message);
            }
        });
}


