	function dropSearch()
	{
		$("#seachBoxId").val(" ");
		var seachBoxId ='';  var providerName =''; var pateintid =''; var patientName =''; var dob =''; var ssn =''; var referring_doctor =''; var payor =''; var doiNumber =''; var claimNumber ='';
		
		providerName =$("#providerName").val();
		pateintid =$("#pateintid").val();
		patientName = $("#patientName").val();
		dob =$("#dob").val();
		ssn = $("#ssn").val();
		referring_doctor = $("#referring_doctor").val();
		payor = $("#payor").val();
		doiNumber =$("#doiNumber").val();
		claimNumber =$("#claimNumber").val();
	
		/*$.ajax({
		type: "POST",
		url: 'retriveData.php', 
		data: {searchbtn:'yes',providerName:providerName, pateintid: pateintid, patientName:patientName, dob: dob, ssn: ssn, referring_doctor: referring_doctor, payor: payor, doiNumber:doiNumber, claimNumber: claimNumber
		
		},
		//dataType: "text",  
		//cache:false,
		success: 
		function(data){
		$(".table-responsive").html(data);
		}
		});*/
	}
	function showData()
	{
		var seachBoxId =$("#seachBoxId").val(); 
		/*$.ajax({
		type: "POST",
		url: 'retriveData.php', 
		data: {searchbtn:'yes',seachBoxId:seachBoxId },
		//dataType: "text",  
		//cache:false,
		async : true,
		success: 
		function(dataRest){
		//alert(dataRest);
		$(".table-responsive").html(dataRest);
		}
		});*/
	}
$( document ).ready(function() {
	showData('no');
	var srchvar=  $("#seachBoxId").val();
	if(srchvar=='')
	{
		showData('no');
	}
$('#searchBoxBtn').on('click', function() { 
showData('yes');
$("#seachBoxId").val(" ");
var srchvar=  $("#seachBoxId").val();
if(srchvar==='')
{
	alert('asasass');
	showData('yes');
}

});
$('#seachBoxId').on('keyup', function() { 
showData('yes');
});
$('#searchFrm button').on('click', function() { 
$("#seachBoxId").val(" ");
});
$('#seachBoxId').on('keyup', function() { 
showData('yes');
});
});	
