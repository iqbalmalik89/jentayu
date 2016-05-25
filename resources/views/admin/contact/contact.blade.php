@extends('admin.layouts.master')

@section('jsmodule', 'contact.js')
@section('content')



    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Assign roles to Contacts</h4>
                </div>
                <div class="modal-body" id="modal_body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" id="assignRoleBtn" class="btn green">Save changes</button>
                </div>
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
                <span>Contacts</span>
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
    <h3 class="page-title"> Contact
<!--         <small>User's Surveys</small> -->
    <a href="{{\URL::to('admin/contacts/roles')}}" style="float:right; margin-left: 10px;" class="btn dark" href="">Roles Type</a>

    <a id="addbtn" href="javascript:void(0);" style="float:right;" class="btn dark" href="">Add Contact</a>

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
                        <i class="fa fa-cogs"></i>Contacts </div>
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
                                <th width="15%"> Name </th>
                                <th width="20%"> NRIC </th>
                                <th width="20%"> Email </th>
                                <th width="8%" class="numeric"> Status </th>
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
                        <i class="fa fa-cogs"></i>Contacts </div>
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
                                <label class="col-md-3 control-label">Name</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Nric</label>
                                <div class="col-md-4">
                                                    <div class="input-icon right">
                                                    <i style="display:none;" id="nric_spinner" class="fa fa-spinner fa-spin font-blue"></i>
                                                    <input type="text" onblur="validateNRIC(this.value, '#nric'),$.checkNRIC(this.value);" class="form-control" id="nric" name="nric" placeholder="NRIC"> </div>

                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">DOB</label>
                                <div class="col-md-4">
                                    <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                                        <input type="text" class="form-control" readonly="" name="dob" id="dob">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">COB</label>
                                <div class="col-md-4">
                                <select id="cob" name="cob" class="form-control input-medium">
                                <?php echo App\Library\StaticData::allNationality(); ?>
                                </select>
                                </div>
                            </div>

                            <div class="form-group last">
                                <label class="col-md-3 control-label">Sex</label>
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" checked="checked" id="male_sex" value="male"> Male </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" id="female_sex" value="female"> Female </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Citizenship</label>
                                <div class="col-md-4">
                                <select id="citizenship" name="citizenship" class="form-control input-medium">
                                <?php echo App\Library\StaticData::allNationality(); ?>
                                </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Race</label>
                                <div class="col-md-4">
                                <select id="race" name="race" class="form-control input-medium">
                                <?php echo App\Library\StaticData::allRaces(); ?>
                                </select>
                                </div>
                            </div>


                            <div class="form-group last">
                                <label class="col-md-3 control-label">Marital Status</label>
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="marital_status" checked="checked" id="married_marital_status" value="male"> Married </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="marital_status" id="single_marital_status" value="female"> Single </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="marital_status" id="divorce_marital_status" value="divorce"> Divorce </label>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Address 1</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="address1" name="address1" placeholder="Address 1">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Address 2</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="address2" name="address2" placeholder="Address 2">
                                </div>
                            </div>                            

                            <div class="form-group">
                                <label class="col-md-3 control-label">Address 3</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="address3" name="address3" placeholder="Address 3">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Address 4</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="address4" name="address4" placeholder="Address 4">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Postal Code</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                            </div>






                            <div class="form-group">
                                <label class="col-md-3 control-label">Home Phone</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <input type="text" class="form-control" id="home_phone" name="home_phone" placeholder="Home Phone"> </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Mobile Phone</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-mobile"></i>
                                    </span>
                                    <input type="text" class="form-control" id="mobile_phone" name="mobile_phone" placeholder="Mobile Phone"> </div>
                                </div>
                            </div>



                            <div class="form-group last">
                                <label class="col-md-3 control-label">Status</label>
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="contact_status" checked="checked" id="active_status" value="active"> Active </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="contact_status" id="inactive_status" value="inactive"> Inactive </label>
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