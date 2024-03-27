// image preview
$(document).ready(()=>{
    // alert(1);
	$('#update_profile_pic').change(function(){
		const file = this.files[0];
		console.log(file);
		if (file){
		let reader = new FileReader();
		reader.onload = function(event){
			console.log(event.target.result);
			$('#imgPreview').attr('src', event.target.result);
		}
		reader.readAsDataURL(file);
		}
	});

	// login form validation
	$("#signin-form").validate({
	    rules:{
			usrname:"required",
			password:"required"
			
		},

		messages:{
			usrname:"username is required",
			password:"password is required"
		}

	});

	// sign up form validation
	$('#signup-form').validate({
		rules:{
			username:"required",
			email:{
				required: true,
				email: true,
			},
			pass:{
				required: true,
				minlength: 8,
			}
		},
		messages:{
			username: "username is required",
			email: {
				required: "email is required",
				email: "please enter a valid email"
			},
			pass:{
				required: "password is required",
				minlength: "password at least {0} characters long"
			}
		}
	});


	// contact form
	$('#contact-us').validate({
		rules:{
			name:"required",
			email:{
				required:true,
				email:true
			},
			phone:{
				required:true,
				minlength:10,
				maxlength:12
			},
			msg:"required"
		},

		messages:{
			name:"name field is required",
			email:{
				required:"email field is required",
				email: "please enter a valid email"
			},
			phone:{
				required:"phone field is required",
				minlength:"please enter atleast {0} digits",
				maxlength: "please enter maximum {0} digits"
			},
			msg:"messages field is required"
		}
	})


});



