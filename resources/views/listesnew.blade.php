@extends('template')

@section('a')
    <a class="navbar-brand" href="{{ route('board.index') }}"><i class="ti-arrow-left"></i> Retour aux boards</a>
@endsection

@section('li')
    @if ($array['board']->users()->where('user_id', $user->id)->first()->pivot->role=='owner')
    <li>
        <a  href="#confirm"  data-toggle="modal">
            <p> <i class="ti-close"></i> Supprimer board</p>
        </a>
    </li>
    @endif

    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <p> <i class="ti-user"></i> Membres du board</p>
        </a>
            <ul class="dropdown-menu " style="width:270px" id="listmember">
                <li class="dropdown-header">Membres du board</li>
                @foreach ($array['members'] as $member)
                <li><a href="#">{{$member->name}} ({{$member->pivot->role}})</a></li>
                    <input type="hidden" class="itemmail" value="{{ $member->email }}">
                @endforeach
                <li class="divider"></li>
                <br/>
                <li class="input-group">
                    {!! Form::open() !!}
                    {!! Form::email('membre',null, ['class' => 'form-control', 'placeholder' => 'Entrez un membre','style'=>'width:84%;height:40px;padding-right:70px','id'=>'member-mail','required'=>'true']) !!}
                    <div id="members-list"></div>
                    {{ Form::button('<i class="ti-plus" style="color:#b6bbbf"></i>', ['class' => 'btn-success','style'=>'height:40px','id'=>'addMember','disabled'=>'false'] )  }}
                    {!! Form::close() !!}
                </li>
            </ul>
    </li>


@endsection

@section('linav')
    <li class="active">
        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" >
            <i class="ti-angle-right"></i>
            <p>Mes boards</p>
        </a>
        <ul class="collapse nav" id="pageSubmenu">
            @foreach ($boards as $board2)
                <li>
                    <a href="{{route('board.show',['board'=>$board2->id_board])}}" ><p>{{$board2->titre}}</p></a>
                </li>
            @endforeach
        </ul>

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

