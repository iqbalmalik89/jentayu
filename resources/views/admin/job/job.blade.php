@extends('admin.layouts.master')

@section('jsmodule', 'job.js')
@section('content')


    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Surveys</span>
            </li>
        </ul>
        <div class="page-toolbar">
            <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                <i class="icon-calendar"></i>&nbsp;
                <span class="thin uppercase hidden-xs"></span>&nbsp;
                <i class="fa fa-angle-down"></i>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> Surveys
<!--         <small>User's Surveys</small> -->
    </h3>

     <div class="alert alert-danger display-hide" id="survey_error">
        <button class="close" data-close="alert"></button>
        <span>Enter any username and password. </span>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Surveys </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th width="15%"> Name </th>
                                <th width="25%"> Address </th>
                                <th width="35%" class="numeric"> Job </th>
                                <th width="25%" class="numeric"> Rooms </th>
                                <th width="5%" class="numeric"> Actions </th>
                            </tr>
                        </thead>
                        <tbody id="databody">
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>

@endsection