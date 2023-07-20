$(document).ready(function() {
    $('#countryDD').on('change', function(e) { //console.log(e);
        var country_id = this.value;        
        get_states('stateDD', country_id);
    }); 
    $('#editcountryDD').on('change', function(e) { 
        var country_id = this.value;        
        get_states('editstateDD', country_id);
    }); 
    
    $('#stateDD').on('change', function(e) { 
        var state_id = this.value;
        get_cities('cityDD', state_id);
    });
    $('#editstateDD').on('change', function(e) { 
        var state_id = this.value;
        get_cities('editcityDD', state_id);
    });
    

});

function get_states(toCtrl, id){
    $("#"+toCtrl).html('');
   
    $.ajax({
        url:"/get-states-by-country",           // console.log("{{url('get-states-by-country')}}");
        type: "POST",
        data: {
            country_id: id,
            _token: $('meta[name="csrf-token"]').attr('content')    //'{{csrf_token()}}' 
        },
        dataType : 'json',
        success: function(stresult){ //console.log(stresult);
            $('#'+toCtrl).html('<option value="">Select State</option>'); 
            $.each(stresult.states,function(key,value){
                $("#"+toCtrl).append('<option value="'+value.id+'">'+value.state_name+'</option>');
            });
        }
    });
} 
function get_cities(toCtrl, id){
    $("#"+toCtrl).html('');       
    $.ajax({
        url:"/get-cities-by-state",
        type: "POST",
        data: {
            state_id: id,
            _token: $('meta[name="csrf-token"]').attr('content')    //'{{csrf_token()}}' 
        },
        dataType : 'json',
        success: function(ctresult){ //console.log(ctresult);
            $('#'+toCtrl).html('<option value="">Select City</option>'); 
            $.each(ctresult.cities,function(key,value){
                $("#"+toCtrl).append('<option value="'+value.id+'">'+value.city_name+'</option>');
            });
        }
    });
}

function callfunc(val){
    alert(val);
}
//Key validation for Numeric keys
function isNumberKey(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
 return true;
}
//Key validation for Alphabet with Numeric keys
function isAlphaNumericKey(evt){
 var charCode = (evt.which) ? evt.which : event.keyCode
 if((charCode >= 48 && charCode <= 57) || (charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <=
           122) || (charCode == 32))
        return true;

 return false;
}
//Key validation for Contact / Fax No. with these symbols: "(", ")", "+", "-"
function isContactNo(evt){
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 40 && charCode != 41 && charCode != 45 && charCode != 43) )
    return false;
 return true;
}
//Key validation for Alphabet
function isAlpha(evt){
    var keyCode = (evt.which) ? evt.which : event.keyCode
    if((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode == 8 || keyCode == 32 || keyCode == 190)
        return true;
    return false;
}
function changeCardHeadTitle(selectedId, cardHeadId){
    console.log('selectedId',selectedId);
    console.log('cardHeadId',cardHeadId);
    let str  = $("#"+selectedId+" :selected").text();
    console.log('changeCardHeadTitle',str);
    $("#"+cardHeadId).text(str);
}
