<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>
    <!-- jQuery -->
    <script type="text/javascript" src="{asset_url()}js/jquery-2.1.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="{asset_url()}js/bootstrap.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="{asset_url()}css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{asset_url()}css/sb-admin.css">
    <link rel="stylesheet" type="text/css" href="{asset_url()}font-awesome-4.1.0/css/font-awesome.min.css">
     {literal}
    <style>
     table { table-layout: fixed; width:100%!important;}

    </style>
    <script>
        $(document).ready(function() {
            /*$.ajax({
                  type: "post",
            {/literal}
                  url: "{base_url('reportadminController/getReportStatus')}",
            {literal}
                  cache: false,
                  success: function(data) {
                    $("#reportContent").html(data);
                  }
            });*/
        });
        $(document).on('click', '.delete_button', function() {
           var parent=$(this).parent().parent();
           var user=parent.children(":eq(2)").html();
           var status=parent.children(":eq(1)").find('a').html();
           var report=$(this).attr("rel");
           var dataString='report_id='+report+'&status_id='+status+'&user='+user;
           $.ajax({
                  type: "post",
            {/literal}
                  url: "{base_url('reportadminController/cancelReportRequest')}",
            {literal}
                  cache: false,
                  data:dataString,
                  success: function() {
                    parent.fadeOut('slow');
                  }
            });
        });

        $(document).on('click', '.accept_button', function() {
           var parent=$(this).parent().parent();
           var user=parent.children(":eq(2)").html();
           var status=parent.children(":eq(1)").find('a').html();
           var report=$(this).attr("rel");
           var dataString='report_id='+report+'&status_id='+status+'&user='+user;
           $.ajax({
                  type: "post",
            {/literal}
                  url: "{base_url('reportadminController/acceptReportRequest')}",
            {literal}
                  cache: false,
                  data:dataString,
                  success: function() {
                    parent.fadeOut('slow');
                  }
            });
        });
    {/literal}
    </script>
</head>
<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Admin panel</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Administrator <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{$logout}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="{$indexReportUrl}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="{$statusReportUrl}"><i class="fa fa-fw fa-music"></i> Status Reports</a>
                    </li>
                    <li  >
                        <a href="{$userReportUrl}"><i class="fa fa-fw fa-user"></i> Manage Users</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Reported Status
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-music"></i> Reported Status
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div>

                        <div class="table-responsive">
                            <table class="table table-bordered  table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 43px;">STT</th>
                                        <th style="width: 7%">STATUS</th>
                                        <th style="width: 20%">USER REPORT</th>
                                        <th style="width: 24%">REASON</th>
                                        <th style="width: 16%">REPORT DATE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="reportContent">
                                    {$results}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {$links}
        </div>
    </div>
</body>

</html>
