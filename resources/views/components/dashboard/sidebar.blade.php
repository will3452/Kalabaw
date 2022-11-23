<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <x-dashboard.sidebar-link icon="lnr lnr-home" href="{{route('home')}}" active="{{isActive(route('home'))}}">
                    Dashboard
                </x-dashboard.sidebar-link>



                @if (auth()->user()->type === \App\Models\User::TYPE_ADMIN)
                    <x-dashboard.sidebar-link icon="lnr lnr-users" href="{{route('usermanagement.index')}}" active="{{isActive(route('usermanagement.index'))}}">
                        Users Management
                    </x-dashboard.sidebar-link>

                @if (hasModule('Barangay'))
                    <x-dashboard.sidebar-link href="{{route('barangay.index')}}" icon="lnr lnr-location" active="{{isActive(route('barangay.index'))}}">
                        Barangay Management
                    </x-dashboard.sidebar-link>
                @endif

                @endif

                @if (hasModule('MapTag'))
                    <x-dashboard.sidebar-link href="{{route('maptag.index')}}" icon="lnr lnr-map" active="{{isActive(route('maptag.index'))}}">
                        Map
                    </x-dashboard.sidebar-link>
                @endif

                @if (hasModule('Farmer') && auth()->user()->type !== \App\Models\User::TYPE_ADMIN)
                    <li>
                        <a href="#farmers" data-toggle="collapse" class="collapsed"><i class="lnr lnr-database"></i> <span>Farmers</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="farmers" class="collapse ">
                            <ul class="nav ">
                                <li><a href="{{route('farmer.index')}}">Profiles</a></li>
                                <li><a href="{{route('crop.index')}}">Farm</a></li>
                                <li><a href="{{route('mae.index')}}">Machineries and Equipment</a></li>
                                <li><a href="{{route('tree.index')}}">Trees</a></li>
                                <li><a href="{{route('lop.index')}}">Livestock or Poultry</a></li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if (hasModule('Fishermen') && ! auth()->user()->is(\App\Models\User::TYPE_ADMIN))
                    <li>
                        <a href="#fishermens" data-toggle="collapse" class="collapsed"><i class="lnr lnr-database"></i> <span>Fishermen</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="fishermens" class="collapse ">
                            <ul class="nav ">
                                <li><a href="{{route('fishermen.index')}}">Profiles</a></li>
                                <li><a href="{{route('area.index')}}">Areas</a></li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if (hasModule('Inventory'))
                    <li>
                        <a href="#inventory" data-toggle="collapse" class="collapsed"><i class="lnr lnr-database"></i> <span>Inventories</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="inventory" class="collapse ">
                            <ul class="nav ">
                                <li><a href="{{route('item.index')}}">Inventory</a></li>
                                <li><a href="{{route('inventory.index')}}">Record of transaction</a></li>
                                <li><a href="{{route('unit.index')}}">Unit of measurements</a></li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if (hasModule('Bin') && ! auth()->user()->is(\App\Models\User::TYPE_ADMIN))
                    <x-dashboard.sidebar-link href="{{route('bin.index')}}" icon="lnr lnr-history" active="{{isActive(route('bin.index'))}}">
                        Archive
                    </x-dashboard.sidebar-link>
                @endif

                @if (hasModule('Association') && ! auth()->user()->is(\App\Models\User::TYPE_ADMIN))
                    <x-dashboard.sidebar-link href="{{route('assoc.index')}}" icon="lnr lnr-users" active="{{isActive(route('assoc.index'))}}">
                        Association
                    </x-dashboard.sidebar-link>
                @endif

                @if (hasModule('Announcement'))
                    <x-dashboard.sidebar-link href="{{route('announcement.index')}}" icon="lnr lnr-bullhorn" active="{{isActive(route('announcement.index'))}}">
                        Announcements
                    </x-dashboard.sidebar-link>
                @endif

                <x-dashboard.sidebar-link href="/reports" icon="lnr lnr-printer" active="{{isActive(route('report'))}}">
                    Reports
                </x-dashboard.sidebar-link>
                <x-dashboard.sidebar-link href="{{route('auth.logout')}}" icon="lnr lnr-exit" active="{{false}}">
                    Logout
                </x-dashboard.sidebar-link>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->
