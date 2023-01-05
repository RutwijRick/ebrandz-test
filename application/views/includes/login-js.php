<script>
	$(document).ready(function() {
	});

	function registerUser(e) {
		e.preventDefault();
		var firstName = $('#register-first-name').val();
		var lastName = $('#register-last-name').val();
		var email = $('#register-email').val();
		var password = $('#register-password').val();
		var phone = $('#register-phone').val();
		var age = $('#register-age').val();
		if(isValid(firstName) && isValid(lastName) && isValid(email) && isValid(password) && isValid(phone)) {
			if(phone.length != 10) {
				alert('Phone Number Length Should Be 10');
				return false;
			} else {
				if(age > 18) {
					$.ajax({
						url:'<?php echo base_url('User/registerUser');?>',
						type:'post',
						dataType:'json',
						data:{
							firstName:firstName,
							lastName:lastName,
							email:email,
							password:password,
							phone:phone,
							age:age
						},
						error:function(response) {
							alert('error '+response.responseText);
							console.log(response.responseText);
						},
						success:function(response) {
							if(response == 'exists') {
								alert('This Email Already Exists');
							} else if(response == 'fail') {
								alert('Failed To Insert User');
							} else {
								alert('Registration Successfull');
								clearFormData('register-user-form');
							}
						}
					})
				} else alert('You Are Under Age To Register');
			}
		} else {
			alert('All Fields Are Mandatory')
		}
	}

	function loginUser(e) {
		e.preventDefault();
		var email = $('#login-email').val();
		var password = $('#login-password').val();
		if(isValid(email) && isValid(password)) {
			$.ajax({
				url:'<?php echo base_url('User/loginUser');?>',
				type:'post',
				dataType:'json',
				data:{
					email:email,
					password:password
				},
				error:function(response) {
					alert('error '+response.responseText);
					console.log(response.responseText);
				},
				success:function(response) {
					if(response == 'invalid') {
						alert('Invalid Login Credentials');
					} else if(response == 'fail') {
						alert('Something Went Wrong');
					} else {
						window.location.href = '<?php echo base_url('Home/userdashboard')?>';
					}
				}
			})
		} else {
			alert('All Fields Are Mandatory');
		}
	}
</script>