<div class="list-group user-sidebar">
    {{ $smMyContact = $smOffer = $smUser = $smHome = $smBCard = ""  }}

    @php
    $currentUserID = Auth::guard('web')->id();

    $contactCount = DB::table('contacts')
                    ->where('user_id', $currentUserID)
                    ->where('status', 1)
                    ->get()
                    ->count();
    @endphp

    @if (request()->is('list*'))
    @php $mnuList = "active" @endphp
    @elseif (request()->is('home*'))
    @php $smHome = "active" @endphp
    @elseif (request()->is('contacts*'))
    @php $smMyContact = "active" @endphp
    @elseif (request()->is('offer*'))
    @php $smOffer = "active" @endphp
    @elseif (request()->is('update*'))
    @php $smUser = "active" @endphp
    @elseif (request()->is('cards/create*'))
    @php $smBCard = "active" @endphp
    @endif

    <a href="{{ route('home') }}" class="list-group-item {{ $smHome }}">
        <span class="glyphicon glyphicon-home"></span> 
        Dashboard
    </a>

    <a href="" class="list-group-item hide">
        <span class="glyphicon glyphicon-comment"></span> 
        Enquiries <span class="badge">0</span>
    </a>

    <a href="{{ route('contacts') }}" class="list-group-item {{ $smMyContact }}">
        <span class="fa fa-address-card"></span> 
        My Contacts 
        <span class="badge">
            <?php echo (!empty($contactCount) ? $contactCount : '0'); ?>
        </span>
    </a>

    <a href="{{ route('offers') }}" class="list-group-item {{ $smOffer }}">
        <span class="fa fa-bell-o"></span> 
        Offers
        <span class="badge">
            <?php echo (!empty($favCount) ? $favCount : '0'); ?>
        </span>
    </a>

    <a href="{{ route('feedbacks') }}"  class="list-group-item hide">
        <i class="glyphicon glyphicon-comment"></i>
        Chat Support
    </a>
     
    <a href="{{ route('card.create') }}"  class="list-group-item {{ $smBCard }}">
        <i class="glyphicon glyphicon-briefcase"></i> My Business vCard
    </a>
    
    <a href="{{ route('settings') }}" class="list-group-item {{ $smUser }}">
        <span class="glyphicon glyphicon-user"></span>
        My Profile 
    </a>

    <a href="/" class="list-group-item hide">
        <span class="glyphicon glyphicon-off"></span>
        Logout
    </a>
</div>