@section('navbar')
<aside class="sidebar-left">
        <h1>
            <a href="index.html" class="logo">
                <img style="margin-right:56px;" src="{{asset('images/visiteurs/logo2.png')}}" alt="" />
            </a>
        </h1>
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="{{Route('guestusers.home')}}">
                    <i class="fas fa-angle-double-right"></i>
                    <span>ACCUEIL</span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{Route('guest.document.index')}}">
                    <i class="fas fa-file"></i>
                    <span>DOCUMENTS</span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{Route('guest.bien.index')}}">
                    <i class="fas fa-home"></i>
                    <span>BIEN</span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{Route('guest.affaire.index')}}">
                    <i class="fas fa-briefcase"></i>
                    <span>SUIVI AFFAIRE</span>
                </a>
            </li>
        </ul>
        <button type="button" id="logout_ok" href="{{ route('guestusers.logout') }}" class="btn btn-info btn-lg btn-block mt-5 w3ls-btn p-1 text-uppercase font-weight-bold" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            Deconnexion
    </button>
        <form id="logout-form" action="{{ route('guestusers.logout') }}" method="POST" class="hide">
            @csrf
        </form>
    </aside>
@endsection