<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
        <a @if(Session::get('page')=="admin_master") style="background:#4B49AC !important; color:#fff !important" @endif class="nav-link" href="{{ url('admin/dashboard') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
        </li>
        @if(Auth::guard('admin')->user()->type=="vendor")
        <li class="nav-item">
            <a @if(Session::get('page')=="update_personal_details" || Session::get('page')=="update_business_details" || Session::get('page')=="update_bank_details") style="background:#4B49AC !important; color:#fff !important" @endif class="nav-link" data-toggle="collapse" href="#ui-vendors" aria-expanded="false" aria-controls="ui-vendors">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Vendor Details</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-vendors" >
                <ul class="nav flex-column sub-menu" style="background:#fff !important; color:#4B49AC !important">
                    <li class="nav-item"> <a @if(Session::get('page')=="update_personal_details") style="background:#4B49AC !important; color:#fff !important" @else style="background:#fff !important; color:#4B49AC !important" @endif class="nav-link" href="{{ url('admin/update-vendor-details/personal') }}">Personal Details</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="update_business_details") style="background:#4B49AC !important; color:#fff !important" @else style="background:#fff !important; color:#4B49AC !important" @endif class="nav-link" href="{{ url('admin/update-vendor-details/business') }}">Business Details</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="update_bank_details") style="background:#4B49AC !important; color:#fff !important" @else style="background:#fff !important; color:#4B49AC !important" @endif class="nav-link" href="{{ url('admin/update-vendor-details/bank') }}">Bank Details</a></li>
                </ul>
            </div>
        </li>
        @else
        <li class="nav-item">
            <a @if(Session::get('page')=="update_admin_password" || Session::get('page')=="update_admin_details") style="background:#4B49AC !important; color:#fff !important" @endif class="nav-link" data-toggle="collapse" href="#ui-settings" aria-expanded="false" aria-controls="ui-settings">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Admin Details</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-settings">
                <ul class="nav flex-column sub-menu" style="background:#fff !important; color:#4B49AC !important">
                <li class="nav-item"> <a @if(Session::get('page')=="update_admin_password") style="background:#4B49AC !important; color:#fff !important" @else style="background:#fff !important; color:#4B49AC !important" @endif class="nav-link" href="{{ url('admin/update-superadmin-password') }}">Update Password</a></li>
                <li class="nav-item"> <a @if(Session::get('page')=="update_admin_details") style="background:#4B49AC !important; color:#fff !important" @else style="background:#fff !important; color:#4B49AC !important" @endif class="nav-link" href="{{ url('admin/update-superadmin-personal-details') }}">Update Details</a></li>
                <!-- <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li> -->
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="view_admins" || Session::get('page')=="view_subadmins" || Session::get('page')=="view_vendors" || Session::get('page')=="view_all") style="background:#4B49AC !important; color:#fff !important" @endif class="nav-link" data-toggle="collapse" href="#ui-admins" aria-expanded="false" aria-controls="ui-admins">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Admins Manage</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-admins">
                <ul class="nav flex-column sub-menu" style="background:#fff !important; color:#4B49AC !important">
                    <li class="nav-item"><a @if(Session::get('page')=="view_admins") style="background:#4B49AC !important; color:#fff !important" @else style="background:#fff !important; color:#4B49AC !important" @endif class="nav-link" href="{{ url('admin/admins/admin') }}">Admins</a></li>
                    <li class="nav-item"><a @if(Session::get('page')=="view_subadmins") style="background:#4B49AC !important; color:#fff !important" @else style="background:#fff !important; color:#4B49AC !important" @endif class="nav-link" href="{{ url('admin/admins/subadmin') }}">Subadmins</a></li>
                    <li class="nav-item"><a @if(Session::get('page')=="view_vendors") style="background:#4B49AC !important; color:#fff !important" @else style="background:#fff !important; color:#4B49AC !important" @endif class="nav-link" href="{{ url('admin/admins/vendor') }}">Vendors</a></li>
                    <li class="nav-item"><a @if(Session::get('page')=="view_all") style="background:#4B49AC !important; color:#fff !important" @else style="background:#fff !important; color:#4B49AC !important" @endif class="nav-link" href="{{ url('admin/admins') }}">All</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="sections" || Session::get('page')=="categories" || Session::get('page')=="product") style="background:#4B49AC !important; color:#fff !important" @endif class="nav-link" data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Catalogue Manage</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-catalogue">
                <ul class="nav flex-column sub-menu" style="background:#fff !important; color:#4B49AC !important">
                    <li class="nav-item"><a @if(Session::get('page')=="sections") style="background:#4B49AC !important; color:#fff !important" @else style="background:#fff !important; color:#4B49AC !important" @endif class="nav-link" href="{{ url('admin/sections') }}">Sections</a></li>
                    <li class="nav-item"><a @if(Session::get('page')=="categories") style="background:#4B49AC !important; color:#fff !important" @else style="background:#fff !important; color:#4B49AC !important" @endif class="nav-link" href="{{ url('admin/categories') }}">Categories</a></li>
                    <li class="nav-item"><a @if(Session::get('page')=="brands") style="background:#4B49AC !important; color:#fff !important" @else style="background:#fff !important; color:#4B49AC !important" @endif class="nav-link" href="{{ url('admin/brands') }}">Brand</a></li>
                    <li class="nav-item"><a @if(Session::get('page')=="products") style="background:#4B49AC !important; color:#fff !important" @else style="background:#fff !important; color:#4B49AC !important" @endif class="nav-link" href="{{ url('admin/products') }}">Product</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-users" aria-expanded="false" aria-controls="ui-users">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">User Manage</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-users">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ url('admin/users') }}">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('admin/subscribers') }}">Subscribers</a></li>
                </ul>
            </div>
        </li>
        @endif
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
            <i class="icon-columns menu-icon"></i>
            <span class="menu-title">Form elements</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
            </ul>
        </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
            <i class="icon-bar-graph menu-icon"></i>
            <span class="menu-title">Charts</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="charts">
            <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
            </ul>
        </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
            <i class="icon-grid-2 menu-icon"></i>
            <span class="menu-title">Tables</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
            <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
            </ul>
        </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
            <i class="icon-contract menu-icon"></i>
            <span class="menu-title">Icons</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="icons">
            <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
            </ul>
        </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="icon-head menu-icon"></i>
            <span class="menu-title">User Pages</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
            </ul>
        </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
            <i class="icon-ban menu-icon"></i>
            <span class="menu-title">Error pages</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="error">
            <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
            </ul>
        </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="pages/documentation/documentation.html">
            <i class="icon-paper menu-icon"></i>
            <span class="menu-title">Documentation</span>
        </a>
        </li>
    </ul>
</nav>