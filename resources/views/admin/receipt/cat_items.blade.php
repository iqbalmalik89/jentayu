@extends('admin.layouts.master')

@section('jsmodule', 'catitems.js')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Catecogry Items</span>
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
    <h3 class="page-title"> Category Items
<!--         <small>User's Surveys</small> -->
 
    <a id="addbtn" href="javascript:void(0);" style="float:right;" class="btn dark" href="">Add Category Item</a>

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
                        <i class="fa fa-cogs"></i>Category Items </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div>
                            <form onsubmit="return false;" id="search_form">
                                <div class="input-group col-md-6"  style="margin-bottom: 6px;">
                                    <input type="text" class="form-control" placeholder="Search Here" id="search_keyword" name="search_keyword">
                                    <span class="input-group-btn">
                                        <button class="btn blue" id="searchBtn" type="button">Go!</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th width="15%"> Category </th>
                                <th width="20%"> Category Item </th>
                                <th width="20%"> Created At </th>
                                <th width="11%" class="numeric"> Actions </th>
                            </tr>
                        </thead>
                        <tbody id="databody">
                        </tbody>
                    </table>

                    <ul style="margin-left:30%;" class="pagination"></ul>

                </div>
            </div>

            <div class="portlet box green" id="form_div" style="display:none;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Category Item </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="remove backbtn" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="#" class="form-horizontal" id="module-form">
                        <input type="hidden" id="entity_id" name="entity_id" value="">
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-3 control-label">Category</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="category" name="category" placeholder="Category Item">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Category Items</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="category_items" name="category_items" placeholder="Category Items">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">QB Account Id</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="qb_accountid" name="qb_accountid" placeholder="QB Account Id">
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