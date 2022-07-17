<li class="header" style="font-weight:bold;">MAIN MENU</li>
<li class="{{ set_active('presenter.dashboard') }}">
    <a href="{{ route('presenter.dashboard') }}">
        <i class="fa fa-home"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('presenter.abstrak') }}">
    <a href="{{ route('presenter.abstrak') }}">
        <i class="fa fa-newspaper-o"></i> <span>Submit Abstract</span>
    </a>
</li>

<li class="{{ set_active('presenter.paper') }}">
    <a href="{{ route('presenter.paper') }}">
        <i class="fa fa-file-powerpoint-o"></i> <span>Full Paper & Presentation</span>
    </a>
</li>

<li class="{{ set_active('presenter.paper') }}">
    <a href="{{ route('presenter.paper') }}">
        <i class="fa fa-id-card"></i> <span>ID Card</span>
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
