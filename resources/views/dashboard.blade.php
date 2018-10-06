@extends('template')
@section('a')
    <a class="navbar-brand" href="{{ route('board.index') }}">Mes boards</a>
@endsection

@section('linav')
    <li class="active">
        <a href="{{route('board.index')}}">
            <i class="ti-angle-right"></i>
            <p>Mes boards</p>
        </a>

    </li>

    <li>
      <a href="{{route('profil.show',['user'=>$user->id])}}"><i class="ti-user"></i> <p>Mon profile</p></a>
    </li>
    <li>
        <a href="{{ url('/logout') }}"
           onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
            <i class="ti-arrow-right"></i>
            <p>Se deconnecter</p>
        </a>

        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>

@endsection

@section('li')


@endsection
@section('body')
    <div class="wrapper">
        @include('sidebar')
        <div class="main-panel">
            @include('sidebarhorizontal')
            <div class="content">
                <h3 style="margin:2px 1px;"><i class="ti-user"></i> Boards personnels</h3>
                <br/>
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-lg-3 col-sm-6">
                            <a href="#">
                            <div class="card" style="height: 16rem;background-color:#00008B">
                                <div class="content ">
                                    <div class="row">
                                        <h5 class="text-center" style="color:#ffffff">Board de bienvenue</h5>
                                    </div>
                                    <div class="footer">
                                        <hr style="border-color: white"/>
                                        <div class="stats">
                                            <p class="text-center"><i class="ti-pencil"></i> Ce board est un board de
                                                bienvenue .....</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        @foreach ($boards as $board)
                            <a href="{{route('board.show',['board'=>$board->id_board])}}">
                            <div class="col-lg-3 col-sm-6">
                                <div class="card" style="height: 16rem;background-color:#32CD32">
                                    <div class="content ">
                                        <div class="row">
                                            <h5 class="text-center" style="color:#ffffff">{{$board->titre}}</h5>
                                        </div>
                                        <div class="footer">
                                            <hr style="border-color: white"/>
                                            <div class="stats">
                                                <p class="text-center"><i class="ti-pencil"></i> {{$board->description}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        @endforeach

                        <div class="col-lg-3 col-sm-6">
                            <div class="card" style="height: 16rem;background-color:#D3D3D3">
                                <div class="content">
                                    <div class="row">
                                        <h5 class="text-center"><a href='' style="color:#000000" data-toggle="modal"
                                                                   data-target="#myModal"> <i class="ti-plus"></i> Add a
                                                new board</a></h5>
                                    </div>
                                    <div class="footer">
                                        <hr/>
                                        <div class="stats">
                                            <p class="text-center"><i class="ti-pencil"></i> You can add a new board by
                                                clicking to "Add new board"....</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('boardmodal')


@endsection
