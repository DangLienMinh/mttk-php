<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript" src="{asset_url()}js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="{asset_url()}js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{asset_url()}css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{asset_url()}css/sb-admin.css">
    <link rel="stylesheet" type="text/css" href="{asset_url()}css/morris.css">
    <link rel="stylesheet" type="text/css" href="{asset_url()}font-awesome-4.1.0/css/font-awesome.min.css">
    <script>
        $(document).ready(function() {
            var user = {$userGraph};
            var status = {$statusGraph};
            var fanclub = {$fanclubGraph};
            var gender = {$genderGraph};
            {literal}
            Morris.Area({
                element: 'morris-area-chart',
                data: [
                    {
                        period: user[0].date,
                        user: user[0].user,
                        status: status[0].Status,
                        fanclub: fanclub[0].Fanclub
                    }, {
                        period: user[1].date,
                        user: user[1].user,
                        status: status[1].Status,
                        fanclub: fanclub[1].Fanclub
                    }, {
                        period: user[2].date,
                        user: user[2].user,
                        status: status[2].Status,
                        fanclub: fanclub[2].Fanclub
                    }, {
                        period: user[3].date,
                        user: user[3].user,
                        status: status[3].Status,
                        fanclub: fanclub[3].Fanclub
                    }, {
                        period: user[4].date,
                        user: user[4].user,
                        status: status[4].Status,
                        fanclub: fanclub[4].Fanclub
                    }, {
                        period: user[5].date,
                        user: user[5].user,
                        status: status[5].Status,
                        fanclub: fanclub[5].Fanclub
                    }, {
                        period: user[6].date,
                        user: user[6].user,
                        status: status[6].Status,
                        fanclub: fanclub[6].Fanclub
                    }, {
                        period: user[7].date,
                        user: user[7].user,
                        status: status[7].Status,
                        fanclub: fanclub[7].Fanclub
                    }, {
                        period: user[8].date,
                        user: user[8].user,
                        status: status[8].Status,
                        fanclub: fanclub[8].Fanclub
                    }, {
                        period: user[9].date,
                        user: user[9].user,
                        status: status[9].Status,
                        fanclub: fanclub[9].Fanclub
                    },{
                        period: user[10].date,
                        user: user[10].user,
                        status: status[10].Status,
                        fanclub: fanclub[10].Fanclub
                    },{
                        period: user[11].date,
                        user: user[11].user,
                        status: status[11].Status,
                        fanclub: fanclub[11].Fanclub
                    }
                ] ,
                xkey: 'period',
                ykeys: ['user', 'status', 'fanclub'],
                labels: ['user', 'status', 'fanclub'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });
            Morris.Donut({
                    element: 'morris-donut-chart',
                    data: [{
                        label: "Unidentified",
                        value: gender[0].number
                    }, {
                        label: gender[1].gender,
                        value: gender[1].number
                    }, {
                        label: gender[2].gender,
                        value: gender[2].number
                    }],
                    resize: true
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
                <a class="navbar-brand" href="index.html">MyMusic Admin</a>
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
                    <li class="active">
                        <a href="{$indexReportUrl}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="{$statusReportUrl}"><i class="fa fa-fw fa-music"></i> Status Reports</a>
                    </li>
                    <li>
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
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{$statusNumber}</div>
                                        <div>New Status!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{$userNumber}</div>
                                        <div>New Users!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{$fanclubNumber}</div>
                                        <div>New Fanclubs!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-frown-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{$reportNumber}</div>
                                        <div>New Reports!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Status_Fanclub_User yearly report</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Gender graph</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-donut-chart"></div>
                                <div class="text-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <script type="text/javascript" src="{asset_url()}js/raphael.min.js"></script>
    <script type="text/javascript" src="{asset_url()}js/morris.min.js"></script>
    <script type="text/javascript" src="{asset_url()}js/morris-data.js"></script>
</body>

</html>
