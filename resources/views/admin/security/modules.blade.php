@extends('admin.layouts.master')

@section('jsmodule', 'module.js')
@section('content')


    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Modules</span>
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
    <h3 class="page-title"> Modules
<!--         <small>User's Surveys</small> -->

    <a id="addbtn" href="javascript:void(0);" style="float:right;" class="btn btn-primary" href="">Add Modules</a>

    <a id="backbtn" href="javascript:void(0);" style="float:right; display: none;" class="btn backbtn btn-default" href="">Back To Listing</a>

    </h3>

     <div class="alert alert-danger display-hide" id="module_error">
        <button class="close" data-close="alert"></button>
        <span>Enter any username and password. </span>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green" id="listing_div">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Modules </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th width="15%"> Module </th>
                                <th width="25%"> Operations </th>
                                <th width="8%" class="numeric"> Status </th>
                                <th width="5%" class="numeric"> Actions </th>
                            </tr>
                        </thead>
                        <tbody id="databody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="portlet box green" id="form_div" style="display:none;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Modules </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="remove backbtn" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="#" class="form-horizontal" id="module-form">
                        <input type="hidden" id="id" name="id" value="">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Module</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="module" name="module" placeholder="Module">
                                </div>
                            </div>

                            <div class="form-group last">
                                <label class="col-md-3 control-label">Status</label>
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="module_status" checked="checked" id="enable_status" value="enable"> Enable </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="module_status" id="disable_status" value="disable"> Disable </label>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" id="addEntity" class="btn green">Submit</button>
                                    <button type="button" class="btn backbtn default">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>

@endsection