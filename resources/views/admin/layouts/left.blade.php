                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler"> </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        <li class="sidebar-search-wrapper">
                            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                            <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                                <a href="javascript:;" class="remove">
                                    <i class="icon-close"></i>
                                </a>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <a href="javascript:;" class="btn submit">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </span>
                                </div>
                            </form>
                            <!-- END RESPONSIVE QUICK SEARCH FORM -->
                        </li>

                        <li class="nav-item start {{App\Library\Utility::selectedNav(array('admin/users'))}}">
                            <a href="{{\URL::to('admin/users')}}" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Users</span>
                            </a>
                        </li>

                        <li class="nav-item start {{App\Library\Utility::selectedNav(array('admin/security', 'admin/security/modules'))}}">
                            <a href="{{\URL::to('admin/security')}}" class="nav-link nav-toggle">
                                <i class="icon-lock"></i>
                                <span class="title">Security & Permissions</span>
                            </a>
                        </li>

                        <li class="nav-item start {{App\Library\Utility::selectedNav(array('admin/contacts', 'admin/contacts/roles'))}}">
                            <a href="{{\URL::to('admin/contacts')}}" class="nav-link nav-toggle">
                                <i class="icon-users"></i>
                                <span class="title">Contacts</span>
                            </a>
                        </li>

                       <li class="nav-item start {{App\Library\Utility::selectedNav(array('admin/receipt/cat-items', 'admin/receipt/cat-items'))}}">
                            <a href="{{\URL::to('admin/receipt/cat-items')}}" class="nav-link nav-toggle">
                                <i class="icon-users"></i>
                                <span class="title">Categroy Items</span>
                            </a>
                        </li>

                       <li class="nav-item start {{App\Library\Utility::selectedNav(array('admin/receipt', 'admin/receipt'))}}">
                            <a href="{{\URL::to('admin/receipt')}}" class="nav-link nav-toggle">
                                <i class="icon-doc"></i>
                                <span class="title">Receipts</span>
                            </a>
                        </li>

                    </ul>