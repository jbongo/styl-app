
@section('header')
<div class="header">
        <div class="pull-left">
            <div class="logo"><a href="/"><img src="{{ asset('/images/logo.png') }}" alt="logo" /></div>
            <div class="hamburger sidebar-toggle">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
        <div class="pull-right p-r-15">
            <ul>
                <li class="header-icon dib"><a href="#search"> <i class="large material-icons">search</i></a></li>
                <li class="header-icon dib"><i class="large material-icons">notifications</i> @if (count(auth()->user()->unReadNotifications) > 0)<span class="badge badge-pill badge-danger" style="border-radius: 112px 112px 112px 112px;">{{count(auth()->user()->unReadNotifications)}}</span>@endif
                    <div class="drop-down">
                        <div class="dropdown-content-heading">
                            <span class="text-left">Notifications récentes</span>
                        </div>
                        <div class="dropdown-content-body">
                            <ul>
                                @foreach (auth()->user()->unReadNotifications as $notification)
                                <li class="notification-unread">
                                    <a href="">
                                        <img class="pull-left m-r-10 avatar-img" src="{{asset('images/avatar/3.jpg')}}" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">{{$notification->updated_at->format('d/m/Y H:m')}}</small>
                                            <div class="notification-heading">{{$notification->data['nom_user']}}</div>
                                            <div class="notification-text">{{$notification->data['message']}}</div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach

                                <li class="text-center">
                                <a href="{{ route('notif.list') }}" class="more-link">Afficher tous</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="header-icon dib"><i class="large material-icons">mail</i><span class="badge badge-pill badge-danger" style="border-radius: 112px 112px 112px 112px;"></span>
                    <div class="drop-down">
                        <div class="dropdown-content-heading">
                            <span class="text-left">Messages</span>
                            <a href="email.html"><i class="ti-pencil-alt pull-right"></i></a>
                        </div>
                        <div class="dropdown-content-body">
                            <ul>
                                <li class="">
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="{{asset('images/avatar/3.jpg')}}" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Expediteur</div>
                                            <div class="notification-text">Je suis un exemple lu ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="text-center">
                                    <a href="#" class="more-link">Voir tous</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="header-icon dib"><img class="avatar-img" src="{{asset('/images/photo_profile/'.((Auth::user()->photo_profile) ? Auth::user()->photo_profile : "user.png"))}}" alt="" /> <span class="user-avatar hide_stuff">{{ Auth::user()->prenom }}<i class="ti-angle-down f-s-10"></i></span>
                    <div class="drop-down dropdown-profile">
                        <div class="dropdown-content-heading">
                            <span class="text-left">Statut</span>
                            <p class="trial-day">En Ligne</p>
                        </div>
                        <div class="dropdown-content-body">
                            <ul>
                                <li><a href="{{route('user.profile')}}"><i class="ti-user"></i> <span>Profil</span></a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="ti-power-off"></i> <span>Logout</span></a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection
