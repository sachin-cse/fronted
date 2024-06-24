$(document).ready(function(){
    if(window.location.href !== base_url + '/fronted/admin/index.php'){
        startSessionTimeout();
    }

    $('.restart_session').on('click', function(){
        resetSessionTimeout();
    });

    $(document).on('mousemove keypress', function(){
        resetSessionTimeout();
    });


    $(window).on("load",function(){
          $("#preloader").fadeOut(1000);
    });


    $('#adminsignForm').on('submit', function(e){
        e.preventDefault();
        // alert(1);
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
            "positionClass": "toast-top-right",
            "timeOut": "2000"
        };
        // toastr["error"]("We use Cookies!", "Cookies!");

        var valid = true;
        var email = $('#email').val();
        // console.log(email);
        if($('#email').val().trim() == ''){
            toastr.error('email field is required')
            valid = false;
        }
        else if(IsEmail(email)==false){
            toastr.error('please enter a valid email')
            valid = false;
        }

        else if($('#password').val().trim() == ''){
            toastr.error('password field is required');
            valid = false;
        }

        if(valid){
            $.ajax({
                type: 'POST',
                url: './signin.php',
                cache: false,
                data:$(this).serialize(),
                dataType: 'json',
                beforeSend: function(){
                    // alert(1);
                    $("#loader").show();
                },
                success:function(data){
                    if(data.status == 200){
                        toastr.success(data.success);
                        window.setTimeout( function(){
                            window.location = "./dashboard.php";
                        }, 2000);
                    } else if(data.status == 404 || data.status == 401 || data.status == 500) {
                        toastr.error(data.error);
                    }
                    // } else if(data.status == 500){
                    //     toastr.error(data.error);
                    // }
                },
                complete:function(){
                    // alert(1);
                    $("#loader").hide();
                }
            }); 
        }
    });

    // logout function 
    $('#logout_btn').on('click', function(){
        $.ajax({
            method: 'POST',
            url: base_url + '/fronted/admin/logout.php',
            dataType: 'json',
            success: function(error){
                if(error.status == 200){
                    toastr.success(error.message);
                    window.setTimeout( function(){
                        window.location = "/fronted/admin/index.php";
                    }, 2000);
                }
            },
            error: function (error) {
                console.log(error.status + ':' + error.statusText,error.responseText);
            }
        });
    });

    $('#showProfile').on('click', function(e){
        e.preventDefault();
        var getUserId = $('#hidden_id').val();

        $.ajax({
            method: 'POST',
            url: base_url + '/fronted/admin/show_profile.php',
            dataType: 'json',
            data: {id :getUserId},
            success: function(data){
                if(data.error == 404){
                    console.log(data.message);
                } else if(data.error == 500){
                    console.log(data.message);
                } else {
                    var profileImage = base_url + '/fronted/admin/upload/' + data[0].profile_image;
                    $('#first_name').attr('value', data[0].first_name);
                    $('#last_name').attr('value', data[0].last_name);
                    $('#email').attr('value', data[0].email);
                    $('#profileImage').attr('src', profileImage);
                }
                $('#profileModal').modal('show');
            },
            error: function (error) {
                console.log(error.status + ':' + error.statusText,error.responseText);
            }
        })
    });

    // add admin profile
    $('#addadminprofile').validate({
        rules:{
            first_name: "required",
            last_name: "required",
            email: {
                email: true,
                required:true
            },
            role: "required",
            status: "required",
            password: {
                minlength: 8,
                maxlength: 8,
                required: true,
            }

        },
        messages:{
            first_name: "Please enter first name",
            last_name : "Please enter last name",
            email:{
                email: "Please enter your valid email",
                required:"Please enter your email"
            },
            role:"Please select your role",
            status:"Please select your status",
            password: {
                minlength:"Password must be at least {0} characters long",
                maxlength:"Password must be maximum {0} characters long",
                required : "Please enter your password"

            }
        },
        submitHandler: function(form){
            // ('#addadminModel').modal('show');
            var formData = new FormData(form);
            $.ajax({
                method:"POST",
                url: base_url + "/fronted/admin/addadmin.php",
                dataType:"json",
                contentType: false,
                cache: false,
                processData:false,
                data:formData,
                success: function(data){
                    if(data.status == 201){
                        toastr.success(data.message);
                    } else if(data.status == 200){
                        toastr.error(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                    setTimeout(function(){ window.location.reload(); }, 2000);
                },
                error: function (error) {
                    console.log(error.status + ':' + error.statusText,error.responseText);
                }

            })
        }
    });

    // add site settings
    $('#site_settings').validate({
        rules:{
            site_title: "required",
            site_description: "required",
            site_logo: {
                required: $('#existing_site_logo').val() ? false:true,
            },
            site_favicon: {
                required: $('#existing_fav_icon').val() ? false:true,
            },
            footer_phone: "required",
            footer_description: "required",
            footer_email: "required",
            "footer_links[]" : "required",
            smtp_driver: "required",
            smtp_host: "required",
            smtp_port: "required",
            smtp_username: "required",
            smtp_encryption: "required",
            smtp_password: "required"
        },
        messages:{
            site_title: "Site Title is required field",
            site_description : "Site description is required field",
            site_logo: "Site Logo is required field",
            site_favicon: "Site Favicon is required field",
            footer_phone: "Footer Phone is required field",
            footer_description: "Footer Description is required",
            footer_email: "Footer Email is required field",
            "footer_links[]": "Footer Links is required field",
            smtp_driver: "SMTP Driver is required field",
            smtp_host: "SMTP Host is required field",
            smtp_port: "SMTP Port is required field",
            smtp_username: "SMTP Username is required field",
            smtp_encryption: "SMTP Encryption is required field",
            smtp_password: "SMTP Password is required field"
        },
        submitHandler: function(form){
            // ('#addadminModel').modal('show');
            var formData = new FormData(form);
            $.ajax({
                method:"POST",
                url: base_url + "/fronted/admin/settings/save_settings.php",
                dataType:"json",
                contentType: false,
                cache: false,
                processData:false,
                data:formData,
                success: function(data){
                    if(data.status == 201){
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                    setTimeout(function(){ window.location.reload(); }, 2000);
                },
                error: function (error) {
                    console.log(error.status + ':' + error.statusText,error.responseText);
                }

            })
        }
    });

    // add general settings
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');
    
    $.validator.addMethod('extension', function (value, element, param) {
        var files = element.files;
        if(files && files.length > 0){
            var filename = files[0].name;

            if(filename && filename.length > 0){
                var lastdot = filename.lastIndexOf('.');
                var ext = filename.substring(lastdot + 1);
                if($.inArray(ext, ['jpg', 'png', 'jpeg']) != -1){
                    return true;
                } else{
                    return false;
                }
            }
        }
        return true;
    });

    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
          var re = new RegExp(regexp);
          return this.optional(element) || re.test(value);
        }
      );

    $('#general_settings').validate({
        rules:{
            meta_title:{
                required:true,
                regex:'^[a-zA-Z ]',
            },
            meta_keywords:{
                required:true,
                regex:'^[a-zA-Z ]',
            },
            meta_description:{
                required:true,
                maxlength:255,
            },
            og_image:{
                required:function(element){
                    return $('#existing_og_image').val() !== ''?false:true;
                },
                extension:'jpeg,jpg,png',
                filesize:200000,
            },
            robot_index:{
                required:true,
            },
            robot_follow:{
                required:true,
            },
            script_title:{
                required:true,
                regex:'^[a-zA-Z ]',
            },
            script_description:{
                required:true,
            }
        },
        messages:{
            meta_title:{
                required:"Please enter meta title",
                regex:"Please enter meta title properly"
            },
            meta_description:{
                required:"Please enter meta description",
            },
            og_image:{
                required:"Please upload og image",
                filesize:"maximum file size allowed 200kb",
                extension:"Allowed image formats are PNG, JPEG,JPG",
            },
            meta_keywords:{
                required:"Please enter meta keywords",
                regex:"Please enter meta keywords properly",
            },
            robot_index:{
                required:"Please select robot index",
            },
            robot_follow:{
                required:"Please select robot follow"
            },
            script_title:{
                required:"Please enter script title",
                regex:"Please enter script title properly"
            },
            script_description:{
                required:"Please enter script description"
            }

        },
        submitHandler: function(form){
            // ('#addadminModel').modal('show');
            var formData = new FormData(form);
            $.ajax({
                method:"POST",
                url: base_url + "/fronted/admin/settings/save_settings.php",
                dataType:"json",
                contentType: false,
                cache: false,
                processData:false,
                data:formData,
                success: function(data){
                    if(data.status == 201){
                        toastr.success(data.message);
                        setTimeout(function(){ window.location.reload(); }, 2000);
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function (error) {
                    console.log(error.status + ':' + error.statusText,error.responseText);
                }

            })
        }
    });

    // save social settings
    $('#social_settings').validate({
        rules:{
            'social_link_name[]':'required',
            'social_link[]':'required',
            'social_link_icon[]':'required',
            'social_link_class[]':'required'
        },
        messages:{
            'social_link_name[]':"Please enter your social link name",
            'social_link[]':"Please enter your social link",

            'social_link_icon[]':"Please enter social link icon class",

            'social_link_class[]':"Please enter social link class",
        },
        submitHandler: function(form){
            // ('#addadminModel').modal('show');
            $.ajax({
                method:"POST",
                url: base_url + "/fronted/admin/settings/save_settings.php",
                dataType:"json",
                data:$('form').serialize(),
                success: function(data){
                    if(data.status == 201){
                        toastr.success(data.message);
                        setTimeout(function(){ window.location.reload(); }, 2000);
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function (error) {
                    console.log(error.status + ':' + error.statusText,error.responseText);
                }

            })
        }
    });

    // change password
    $('#usrchangepassword').validate({
        rules:{
            oldpassword: "required",
            newpassword: {
                minlength: 8,
                maxlength: 8,
                required: true
            }

        },
        messages:{
            oldpassword: "Please enter your old password",
            newpassword: {
                minlength:"Password must be at least {0} characters long",
                maxlength:"Password must be maximum {0} characters long",
                required : "Please enter your new password"
            }
        },
        submitHandler: function(form){
            // ('#addadminModel').modal('show');
            var formData = new FormData(form);
            $.ajax({
                method:"POST",
                url: base_url + "/fronted/admin/changepassword.php",
                dataType:"json",
                contentType: false,
                cache: false,
                processData:false,
                data:formData,
                success: function(data){
                    if(data.status == 200){
                        toastr.success(data.message);
                    } 
                    else {
                        toastr.error(data.message);
                    }
                    setTimeout(function(){ window.location="./index.php"; }, 2000);
                },
                error: function (error) {
                    console.log(error.status + ':' + error.statusText,error.responseText);
                }

            })
        }
    });

    // save resource data
    $.validator.addMethod('extension', function (value, element, param) {
        var files = element.files;
        if(files && files.length > 0){
            var filename = files[0].name;

            if(filename && filename.length > 0){
                var lastdot = filename.lastIndexOf('.');
                var ext = filename.substring(lastdot + 1);
                if($.inArray(ext, ['mp4', 'ogg', 'wav']) != -1){
                    return true;
                } else{
                    return false;
                }
            }
        }
        return true;
    });
    $('#resource').validate({
        rules:{
            media_type:{
                required:true,
            },
            file_link:{
                required:true,
            },
            media_file:{
                required:function(element){
                    return $('#existing_media_file').val() !== ''?false:true;
                },
                extension:'mp4,wav,ogg'
            },
            description:{
                required:true,
            }
        },
        messages:{
            media_type:{
                required:"Please select your media type",
            },
            file_link:{
                required:"Please enter your file link",
            },
            media_file:{
                required:"Please upload your video",
                extension:"Please upload only mp4, wav, ogg"
            },
            description:{
                required:"Please enter your description"
            }
        },
        submitHandler: function(form){
            // ('#addadminModel').modal('show');
            var formData = new FormData(form);
            $.ajax({
                method:"POST",
                url: base_url + "/fronted/admin/resources/save_resource_data.php",
                dataType:"json",
                contentType: false,
                cache: false,
                processData:false,
                data:formData,
                success: function(data){
                    if(data.status == 201){
                        toastr.success(data.message);
                        setTimeout(function(){ window.location.reload(); }, 2000);
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function (error) {
                    console.log(error.status + ':' + error.statusText,error.responseText);
                }

            })
        }
    });

    // admin edit profile
    $(document).on('click', '.edit-profile', function(){

        var getUserId = $(this).data('id');
        $('#edit_model').html('');

        $.ajax({
            method: 'POST',
            url: base_url + '/fronted/admin/show_profile.php',
            dataType: 'json',
            data: {id :getUserId},
            success: function(data){
                // alert(JSON.stringify(data));
                // profile_image
                if(data.error == 404){
                    console.log(data.message);
                } else if(data.error == 500){
                    console.log(data.message);
                } else {
                    $('#edit_model').append(`
                    <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <form action="javascript:void(0);" enctype="multipart/form-data" id="updateprofile">
                    <input type="hidden" class="form-control" id="updatehidden_id" name="hidden_id" value="${getUserId}">
                      <div class="form-group">
                        <label for="first-name" class="col-form-label">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="${data[0].first_name}">
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="${data[0].last_name}">
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="${data[0].email}" readonly>
                      </div>

                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Status:</label>
                        <select name="status" id="SelectList">
                        <option value="">Select Status</option>
                        <option value="active" ${data[0].status == 'active' ? 'selected':''}>Active</option>
                        <option value="inactive"  ${data[0].status == 'inactive' ? 'selected':''}>InActive</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Role:</label>
                        <select name="role" id="selectrole">
                        <option value="">Select Role</option>
                        <option value="admin" ${data[0].role == 'admin' ? 'selected':''}>Admin</option>
                        <option value="subadmin"  ${data[0].role == 'subadmin' ? 'selected':''}>Subadmin</option>
                        </select>
                      </div>
            
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Profile Pic:</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>

                    <input type="hidden" name="hidden_image" value = "${data[0].profile_image}">
            
                      <div class="form-group">
                        <img src = "${base_url}/fronted/admin/upload/${data[0].profile_image}" alt="" height="50" width="50">
                      </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                    </form>
                  </div>
                  </div>
                </div>
              </div>
                    `);
                }
                $('#editModel').modal('show');
            },
            error: function (error) {
                console.log(error.status + ':' + error.statusText,error.responseText);
            }
        })
    });

    // update admin profile
    $(document).on('submit', '#updateprofile', function(e){
        e.preventDefault();

        $.ajax({
            method: 'POST',
            url: base_url + '/fronted/admin/update_profile.php',
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            data:new FormData(this),
            success: function(data){
                if(data.status == 200){
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
                setTimeout(function(){ window.location.reload(); }, 2000);
            },
            error: function (error) {
                console.log(error.status + ':' + error.statusText,error.responseText);
            }
        });
    });

    // delete admin profile
    $(document).on('click', '.delete-profile', function(e){
        e.preventDefault();
        // alert(1);
        $('#deleteModal').modal('show');
        var adminId = $(this).data('id');
        $('#delete_btn').on('click', function(){
            $.ajax({
                method: 'POST',
                url: base_url + '/fronted/admin/deleteadmin.php/' + adminId,
                dataType: 'json',
                data:{id: adminId},
                success: function(data){
                    if(data.status == 200){
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                    window.setTimeout( function(){
                         window.location.reload();
                    }, 2000);
                },
                error: function (error) {
                    console.log(error.status + ':' + error.statusText,error.responseText);
                }
            })
        });

    });

    // show and hide password
    $(document).on('click', '.toggle-password', function(){
        // alert(1);
        $(this).toggleClass('fa-eye fa-eye-slash');
        var input = $('.password');
        input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password');
    });
    

    // light and dark theme
    $('.change-theme').on('click', function(){
        $('#page-top').toggleClass('dark-theme');
        $(this).toggleClass('fa-moon fa-sun');
    });

    // generate password
    $(document).on('click', '.generate-password', function(){
        var genratePass = Math.random().toString(36).slice(-8);
        // var i = $('#newpassword').val()
        $('#newpassword').val(genratePass);
    });

    // live search with ajax
    $(document).on('keyup', '.live-search', function(e){
        e.preventDefault();
        // $('#showdata').html('');
        var search = $(this).val();
        $.ajax({
            method: 'POST',
            url: base_url + '/fronted/admin/livesearch.php',
            data:{s:search},
            success: function(data){
                $('#showdata').html(data);
            }
        });
    });

    // footer add links
    var i = 1;
    $('#add').on('click', function(){
        // alert(1);
        i++;
        $('#dynamic_field').append(`<tr id="row${i}" class="dynamic_row"><td><input type="text" name="footer_links[]" id="footer_links" class="form-control" placeholder="Footer Links"></td>
        <td><a href="javascript:void(0);" id="${i++}" class="form-control remove_field">Remove</a></td></tr>`);
        
    });

    $('#dynamic_field').on('click', '.remove_field', function(){
        $(this).closest('tr').remove();
    });

    // social links
    $('#add_social_item').on('click',function(){
        $('#dynamic_social_field').append(`<tr id="row" class="dynamic_row">
        <td><input type="text" name="social_link_name[]" id="social_link_name" class="form-control" placeholder="Social Link Name"></td>
        <td><input type="text" name="social_link[]" id="social_link" class="form-control" placeholder="Social Link">
        </td>
        <td><input type="text" name="social_link_icon[]" id="social_link_icon" class="form-control" placeholder="Social Link Icon">
        </td>
        <td><input type="text" name="social_link_class[]" id="social_link_class" class="form-control" placeholder="Social Link Class">
        </td>
        <td><a href="javascript:void(0);" id="" class="form-control remove_social_field">Remove</a></td>
        </tr>`);
    });

    $('#dynamic_social_field').on('click', '.remove_social_field', function(){
        $(this).closest('tr').remove();
    });

    // generate slug
    $(document).on('keyup', '.slug', function(){
        var pageVal = $(this).val();
        var slugAttr = $(this).attr('data-slug');

        $('#'+slugAttr).val('');

        $.ajax({
            method:'GET',
            url:base_url + '/fronted/admin/Helper/Apphelper.php/',
            data:{val:pageVal},
            dataType: 'json',
            success:function(data){
                $('#'+slugAttr).val(data.slug);
            }
        });
    });

    // save pages 
    $('#add_edit_page').validate({
        rules:{
            page_name:{
                required:true
            },
            page_slug: {
                required:true
            },
            page_title:{
                required:true
            },
            page_status:{
                required:true
            },
            page_description:{
                required:true
            }

        },
        messages:{
            page_name:{
                required:"Please enter page name",
            },
            page_slug:{
                required:"Please enter page slug",
            },
            page_title:{
                required:"Please enter page title",
            },
            page_status:{
                required:"Please choose page status",
            },
            page_description:{
                required:"Please enter page description",
            }
        },
        submitHandler: function(form){
            // ('#addadminModel').modal('show');
            var formData = new FormData(form);
            $.ajax({
                method:"POST",
                url: base_url + "/fronted/admin/pages/save_pages.php",
                dataType:"json",
                contentType: false,
                cache: false,
                processData:false,
                data:formData,
                success: function(data){
                    if(data.status == 200){
                        toastr.success(data.message);
                        setTimeout(function(){ window.location.reload(true) }, 2000);
                    } 
                    else {
                        toastr.error(data.message);
                    }
                },
                error: function (error) {
                    console.log(error.status + ':' + error.statusText,error.responseText);
                }

            })
        }
    });

    // check all box for multiple delete
    $(document).on('click', '.check', function(){
        if($('.check').is(':checked')){
            $('.checkAll').prop('checked', true);
        }else{
            $('.checkAll').prop('checked', false);
        }
    });

    // delete single page
    $(document).on('click', '.delete_page', function(){
        var Url = $(this).attr('data-url');
        var dataId = $(this).attr('data-id');

        var valid = confirm('Are you sure you want to delete?');

        if(valid){
            $.ajax({
                url: Url,
                type:'GET',
                dataType: 'json',
                data:{id: dataId},
                success:function(response){
                    // console.log(response.flag);
                    if((response.status == 200) && response.flag !== 'error'){
                        toastr.success(response.message);
                        setTimeout(function(){
                            window.location.reload(true);
                        },2000);
                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }
    });

    // multiple delete
    $(document).on('click', '.delete_all', function(){
        var Url = $(this).attr('data-url');
        var dataVal = $(this).attr('data-val');
        // alert(dataVal);
        var searchIDs = $("#find-table input:checkbox:checked").map(function(){
            return $(this).val();
          }).toArray().slice(1);

        if(searchIDs.length === 0){
            toastr.info('Please select at least one row');
        }else{
            $.ajax({
                url: Url,
                type:'GET',
                dataType: 'json',
                data:{type:dataVal, ids:searchIDs},
                success:function(response){
                    // console.log(response.flag);
                    if((response.status == 200) && response.flag !== 'error'){
                        toastr.success(response.message);
                        setTimeout(function(){
                            window.location.reload(true);
                        },2000);
                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }
    })

    // drop down icon change
    // Check if the collapse is in the 'show' state
    if ($('#collapseTwo').hasClass('show')) {
        $('.nav-item.activeShow').find('a:first').removeClass('collapsed');
    } else {
        $('.nav-item.activeShow').find('a:first').addClass('collapsed');
    }

    // resources data
    $(document).on('change', '#media_type', function(e){
        e.preventDefault();
        if($(this).val() == 'file'){
            $('#show_media_file').addClass('d-none');
            $('#show_file_link').removeClass('d-none');
            $('#show_media_file').find('input').val('');
        }else{
            $('#show_media_file').removeClass('d-none');
            $('#show_file_link').addClass('d-none');
            $('#show_file_link').find('input').val('');
        }
    });



});


// session time out
// var base_url = window.location.origin;
var sessionTimeout;
function startSessionTimeout(){
    sessionTimeout = setTimeout(function(){
        showpopup();
    }, 1800000);
}

function resetSessionTimeout(){
    clearTimeout(sessionTimeout);
    startSessionTimeout();
}

function showpopup(){
    $('#sessionExpiredmodel').modal('show');
    setTimeout(function(){
        window.location.href = base_url + '/fronted/admin/index.php';
    }, 2000);
}


function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
       return false;
    }else{
       return true;
    }
}

// preview image
function previewImage(id, input){
    if (input.files && input.files[0]) {

        var getFilename = input.files[0].name
        var getFileextension = getFilename.split('.').pop();

        var reader = new FileReader();
        var extension = ['mp4', 'og', 'wav'];
        if(extension.indexOf(getFileextension) != -1){
            var name = 'play-icon.png';
            reader.onload = function (e) {
                console.log($('#' + id).attr('src', base_url + 'fronted/admin/upload/' + name));
            }
        }else{
            reader.onload = function (e) {
                $('#' + id).attr('src', e.target.result);
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// ckeditor
ClassicEditor
.create( document.querySelector( '.editor' ), {
    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
})
.catch( error => {
    console.error(error);
});

ClassicEditor
.create( document.querySelector( '.footer-description' ), {
    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
})
.catch( error => {
    console.error(error);
});

ClassicEditor
.create( document.querySelector( '.script_description' ), {
    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
})
.catch( error => {
    console.error(error);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#og_image')
                .attr('src', e.target.result)
                .width(150)
                .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}




