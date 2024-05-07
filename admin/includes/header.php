<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Hare Krishna Movement | Admin Panel</title>

    <!-- Custom fonts for this template-->
    <link href="/fronted/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="/fronted/admin/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- toaster -->

    <!-- Custom styles for this template-->
    <link href="/fronted/admin/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- custom css -->
    <link rel="stylesheet" href="/fronted/admin/assets/css/toastr.css">
    <link href="/fronted/admin/assets/css/admin.css" rel="stylesheet">

    



    <?php
    $protocol = isset($_SERVER['HTTPS']) && 
    $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $base_url = $protocol . $_SERVER['HTTP_HOST'] . '/';
    ?>

<script>
    var base_url = '<?php echo $base_url; ?>';
</script>

</head>

<body id="page-top" class="">


    <div id="preloader">
        <div id="loader"></div>
    </div>


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- session timeout -->
        <div class="modal fade" id="sessionExpiredmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Session expired notification</h5>
                        <button class="close restart_session" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <p>Your session will expire soon.</p>
                    </div>
                </div>
            </div>
        </div>

    