<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('member.dashboard') }}">
    <a href="{{ route('member.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('member.abstrak') }}">
    <a href="{{ route('member.abstrak') }}">
        <i class="fa fa-newspaper-o"></i> <span>Manajemen Abstrak</span>
    </a>
</li>

<li class="{{ set_active('member.paper') }}">
    <a href="{{ route('member.paper') }}">
        <i class="fa fa-file-powerpoint-o"></i> <span>Full Paper & Presentasi</span>
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
