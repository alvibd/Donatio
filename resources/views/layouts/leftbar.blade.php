<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('admin/images/user.png') }}" width="48" height="48" alt="User"/>
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true"
                 aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->name }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{{ route('user.profile.edit', ['user' => Auth::user()]) }}"><i class="material-icons">person</i>Profile</a>
                    </li>
                    <li role="separator" class="divider"></li>
                    {{-- <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                    <li role="separator" class="divider"></li> --}}
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"><i
                                    class="material-icons">input</i>Sign Out</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="{{ route('home') }}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            @if(Auth::user()->hasRole('superadministrator'))
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">supervised_user_circle</i>
                        <span>User Management</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('admin.user.list') }}">
                                <span>Users' List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">supervised_user_circle</i>
                        <span>Roles &amp; Permissions Management</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('admin.role.list') }}">
                                <span>Roles' List</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.role.create') }}">
                                <span>Create Role</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.permission.list') }}">
                                <span>Permissions' List</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.permission.create') }}">
                                <span>Create Permission</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.advertiser.list') }}">
                        <i class="material-icons">domain</i>
                        <span>Advertisers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.adverts.list') }}">
                        <i class="material-icons">domain</i>
                        <span>All Adverts</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.ngo.list') }}">
                        <i class="material-icons">domain</i>
                        <span>All NGOs</span>
                    </a>
                </li>
            @endif
            @if(Auth::user()->hasRole('user|advertiser'))
                <li>
                    <a href="{{ route('advertiser.create') }}">
                        <i class="material-icons">domain</i>
                        <span>Add Advertiser Profile</span>
                    </a>
                </li>
            @endif
            @if(Auth::user()->hasRole('advertiser'))
                <li>
                    <a href="{{ route('advertiser.list', ['user' => Auth::user()]) }}">
                        <i class="material-icons">domain</i>
                        <span>My Advertiser Profiles</span>
                    </a>
                </li>
            @endif
            @if(Auth::user()->hasRole('user'))
                <li>
                    <a href="{{ route('non_profit_organization.create') }}">
                        <i class="material-icons">domain</i>
                        <span>Add NGO Profile</span>
                    </a>
                </li>
            @endif
            @if(Auth::user()->hasRole('non_profit_organization'))
                <li>
                    <a href="{{ route('non_profit_organization.profile', ['organization' => Auth::user()->nonProfitOrganization]) }}">
                        <i class="material-icons">domain</i>
                        <span>My Organization</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->