<li class="header" style="font-weight:bold;">MAIN MENU</li>
<li class="{{ set_active('administrator.dashboard') }}">
    <a href="{{ route('administrator.dashboard') }}">
        <i class="fa fa-home"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('administrator.abs_verif') }}">
    <a href="{{ route('administrator.abs_verif') }}">
        <i class="fa fa-check-circle"></i> <span>Abstract Verification</span>
    </a>
</li>

<li class="{{ set_active('administrator.payment') }}">
    <a href="{{ route('administrator.payment') }}">
        <i class="fa fa-credit-card"></i> <span>Payment Proof Verification</span>
    </a>
</li>

<li class="{{ set_active('administrator.proof') }}">
    <a href="{{ route('administrator.proof') }}">
        <i class="fa fa-newspaper-o"></i> <span>All Payment Proof List</span>
    </a>
</li>

<li class="{{ set_active('administrator.all') }}">
    <a href="{{ route('administrator.all') }}">
        <i class="fa fa-newspaper-o"></i> <span>All Abstract List</span>
    </a>
</li>

<li class="{{ set_active('administrator.settings') }}">
    <a href="{{ route('administrator.settings') }}">
        <i class="fa fa-cog"></i> <span>Settings</span>
    </a>
</li>

<li style="padding-left:2px;">
    <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off text-danger"></i>{{__('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

</li>
