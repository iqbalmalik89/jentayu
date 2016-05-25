@extends('admin.layouts.master')

@section('jsmodule', 'receipt.js')
@section('content')

    <div class="modal fade bs-modal-lg" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Receipt Detail</h4>
                </div>
                <div class="modal-body" id="modal_body">
                        <div class="invoice-content-2 bordered" style="border: 1px solid #ccc; padding:10px;">
                            <div class="row invoice-head" style="padding: 3%;">
                                <div class="col-md-7 col-xs-6">
                                    <div class="invoice-logo">

                                        <img src="{{\URL::to('admin_assets/pages/img/logos/logo5.jpg')}}" class="img-responsive" alt="" />

                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Received money from</label>
                                            <div class="col-md-4">
                                                <span id="contact_name_lbl"></span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">From Name</label>
                                            <div class="col-md-4">
                                                <span id="from_name_lbl"></span>
                                            </div>
                                        </div>                               

                                    </div>
                                </div>
                                <div class="col-md-5 col-xs-6">
                                    <div class="company-address">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Receipt No</label>
                                            <div class="col-md-4">
                                                <span id="receipt_number_lbl"></span>
                                            </div>
                                        </div>
                                </div><br>
                                    <div class="company-address">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Receipt Date</label>
                                            <div class="col-md-4">
                                                <span id="receipt_date_lbl"></span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                                <div class="col-xs-12 table-responsive" style="overflow-x:visible !important;">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th> Category </th>
                                                <th> Description </th>
                                                <th> Amount </th>
                                            </tr>
                                        </thead>
                                        <tbody id="cat_items_lbl">
                                        </tbody>
                                    </table>
                                </div>


                                <div class="col-xs-12 table-responsive" style="overflow-x:visible !important;">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="53%;"></td>
                                                <th>Total</th>
                                                <th id="total_amount_lbl"></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>





<!--                              <div class="row invoice-subtotal"> -->
<!--                                 <div class="col-xs-3">
                                    <h2 class="invoice-title uppercase">Subtotal</h2>
                                    <p class="invoice-desc">23,800$</p>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="invoice-title uppercase">Tax (0%)</h2>
                                    <p class="invoice-desc">0$</p>
                                </div>
                                 <div class="col-xs-6" style="float:right;">
                                    <h2 class="invoice-title uppercase">Total</h2>
                                    <p class="invoice-desc grand-total" id="total_amount_lbl"></p>
                                </div>
                            </div> 
-->

                            <div class="row  invoice-subtotal">

                                <div class="col-md-5 hidden-xs">
                                    <span id="notes_lbl"></span>
                                </div>
                                <div class="col-md-7">
                                    <div class="col-xs-9">
                                        <table class="table">
                                            <thead>
                                                <tr><th width="40%;">Payment Mode</th><th>Pay Ref</th><th>Amount Paid</th></tr>
                                            </thead>
                                            <tbody id="payment_modes_lbl">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-12 hidden-xs">
                                    <a onclick="PrintElem('#modal_body');" class="btn btn-lg btn-primary" id="printBtn" style="float:right;">Print</a>
                                </div>
                            </div>
                        </div>                                        
                </div>
<!--                 <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" id="assignRoleBtn" class="btn green">Save changes</button>
                </div> -->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Receipts</span>
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
    <h3 class="page-title"> Receipts
<!--         <small>User's Surveys</small> -->
 
    <a id="addbtn" href="javascript:void(0);" style="float:right;" class="btn dark" href="">Add Receipt</a>

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
                        <i class="fa fa-cogs"></i>Receipts </div>
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
                                                <th> Receipt no </th>
                                                <th> From Name </th>
                                                <th> Receipt Date </th>
                                                <th> Amount  </th>
                                                <th> Created at  </th>
                                                <th> Actions  </th>
                            </tr>
                        </thead>
                        <tbody id="databody">
                        </tbody>
                    </table>

                    <ul style="margin-left:30%;" class="pagination"></ul>

                </div>
            </div>
            <form action="#" class="form-horizontal" id="module-form">            
                <div id="form_div" style="display:none;">
                        <!-- BEGIN PAGE TITLE-->
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="invoice-content-2 bordered" style="border: 1px solid #ccc; padding:10px;">
                            <div class="row invoice-head" style="padding: 3%;">
                                <div class="col-md-7 col-xs-6">
                                    <div class="invoice-logo">

                                        <img src="{{\URL::to('admin_assets/pages/img/logos/logo5.jpg')}}" class="img-responsive" alt="" />

                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Received money from</label>
                                            <div class="col-md-4">
                                                    <select id="contact_id" name="contact_id" class="bs-select form-control" data-live-search="true" data-size="8">
                                                    </select>
                                            </div>
                                        </div>                               
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Name to be printed on receipt</label>
                                            <div class="col-md-4">
                                                <input type="text" id="receipt_name" name="receipt_name" class="form-control" style="width: 40">
                                            </div>
                                        </div>                               

                                    </div>
                                </div>
                                <div class="col-md-5 col-xs-6">
                                    <div class="company-address">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Receipt Date</label>
                                            <div class="col-md-4">
                                                <input type="text" value="{{date('d-m-Y')}}" readonly="" id="receipt_date" name="receipt_date" class="form-control" style="width: 40">
                                            </div>
                                        </div>                                


                                </div>
                            </div>
                                <div class="col-xs-12 table-responsive" style="overflow-x:visible !important;">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th> Category </th>
                                                <th> Description </th>
                                                <th> Amount </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody id="cat_items_div">
                                        </tbody>
                                    </table>
                                </div>

                                <a onclick="$.addCategory();" href="javascript:void(0);" style="float:right;" class="btn" href="">Add Item</a>

                                <div class="col-xs-12 table-responsive" style="overflow-x:visible !important;">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="53%;"></td>
                                                <th>Total</th>
                                                <th id="total_amount_lbl">0.00</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>



                            </div>


<!--                             <div class="row invoice-subtotal">
                                 <div class="col-xs-3">
                                    <h2 class="invoice-title uppercase">Subtotal</h2>
                                    <p class="invoice-desc">23,800$</p>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="invoice-title uppercase">Tax (0%)</h2>
                                    <p class="invoice-desc">0$</p>
                                </div>
                                 <div class="col-xs-6" style="float:right;">
                                    <h2 class="invoice-title uppercase">Total</h2>
                                    <p class="invoice-desc grand-total" id="total_amount"></p>
                                </div>
                            </div> 
-->

                            <div class="row  invoice-subtotal">

                                <div class="col-md-5">
                                    <textarea rows="7" class="form-control" id="notes" name="notes" placeholder="Enter Notes"></textarea>
                                </div>
                                <div class="col-md-7">
                                    <div class="col-xs-9">
                                        <table class="table">
                                            <thead>
                                                <tr><th width="40%;">Payment Mode</th><th>Pay Ref</th><th>Amount Paid</th></tr>
                                            </thead>
                                            <tbody id="payment_modes">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-12">
                                    <a class="btn btn-lg btn-primary" id="addEntity" style="float:right;">Save</a>
                                </div>
                            </div>
                        </div>

                </div>
            </form>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>

@endsection