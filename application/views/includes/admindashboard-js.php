<script>
	$(document).ready(function() {
		getUserData();
	});

	function getUserData() {
		$.ajax({
			url:'<?php echo base_url('User/getUserByRole');?>',
			type:'post',
			dataType:'json',
			data:{
				role:3
			},
			error:function(response) {
				alert('error '+response.responseText);
				console.log(response.responseText);
			},
			success:function(response) {
				if(response == 'empty') {
					$('#main-table-tbody').html('<tr><td colspan="6">No data found</td></tr>');
				} else if(response == 'fail') {
					alert('Something Went Wrong');
				} else {
					createUserRows(response);
				}
			}
		})
	}

	function createUserRows(response) {
		var responseLength = response.length;
		if(responseLength > 0) {
			var tbl = "";
			for(i=0;i<responseLength;i++) {
				var rowId = response[i]['id'];
				var firstName = response[i]['firstName'];
				var lastName = response[i]['lastName'];
				var email = response[i]['email'];
				var password = response[i]['password'];
				var phone = response[i]['mobile'];
				var age = response[i]['age'];
				tbl += "<tr id='row-"+rowId+"' data-value='"+rowId+"'>";
					tbl += "<td id='first-name-"+rowId+"' data-value='"+firstName+"'>"+firstName+"</td>";
					tbl += "<td id='last-name-"+rowId+"' data-value='"+lastName+"'>"+lastName+"</td>";
					tbl += "<td id='email-"+rowId+"' data-value='"+email+"'>"+email+"</td>";
					tbl += "<td id='phone-"+rowId+"' data-value='"+phone+"'>"+phone+"</td>";
					tbl += "<td id='age-"+rowId+"' data-value='"+age+"'>"+age+"</td>";
					tbl += "<td><input class='table-checkbox' type='checkbox' id='checkbox-"+rowId+"' value='"+rowId+"' onchange='activateEditing(event)'/></td>";
				tbl += "</tr>";
				if(i == responseLength - 1 ){
					$('#main-table-tbody').html(tbl);
				}
			}
		} else $('#main-table-tbody').html('<tr><td colspan="6">No data found</td></tr>');
	}

	function activateEditing(e) {
		var rowId = e.target.value;
		if($(e.target).is(':checked')) {
			changeRowStatus(rowId,'edit');
		} else {
			changeRowStatus(rowId,'update');
		}
	}

	function changeRowStatus(rowId,type) {
		var firstName = $('#first-name-'+rowId).attr('data-value');
		var lastName = $('#last-name-'+rowId).attr('data-value');
		var email = $('#email-'+rowId).attr('data-value');
		var phone = $('#phone-'+rowId).attr('data-value');
		var age = $('#age-'+rowId).attr('data-value');
		if(type == 'edit') {
			$('.update-type').show();
			// get data
			// activate fields
			$('#row-'+rowId).addClass('selected');
			$('#first-name-'+rowId).html("<input id='edit-first-name-"+rowId+"' value='"+firstName+"'/>");
			$('#last-name-'+rowId).html("<input id='edit-last-name-"+rowId+"' value='"+lastName+"'/>");
			$('#email-'+rowId).html("<input id='edit-email-"+rowId+"' value='"+email+"'/>");
			$('#phone-'+rowId).html("<input type='number' id='edit-phone-"+rowId+"' value='"+phone+"'/>");
			$('#age-'+rowId).html("<input type='number' id='edit-age-"+rowId+"' value='"+age+"'/>");
		} else if(type == 'update') {
			$('.update-type').hide();
			$('#row-'+rowId).removeClass('selected');
			$('#first-name-'+rowId).html(firstName);
			$('#last-name-'+rowId).html(lastName);
			$('#email-'+rowId).html(email);
			$('#phone-'+rowId).html(phone);
			$('#age-'+rowId).html(age);
		}
	}

	function updateAllEdits(type) {
		if(type == 'update') {
			$('.notify').html('');
			var answer = confirm('Update All Entries?');
			if(answer) {
				var selectedLength = $('#main-table-tbody .selected').length;
				if(selectedLength > 0) {
					var changeDetails = "";
					// update all entries that are selected
					$('#main-table-tbody .selected').each(function(index) {
						var rowId = $(this).attr('data-value');
						checkChanges(rowId);
						// update in database
						var firstName = $('#edit-first-name-'+rowId).val();
						var lastName = $('#edit-last-name-'+rowId).val();
						var email = $('#edit-email-'+rowId).val();
						var phone = $('#edit-phone-'+rowId).val();
						var age = $('#edit-age-'+rowId).val();
						$.ajax({
							url:'<?php echo base_url('User/updateUserById');?>',
							type:'post',
							dataType:'json',
							data:{
								rowId:rowId,
								firstName:firstName,
								lastName:lastName,
								email:email,
								phone:phone,
								age:age
							},
							error:function(response) {
								alert('error '+response.responseText);
								console.log(response.responseText);
							},
							success:function(response) {
							}
						})
						console.log(index,selectedLength);
						if(index == selectedLength - 1) {
							getUserData();
							$('.update-type').hide();
						}
					})
				} else {
					alert('No Rows Selected');
				}
			}
		} else {
			//
		}
	}

	function checkChanges(rowId) {
		var changeDetails = "";

		// Array method 
		// var fields = ['first-name','last-name','phone','email','age'];
		// for(i=0;i<fields.length;i++) {
		// 	changeDetails += "<div><hr>";
		// 	var el = fields[i];
		// 	var org = $('#'+el+'-'+rowId).attr('data-value'); // original value
		// 	var ch = $('#edit-'+el+'-'+rowId).val(); // update value
		// 	if(org != ch) changeDetails += el+" changed from "+org+" to: "+ch+". ";
		// 	changeDetails += "</div>";
		// 	$('.notify').append(changeDetails);
		// }

		// Long Method
		// original values
		var firstNameOrg = $('#first-name-'+rowId).attr('data-value');
		var lastNameOrg = $('#last-name-'+rowId).attr('data-value');
		var emailOrg = $('#email-'+rowId).attr('data-value');
		var phoneOrg = $('#phone-'+rowId).attr('data-value');
		var ageOrg = $('#age-'+rowId).attr('data-value');
		// update values
		var firstNameCheck = $('#edit-first-name-'+rowId).val();
		var lastNameCheck = $('#edit-last-name-'+rowId).val();
		var emailCheck = $('#edit-email-'+rowId).val();
		var phoneCheck = $('#edit-phone-'+rowId).val();
		var ageCheck = $('#edit-age-'+rowId).val();
		changeDetails += "<div>Updated User: "+firstNameOrg+" "+lastNameOrg+". ";
		if(firstNameOrg != firstNameCheck) changeDetails += "First Name changed to: "+firstNameCheck+". ";
		if(lastNameOrg != lastNameCheck) changeDetails += "Last Name changed to: "+lastNameCheck+". ";
		if(emailOrg != emailCheck) changeDetails += "Email changed to: "+emailCheck+". ";
		if(phoneOrg != phoneCheck) changeDetails += "Email changed to: "+phoneCheck+". ";
		if(ageOrg != ageCheck) changeDetails += "Email changed to: "+ageCheck+". ";
		changeDetails += "<hr></div>";
		$('.notify').append(changeDetails);
	}
</script>