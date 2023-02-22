<!-- NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid " >


        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth" ><i title="Hide/Show Sidebar" class="lnr lnr-arrow-left-circle"></i> </button>

        </div>
        <h1 class="navbar-btn">
            AgriAssistance
        </h1>
        @if (hasModule('Searchbar'))
            <x-searchbar></x-searchbar>
        @endif


        <div id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">


                @if (hasModule('Notification'))
                    <x-notification></x-notification>
                @endif

                <x-dropdown label='<span>{{auth()->user()->name}}</span>'>
                    @if (hasModule('Profile'))
                        <li><a href="/profile"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                    @endif
                    @if (hasModule('Message'))
                        <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
                    @endif
                    @if (hasModule('Setting'))
                        <li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
                    @endif
                    @if (hasModule('Auth'))
                        <li><a href="{{route('auth.logout')}}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                    @endif
                </x-dropdown>
            </ul>
        </div>
    </div>
</nav>
<!-- END NAVBAR -->
