<li class="header" style="font-weight:bold;">MAIN MENU</li>
<li class="{{ set_active('participant.dashboard') }}">
    <a href="{{ route('participant.dashboard') }}">
        <i class="fa fa-home"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('participant.payment') }}">
    <a href="{{ route('participant.payment') }}">
        <i class="fa fa-credit-card"></i> <span>Proof Of Payment</span>
    </a>
</li>

<li class="{{ set_active('participant.id_card') }}">
    <a href="{{ route('participant.id_card') }}">
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