@section('body')
    <div class="wrapper">
        @include('sidebar')
        <div class="main-panel">
            @include('sidebarhorizontal')
            <div class="content" style="padding-bottom: 5px;padding-top: 5px;">
                <h3 style="margin:15px 1px;"><i class=" ti-panel "></i> {{$array['board']->titre}}</h3>
                <div class="flex-container" >
                    @foreach($array['listes'] as $liste)
                        <div class="card card-style myList " style="background-color:#e2e4e6">
                            <input type="hidden" value="{{$liste->id_liste}}" class="listids">
                            <div class="content flex">
                                    <h5 class="text-center title-list" style="white-space:initial;">{{$liste->titre}}</h5>
                                <div class="card-body">
                                    <hr />
                                        <a class="addCard" href="#"><i class="ti-plus"></i> Ajouter une carte</a>
                                    <div class="listcards pre-scrollable" >
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                <div class="card card-style list-style" style="background-color:#e2e4e6;padding-left: 8px;padding-right: 8px;padding-top: 8px" id="addedList">
                        <h5 class="text-center" id="list-title" ><a href='#' style="color:#000000"  id="addList"> <i class="ti-plus"></i> Ajouter une liste</a></h5>
                         {!! Form::open(['style'=>'display:none','id'=>'form-list']) !!}
                         {!! Form::text('titre',null, ['class' => 'form-control', 'placeholder' => 'Entrez une liste','id'=>'titre','required'=>'true']) !!}
                            <div class="listinputs" style="margin-top: 9px;">
                                {{ Form::button('Ajouter liste',['class' => 'btn btn-fill','style'=>'background:#32CD32;border-radius:0px;float: left','id'=>'addListButton'] )  }}
                                <button type='button' class='close' aria-label='Close' style="padding-right: 8px;padding-left: 8px;margin-left: 0px;padding-bottom: 10px;display: inline-block" id="closelist"><span aria-hidden='true'>&times;</span></button>
                                {!! Form::close() !!}
                            </div>
                        </form>
                </div>



                </div>
                </div>

            </div>
            </div>
        </div>
    @include('cancelmodal')


    <script>
        $(document).ready(function () {
            var i = 1;
            var array = [];
            var card;
            $('.itemmail').each(function () {
                array.push($(this).val());
            });


            $('#member-mail').keyup(function () {

                $("#addMember").prop('disabled', true);
                var query = $(this).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                        url: "{{ route('autocomplete.fetch') }}",
                        method: "POST",
                        data: {query: query, _token: _token, members: array},
                        success: function (data) {
                            $('#members-list').fadeIn();
                            $('#members-list').html(data);
                            $('.item-mail').each(function () {
                                var a;
                                for (a = 0; a < array.length; a++) {
                                    if ($(this).text() == array[a]) {
                                        $(this).addClass('act');
                                    }
                                }

                            });
                        }
                    });





                $(document).on('click', '.item-mail', function () {
                    $('#member-mail').val($(this).text());
                    $("#addMember").removeAttr("disabled");
                    $('#members-list').fadeOut();
                });


            });

            /* Add a list to a board */

            $('#addListButton').click(function (){

                var _position=$('#addedList').index();
                var _titre=$('#titre').val();
                var _token = $('input[name="_token"]').val();

                if(_titre!=''){

                    $.ajax({

                        url:"{{route('storelist',['board'=>$array['board']->id_board])}}",
                        method:"POST",
                        data:{list_position:_position,_token:_token,titre:_titre },

                        success:function(data){

                            $('#addedList').before(data);
                            $('#titre').val('');
                            $('#form-list').hide();
                            $('#addedList').removeClass('list-style2');
                            $('#addedList').addClass('list-style');
                            $('#list-title').show();

                            $.notify({

                                icon: 'ti-view-list',
                                message: "Liste ajoutée."

                            },{
                                type: 'success',
                            });
                        }
                    });
                }

                else {
                    console.log('The list dont should be empty');
                }




            });

            /* Add cards from lists */

            $('#listgroup').on('click',".addCard",function(e) {
                $(this).next().append("<div class='card card-list' style='padding-top: 5px;padding-bottom: 20px;padding-left: 10px;padding-right: 10px'>" +
                    "<button type='button' class='close' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
                    "<div class='card-body'><form method='post'>" +
                    "<textarea class='form-control' placeholder='Entrez un titre' style='margin-bottom: 10px;height:70px' id='card-title'/>" +
                    "<input type='submit' value='Ajouter carte' class='btn btn-fill form-control' id='ajaxSubmit' style='background:#32CD32;boarder-radius:0px'/></form> </div></div>");

                $(".card-list").each(function (a,item) {
                    $(item).find("button.close").click(function () {
                        $(item).remove();
                    })
                });

            });


            /* Add member to a board */

            $('#addMember').click(function (){
                console.log($('#member-mail').val());
                var _mail=$('#member-mail').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{route('autocomplete.post',['board'=>$array['board']->id_board])}}",
                    method:"POST",
                    data:{user_mail:_mail,_token:_token},
                    success:function(data){
                        console.log(data);
                        $(".divider").before(data);
                        array.push(_mail);
                        $("#addMember").prop('disabled', true);
                        $.notify({
                            icon: 'ti-user',
                            message: "Membre ajouté."

                        },{
                            type: 'success',
                        });


                    }

                });



            });



            //$('.myList').draggable();
            var initial_position;
            var dragged_position;
            var id_liste;
            $('.cont').sortable({

                connectWith: '.cont',

                start: function( event,ui ) {
                    initial_position= ui.item.index();
                    id_liste=ui.item.children("input.listids").val();

                },

                stop: function( event,ui ) {
                    dragged_position=ui.item.index();
                    $.ajax({
                        url:"{{route('updateposition',['board'=>$array['board']->id_board])}}",
                        method:"PUT",
                        data:{id_liste:id_liste,initial_position:initial_position,dragged_position:dragged_position},
                        success:function(data){
                            console.log(data);
                        }
                    });
                }
                //placeholder: 'my-placeholder'
            });

            /* Show list form input */

            $('#list-title').click(function () {
                $(this).hide();
                $('#addedList').removeClass('list-style');
                $('#addedList').addClass('list-style2');
                $('#form-list').show();
            })

            $('#closelist').click(function () {
                $('#form-list').hide();
                $('#addedList').removeClass('list-style2');
                $('#addedList').addClass('list-style');
                $('#list-title').show();
            })








        })
    </script>
@endsection
