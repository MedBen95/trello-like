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
            <ul class="dropdown-menu  " style="width:270px" id="listmember">
                <li class="dropdown-header">Membres du board</li>
                @foreach ($array['members'] as $member)
                <li  class="li-member"><a href="#">{{$member->name}} ({{$member->pivot->role}})</a></li>
                    <input type="hidden" class="itemmail" value="{{ $member->email }}">
                @endforeach
                <li class="divider"></li>
                <br/>
                <li class="input-group">
                    {!! Form::open() !!}
                    {!! Form::email('membre',null, ['class' => 'form-control', 'placeholder' => 'Entrez un membre','style'=>'width:87%;height:40px;padding-right:70px','id'=>'member-mail','required'=>'true']) !!}
                    <div id="members-list"></div>
                    {{ Form::button('<i class="ti-plus " id="addIconMember" style="color:#b6bbbf"></i>', ['class' => 'btn-success','style'=>'height:40px','id'=>'addMember','disabled'=>'false'] )  }}
                    {!! Form::close() !!}
                </li>
            </ul>
    </li>

    @include('notifications')


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

@section('body')
    <div class="wrapper">
        @include('sidebar')
        <div class="main-panel">
            @include('sidebarhorizontal')
            <div class="content" style="padding-bottom: 5px;padding-top: 5px;">
                <h3 style="margin:15px 1px;"><i class=" ti-panel "></i> {{$array['board']->titre}}</h3>
                <div class="cont" id="listgroup">
                    @foreach($array['listes'] as $liste)
                        <div class="card card-style myList dynamiclists " style="background-color:#e2e4e6">
                            <input type="hidden" value="{{$liste->id_liste}}" class="listids">
                            <div class="content flex" style="padding-left: 4px;padding-right: 4px;">
                                <!--<div class="list-options" style="margin-bottom: -10px;">
                                    <i class="ti-more" style="float: right;padding-right: 10px;"></i>
                                    </div>-->
                                    <h5 class="text-center title-list" style="overflow-wrap: break-word;white-space: initial;">{{$liste->titre}}</h5>
                                <div class="card-body">
                                <!-- <hr /> -->
                                    <input type="hidden" value="{{$liste->id_liste}}">


                                    <div class="listcards pre-scrollable" style="padding-top: 20px;" >

                                        @foreach($liste->cards()->orderBy('card_position','asc')->get() as $card)
                                            <div class='card card-list cards ' style='padding-top: 5px;padding-bottom: 5px;padding-left: 5px;padding-right: 5px;border-radius: 3px;margin-bottom: 8px' data-toggle="modal" data-target="#cardModal" data-comments="{{$card->comments}}" data-users="@foreach($card->comments as $comment){{$comment->user->name}},@endforeach" data-card-users="@foreach($card->users as $user2){{$user2->name}},@endforeach" data-labels="{{$card->labels}}">
                                                <div class='card-body '>

                                                    <div class="labels" @if(count($card->labels)==0) style="display: none" @endif>
                                                        @foreach($card->labels as $label)
                                                            <span class="label  span-label {{$label->color}}" >{{$label->name}}</span>
                                                        @endforeach
                                                    </div>

                                                    <p class="titrecarte" style="overflow-wrap: break-word;white-space: initial">{{$card->titre}}</p>
                                                    <input class="cardsid" type="hidden" value="{{$card->id_carte}}"/>
                                                    <input class="carddescription" type="hidden" value="{{$card->description}}" />
                                                </div>
                                                <div class="card-infos">
                                                    <span class="badge descriptionspan"  @if($card->description==null) style="display: none" @endif><i class="ti-align-justify"></i></span>
                                                    <span class="badge commentspan"  @if(count($card->comments)==0) style="display: none" @endif><i class="ti-comment"></i> {{count($card->comments)}} </span>
                                                    <span class="badge userspan" @if(count($card->users)==0) style="display: none" @endif><i class="ti-user"></i> {{count($card->users)}}</span>
                                                    <span class="badge" style="display: none"><i class="ti-file"></i> 0</span>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class='card card-list form-card' style='padding-top: 5px;padding-bottom: 5px;padding-left: 5px;padding-right: 5px;height: 140px;display:none'>
                                                <div class='card-body '>
                                                    {!! Form::open() !!}
                                                    {!! Form::textarea('titrecarte',null, ['class' => 'form-control cards-input', 'placeholder' => 'Entrez une carte','required'=>'true','style'=>'height: 80px;']) !!}
                                                    <div class="listinputs" style="margin-top: 9px;">
                                                        {{ Form::button('Ajouter carte',['class' => 'btn btn-fill addCardButton','style'=>'background:#32CD32;border-radius:0px;float: left'] )  }}
                                                        <button type='button' class='closeCard close' aria-label='Close' style="padding-right: 8px;padding-left: 8px;margin-left: 0px;padding-bottom: 10px;display: inline-block" ><span aria-hidden='true'>&times;</span></button>
                                                    </div>
                                                    {!! Form::close() !!}

                                                </div>
                                            </div>

                                    </div>
                                    <a class="addCard" href="#"><i class="ti-plus"></i> Ajouter une carte</a>
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

                </div>

                </div>
                </div>

            </div>
            </div>
        </div>
    @include('cancelmodal')
    @include('cardmodal')

<script >

    $(document).ready(function () {
        var i = 1;
        var array = [];
        var liste_id_initial;
        var liste_id_dragged;
        var finalposition;

        var card_initial_position;
        var card_dragged_position;
        var card_id;
        var card_id_dragged;
        var last_position;
        var _token = $('meta[name="csrf-token"]').attr('content');
        var card_comments;
        var comments_users;
        var users;
        var comments;
        var date;
        var date_array;
        var array_members=[];
        var card_users;
        var alllabels;

        Pusher.logToConsole = true;
        console.log(_token);

        var pusher = new Pusher('0ae9aa0311b9c4a9c3df', {
            cluster: 'ap1', encrypted: true,authEndpoint: '{{ route('authEndpoint') }}',auth: {
            headers: {
            'X-CSRF-Token':'{{ csrf_token() }}'
            }
          }
        });

        var channel = pusher.subscribe('private-App.User.'+'{{$user->id}}');
        channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {

          //alert(data.message);
          var notification=$('#notifications').find('.notification');


          var notication_value=notification.val();
          //notication_value=parseInt(notication_value)+1;

          console.log(notication_value);
          notification.val(notication_value.toString());

          notification.css('color','red');
          notification.show();


          $('#notificationmenu').append(' <li ><a href="#" class="notificationlink">'+data.message+'</a></li>');


        });

        channel.bind('pusher:subscription_succeeded', function(members) {
            console.log('successfully subscribed!');
        });

        console.log(pusher);





        $('.itemmail').each(function () {
            array.push($(this).val());
        });


        $('#member-mail').keyup(function () {

            $("#addMember").prop('disabled', true);
            $("#addIconMember").css('color', '#b6bbbf');
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
                $("#addIconMember").css('color', 'white');
                $('#members-list').fadeOut();
            });


        });

        /* Add a list to a board */

        $('#addListButton').click(function () {

            var _position = $('#addedList').index();
            var _titre = $('#titre').val();
            var _token = $('input[name="_token"]').val();

            if (_titre != '') {

                $.ajax({

                    url: "{{route('storelist',['board'=>$array['board']->id_board])}}",
                    method: "POST",
                    data: {list_position: _position, _token: _token, titre: _titre},

                    success: function (data) {

                        $('#addedList').before(data);
                        $('#titre').val('');

                        $.notify({

                            icon: 'ti-view-list',
                            message: "Liste ajoutée.",


                        }, {
                            type: 'success',
                        });

                        console.log($(".listcards").last());
                        $('.listcards ').last().sortable({

                            connectWith: ".listcards",
                            delay: 300,
                            scrollSpeed: 40,
                            scrollSensitivity: 10,
                            scroll: true,
                            appendTo: '#listgroup',
                            helper: "clone",
                            forcePlaceholderSize: true,
                            forceHelperSize: true,
                            cursor: "grab",
                            placeholder: "cardholder",

                            start: function (event, ui) {
                                console.log(ui);
                                liste_id_initial = ui.item.parents().filter('.listcards').prev().val();
                                card_id = ui.item.find('.cardsid').val();


                                console.log(liste_id_initial);

                                ui.placeholder.height(ui.helper.height());
                                ui.helper.css("transform", "rotate(5deg)");

                                card_initial_position = ui.item.index();
                                console.log(ui.item.index());

                                finalposition = ui.item.parents().first().children().last().index() - 2;
                                console.log(finalposition);


                            },

                            stop: function (event, ui) {
                                liste_id_dragged = ui.item.parents().filter('.listcards').prev().val();
                                console.log(liste_id_dragged);

                                last_position = ui.item.parents().first().children().last().index() - 1;
                                console.log(last_position);

                                card_id_dragged = ui.item.find('.cardsid').val();

                                card_dragged_position = ui.item.index();
                                console.log(card_dragged_position);

                                $.ajax({

                                    url: "{{route('updatecardposition')}}",
                                    method: "PUT",
                                    data: {
                                        id_liste_initial: liste_id_initial,
                                        id_liste_dragged: liste_id_dragged,
                                        card_initial_position: card_initial_position,
                                        card_dragged_position: card_dragged_position,
                                        card_id: card_id,
                                        last_position: last_position,
                                        card_id_dragged,
                                        finalposition: finalposition
                                    },

                                    success: function (data) {

                                        console.log(data);
                                    }
                                });

                            },
                        });
                    }

                });
            }

            else {
                console.log('The list dont should be empty');
            }
        });


        /* Add member to a board */

        $('#addMember').click(function () {
            console.log($('#member-mail').val());
            var _mail = $('#member-mail').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{route('autocomplete.post',['board'=>$array['board']->id_board])}}",
                method: "POST",
                data: {user_mail: _mail, _token: _token},
                success: function (data) {

                    console.log(data);
                    $('#addMember').parents().filter('#listmember').find('.divider').before('<li class="li-member"><a href="#">'+data.name+' (member) </a></li> <input type="hidden" class="itemmail" value='+data.email+'>');
                    array.push(_mail);
                    array_members.push(data.name);

                    if($('#cardModal').find('#no-member').css('display')!='none')
                    {
                        $('#cardModal').find('#no-member').hide();
                    }

                    if($('#cardModal').find('#no-member2').css('display')!='none')
                    {
                        $('#cardModal').find('#no-member2').hide();
                    }

                    $('#cardModal').find('#ui-members').append('<li class="li-members"><a href="#">'+data.name+'</a></li>');
                    $('#cardModal').find('#members-added').append('<li class="li-card-members"><a href="#" style="display: inline-block;;width: 200px">'+data.name+'</a><i class="ti-plus" style="float: right;margin-top: 8px;margin-right: 8px;"></i>'+'</li>'+'<input type="hidden" value=' +data.id+' />');
                    $("#addMember").prop('disabled', true);

                    $.notify({
                        icon: 'ti-user',
                        message: "Membre ajouté."

                    }, {
                        type: 'success',
                    });

                    $("#addIconMember").css('color', '#b6bbbf');



                },


            });


        });


        //$('.myList').draggable();
        var initial_position;
        var dragged_position;
        var id_liste;

        $('.cont').sortable({

            items: ">.dynamiclists",
            delay: 300,
            scrollSpeed: 40,
            scrollSensitivity: 10,
            helper: "clone",
            cursor: "pointer",
            placeholder: 'my-placeholder',

            start: function (event, ui) {
                initial_position = ui.item.index();
                id_liste = ui.item.children("input.listids").val();
                ui.placeholder.height(ui.helper.height());
                ui.helper.css("transform", "rotate(5deg)");

            },

            stop: function (event, ui) {
                dragged_position = ui.item.index();

                $.ajax({

                    url: "{{route('updateposition',['board'=>$array['board']->id_board])}}",
                    method: "PUT",
                    data: {id_liste: id_liste, initial_position: initial_position, dragged_position: dragged_position},

                    success: function (data) {
                        console.log(data);
                    }
                });
            },


        });


        /* Show list form input */

        $('#list-title').click(function () {
            $(this).hide();
            $('#addedList').removeClass('list-style');
            $('#addedList').addClass('list-style2');
            $('#form-list').show();
            $('#titre').focus();
        });

        $('#closelist').click(function () {
            $('#form-list').hide();
            $('#addedList').removeClass('list-style2');
            $('#addedList').addClass('list-style');
            $('#list-title').show();
        });

        /* Show card when trigger addCard */
        $('#listgroup').on('click', ".addCard", function (e) {

            console.log($(this).prev().find('.form-card'));
            $(this).prev().find('.form-card').show();
            console.log($(this).parents().filter('.dynamiclists').find('.pre-scrollable'));

            var scroll = $(this).parents().filter('.dynamiclists').find('.pre-scrollable');
            var height = scroll[0].scrollHeight;
            scroll.scrollTop(height);

            $(this).prev().find('.cards-input').focus();
            $(this).hide();

        });

        /* Hide form card while click close */
        $('#listgroup').on('click', ".closeCard", function (e) {

            $(this).parents().filter('.form-card').hide();
            $(this).parents().filter('.listcards').next().show();

        });

        /*add Card when click 'Ajouter carte' */
        $('#listgroup').on('click', ".addCardButton", function (e) {

            var _input = $(this).parent().prev().val();
            var _idliste = $(this).parents().filter('.listcards').prev().val();
            console.log(_idliste);

            var _token = $('meta[name="csrf-token"]').attr('content');
            var position = $(this).parents().filter('.form-card').index();
            console.log(position);

            var formcard = $(this).parents().filter('.form-card');
            var link = $(this).parents().filter('.listcards').next();

            if (_input != '') {

                $.ajax({

                    url: "{{route('card.store')}}",
                    method: "POST",
                    data: {titre: _input, _token: _token, idliste: _idliste, card_position: position},

                    success: function (data) {
                        console.log('Success', data);

                        formcard.before("<div class='card card-list cards ' style='padding-top: 5px;padding-bottom: 5px;padding-left: 5px;padding-right: 5px;border-radius: 3px;margin-bottom: 8px;' data-toggle='modal' data-target='#cardModal'  data-comments='[]' data-users='' data-card-users='' data-labels='[]' >" +
                            "<div class='card-body '>" +
                            "<div class='labels' style='display: none'></div>"+
                            "<p style='overflow-wrap: break-word;white-space: initial' class='titrecarte'>" + data.titre + "</p>" +
                            "<input class='carddescription' type='hidden' value='' />" +
                            "<input class='cardsid' type='hidden' value=" + data.id_carte +
                            ">" +
                            "<div class=\"card-infos\" >\n" +
                            "<span class=\"badge descriptionspan\" style='display:none'><i class=\"ti-align-justify\" ></i></span>\n" +
                            "<span class=\"badge commentspan\"  style='display:none'><i class=\"ti-comment\" ></i> 0</span>\n" +
                            "<span class=\"badge userspan\" style='display:none'><i class=\"ti-user\"></i> 0</span>\n" +
                            "<span class=\"badge\" style='display:none' ><i class=\"ti-file\"></i> 0</span>\n" +
                            "</div>" +
                            "</div>" +
                            "</div>");

                        formcard.hide();
                        link.show();

                        console.log(position);

                        $.notify({

                            icon: 'ti-credit-card',
                            message: "Carte ajoutée."

                        }, {
                            type: 'success',
                        });

                    },

                    error: function (data) {

                        console.log('Error:', data);
                    }

                });
            }

            $(this).parent().prev().val('');


        });

        $("#listmember").find(".li-member").each(function(){

            var member=$(this).children().text();

            if(member.includes(' (member)')){
                member=$(this).children().text().replace(' (member)','');
            }

            else if (member.includes(' (owner)')){
                member=$(this).children().text().replace(' (owner)','');
            }

            if(member!="{{$user->name}}"){
                array_members.push(member);
            }

        });


        /*Pass data to modal */

        $('#listgroup').on('click', ".cards", function (e) {

            var titre = $(this).find('.titrecarte').text();
            var idcard = $(this).find('.cardsid').val();
            var obj=$(this);
            card_comments = $(this).attr('data-comments');
            comments_users=$(this).attr('data-users');
            card_users=$(this).attr('data-card-users');
            alllabels=JSON.parse(obj.attr('data-labels'));

            var spandescription = $(this).find('.card-infos').find('.descriptionspan');
            var spancomment=$(this).find('.card-infos').find('.commentspan');
            var spanuser=$(this).find('.card-infos').find('.userspan');


            var description_hidden = $(this).find('.carddescription');
            var description = $(this).find('.carddescription').val();

            var addbuttondescription = $("#cardModal").find('.addCardDescription');

            $("#cardModal").find('.modal-title').text("" + titre);

            if (description != '') {

                $("#cardModal").find('.formcard').hide();
                var p = $("#cardModal").find('.card-description').find("p").show();
                p.text('' + description);
                $("#cardModal").find('.description-link').show();

            }
            else {
                $("#cardModal").find('.card-description').find("p").hide();
                $("#cardModal").find('.formcard').show();
                $("#cardModal").find('.description-link').hide();

            }

            $("#cardModal").find('.description-link').on('click', function () {

                $("#cardModal").find('.card-description').find("p").hide();
                var paragraph = $("#cardModal").find('.card-description').find("p").text();
                var closebutton = $("#cardModal").find('.closedescription');

                $("#cardModal").find('.formcard').show();
                $("#cardModal").find('.descriptions').val('' + paragraph);
                $("#cardModal").find('.descriptions').select();

                closebutton.show();
                closebutton.on('click', function () {

                    $("#cardModal").find('.formcard').hide();
                    $("#cardModal").find('.card-description').find("p").show();
                    $(this).hide();
                })


            });


            addbuttondescription.unbind().on('click', function () {

                var descriptionfield = $(this).prev().find('.descriptions');
                var description_input = $(this).prev().find('.descriptions').val();


                if (description_input != '') {


                    var url = '{{ route("card.update", ":id_card") }}';
                    url = url.replace(':id_card', idcard);

                    var _token = $('meta[name="csrf-token"]').attr('content');


                    $.ajax({

                        url: url,
                        method: "PUT",
                        data: {token: _token, description: description_input},

                        success: function (data) {
                            console.log(data);


                            $("#cardModal").find('.card-description').find('.formcard').hide();
                            $("#cardModal").find('.card-description').find("p").text('' + description_input);

                            $("#cardModal").find('.card-description').find("p").show();
                            $("#cardModal").find('.description-link').show();

                            description_hidden.val(data.description);
                            descriptionfield.val('');

                            if (spandescription.css('display', 'none')) {
                                spandescription.show();
                            }


                        },

                        error: function (data) {

                            console.log('Error:', data);
                        }
                    });

                }

            });

            console.log(card_comments);

            users=comments_users.split(",");
            users.pop();

            comments=JSON.parse(card_comments);


            for (i in comments) {

                date=comments[i].created_at;
                date_array=date.split(' ');

                for(var j=0;j<array_members.length;j++)
                {
                    if(comments[i].commentaire.includes('@'+array_members[j]))
                    {
                        /*replace all matches that contains the tags */
                        comments[i].commentaire=comments[i].commentaire.replace(new RegExp('@'+array_members[j],'g'),'<strong>@'+array_members[j]+'</strong>');
                    }
                }

                if(comments[i].commentaire.includes('@'+'{{$user->name}}'))
                {
                    comments[i].commentaire=comments[i].commentaire.replace(new RegExp('@'+'{{$user->name}}','g'),'<strong>@'+'{{$user->name}}'+'</strong>');

                }

                $("#cardModal").find('.comments-list').prepend('\n' +
                    '                            <div class="media" style="width: 700px;">\n' +
                    '                                <p class="pull-right"><small>'+date_array[0]+' à '+date_array[1]+'</small></p>' +
                    '                                <div class="media-body" style="width: auto;"> \n' +
                    '\n' +
                    '                                    <h6 class="media-heading user_name">'+users[i]+'</h6>' +
                    ' '+'<div class=\'card  \' style=\'margin-bottom: 0px;margin-top: 10px;padding-bottom: 2px;padding-top: 2px;max-width: 550px; \'> <div class=\'card-body \' style=\'padding-bottom: 5px\n' +
                    '    padding-top: 5px;\n' +
                    '    padding-left: 10px;\n' +
                    '    padding-right: 10px;\n' +
                    '\n' +
                    '}\'>\n' +
                    '<p style="overflow-wrap: break-word;\n' +
                    'white-space: initial;">'+comments[i].commentaire +
                    '</p>\n' +
                    '                                   </div></div> \n' +
                    '                                </div>\n' +
                    '                            </div>');
            }

            $('#cardModal').find('.media-body').each(function () {

                var comment_user=$(this).find('.user_name').text();

                if(comment_user!='{{$user->name}}')
                {
                    $(this).append(' <p style="margin-top: 3px;margin-left: 5px;"><small><a href="">Like</a> - <a href="">Comment</a></small></p>');
                }

                else
                {
                    $(this).append(' <p style="margin-top: 3px;margin-left: 5px;"><small><a href="">Update</a> - <a href="">Delete</a></small></p>');
                }
            });





            $("#cardModal").find('#addComment').unbind().on('click', function () {

                var comment = $("#cardModal").find('#commentText').val();
                console.log(comment);
                console.log(idcard);
                var id_user = "{{$user->id}}";
                console.log(id_user);


                if (comment != '') {

                    $.ajax({

                        url: "{{route('comment.store')}}",
                        method: "POST",
                        data: {card_id: idcard, user_id: id_user, commentaire: comment},

                        success: function (data) {

                            console.log('Success', data);

                            date=data.created_at;
                            date_array=date.split(' ');

                            for(var i=0;i<array_members.length;i++)
                            {
                                if(data.commentaire.includes('@'+array_members[i]))
                                {
                                    /*replace all matches that contains the tags */
                                    data.commentaire=data.commentaire.replace(new RegExp('@'+array_members[i],'g'),'<strong>@'+array_members[i]+'</strong>');
                                }
                            }


                            $("#cardModal").find('.comments-list').prepend('\n' +
                                '                            <div class="media" style="width: 700px;">\n' +
                                '                                <p class="pull-right"><small>'+date_array[0]+' à '+date_array[1]+'</small></p>' +
                                '                                <div class="media-body" style="width:auto;" >\n' +
                                '\n' +
                                '                                    <h6 class="media-heading user_name">{{$user->name}}</h6>' +
                                ' '+'<div class=\'card  \' style=\'margin-bottom: 0px;margin-top: 10px;padding-bottom: 2px;padding-top: 2px; \'> <div class=\'card-body \' style=\'padding-bottom: 5px\n' +
                                '    padding-top: 5px;\n' +
                                '    padding-left: 10px;\n' +
                                '    padding-right: 10px;\n' +
                                '\n' +
                                '}\'>\n' +
                                '<p style="overflow-wrap: break-word;\n' +
                                'white-space: initial;"> '+data.commentaire +
                                '</p>\n' +
                                '</div></div><p style=\'margin-top: 3px;margin-left: 5px;\'><small><a href="">Update</a> - <a href="">Delete</a></small></p>\n' +
                                '</div>\n' +
                                '</div>');

                            console.log(spancomment.text());

                             var comment_number=parseInt( spancomment.text());

                             if(comment_number==0){
                                 spancomment.show();
                             }
                             comment_number=comment_number+1;

                            spancomment.html('<i class="ti-comment"></i> '+comment_number.toString());
                            comments.push(data);

                            obj.attr('data-comments',JSON.stringify(comments));
                            obj.attr('data-users',obj.attr('data-users')+"{{$user->name}},");

                            console.log(obj.attr('data-comments'));
                            console.log(obj.attr('data-users'));


                        },

                        error: function (data) {

                            console.log('Error:', data);
                        }

                    });
                }

                $("#cardModal").find('#commentText').val('');



            });

            $('#cardModal').find('.emoticons').unbind().on('click',function ()
            {
                 var emoticon=$(this).children().text();
                 var comment_value=$('#cardModal').find('#commentText').val();

                $('#cardModal').find('#commentText').val(comment_value+emoticon);


            });

            var cardusers=card_users.split(",");
            cardusers.pop();


            if(cardusers.length!=0)
            {
                $('#cardModal').find('.card-members').show();
            }
            for (var i=0;i<cardusers.length;i++)
            {
                $('#cardModal').find('.users-links').append('<a href="#" class="user-link">'+cardusers[i]+'</a>');
            }

            $('#cardModal').find('.li-members').unbind().on('click',function ()
            {
                var user=$(this).children().text();

                var comment=$('#cardModal').find('#commentText').val();
                $('#cardModal').find('#commentText').val(comment+'@'+user+' ');


            });





            $("#cardModal").find('#commentText').atwho({

                at: "@",
                data:array_members,
                limit: 100
            });


            //$('#cardModal').find('.users-links').append()


            $('#cardModal').find('.li-card-members').unbind().on('click',function (e) {

                console.log($(this).find('a').text());
                console.log(obj.find('.cardsid').val());

                var id_user=$(this).next().val();
                var idcard=obj.find('.cardsid').val();
                var name=$(this).find('a').text();
                var link=$(this);

                var url = '{{ route("addCardMember", ":id_card") }}';
                url = url.replace(':id_card', idcard);

                $.ajax({

                    url: url,
                    method: "POST",
                    data: {user_id: id_user},

                    success: function (data) {
                        console.log(data);

                        if($('#cardModal').find('.card-members').css('display')=='none')
                        {
                            $('#cardModal').find('.card-members').show();
                        }

                        var user_number=parseInt( spanuser.text());

                        if(user_number==0){
                            spanuser.show();
                        }
                        user_number=user_number+1;

                        spanuser.html('<i class="ti-user"></i> '+user_number.toString());

                        var data_card_users= obj.attr('data-card-users');
                        obj.attr('data-card-users',data_card_users+name+',');
                        $('#cardModal').find('.users-links').append('<a href="#" class="user-link">'+name+'</a>');

                        link.addClass('act');

                        link.find('i').removeClass('ti-plus');
                        link.find('i').addClass('ti-check');

                        console.log( obj.attr('data-card-users'));

                    },

                    error: function (data) {

                        console.log('Error:', data);
                    }
                });

                e.stopPropagation();

            });

            $('#label-colors').find('.label-color').on('click',function (e) {

                $('#label-colors').find('.label-color').each(function ()
                {
                    if($(this).find('.ti-check').css('display','block'))
                    {
                        $(this).find('.ti-check').hide()
                    }
                });

                $(this).find('.ti-check').show();
                e.stopPropagation();
            });

            $('#link-prev').on('click',function (e) {

                $('#label-dropdown').hide();
                $('#alllabels').show();
                e.stopPropagation();
            });

            $('#addlabellink').on('click',function (e) {

                $('#alllabels').hide();
                $('#label-dropdown').show();
                e.stopPropagation();

            });

            $('#boardlabels').unbind().on('click','.boardlabel',function (e)
            {
                var idcard=obj.find('.cardsid').val();
                console.log(idcard);

                var id_label=$(this).next().next().val();
                console.log(id_label);

                var url = '{{ route("addLabelCard", ":id_card") }}';
                url = url.replace(':id_card', idcard);

                var label=$(this);

                var color=$(this).next().next().next().val();
                var name=$(this).children().text();
                var cardlabels=$('#cardModal').find('.card-labels');
                var all_labels=$('#cardModal').find('.all-labels');



                $.ajax({

                    url: url,
                    method: "POST",
                    data: {label_id: id_label},

                    success: function (data)
                    {
                        console.log(data);

                        var labels=obj.find('.labels');

                        if(labels.css('display')=='none')
                        {
                            labels.show();
                        }

                        labels.append('<span class="label  span-label" >'+name+'</span>');

                        labels.children().last().attr('class',labels.children().last().attr('class')+' '+color);

                        label.addClass('act');
                        label.next().removeClass('ti-plus');
                        label.next().addClass('ti-check');

                        if(cardlabels.css('display')=='none')
                        {
                            cardlabels.show();
                        }

                        all_labels.append('<span class="label" >'+name+'</span>');
                        all_labels.children().last().attr('class',all_labels.children().last().attr('class')+' '+color);

                        var newlabel = {"name":name,"color":color};
                        alllabels.push(newlabel);

                        obj.attr('data-labels',JSON.stringify(alllabels));


                    },

                    error: function (data) {

                        console.log('Error:', data);

                    }
                });

                e.stopPropagation();
            });

            $('#addlabelButton').unbind().on('click',function (e) {

                var _color;
                var id_board="{{$array['board']->id_board}}";
                console.log(id_board);

                var name_val=$('#labelname').val();

                var _token = $('meta[name="csrf-token"]').attr('content');
                console.log(_token);

                $('#label-colors').find('.ti-check').each(function () {

                    if($(this).css('display')!='none')
                    {
                         _color=$(this).prev().val();

                    }
                });

                console.log(_color);
                var url = '{{ route("label.store") }}';

                if(name_val!='')
                {
                    $.ajax({

                        url: url,
                        method: "POST",
                        data: {name: name_val,color:_color,board_id:id_board},

                        success: function (data)
                        {
                            console.log(data);

                            $('#boardlabels').append(' <a class="list-group-item boardlabel" href="#" style="border: 0;display: inline-block;width: 260px;margin-top: 8px;"><span class="label  span-badge" >'+ data.name+'</span></a><i class="ti-plus" style="float: right;margin-top: 20px;margin-right: 8px;"></i>'+'<input type="hidden" value='+data.id_label+' />'+'<input type="hidden" value='+data.color+' />');
                            var last_span=$('#boardlabels').find('.label').last();
                            last_span.attr('class',last_span.attr('class')+' '+data.color);

                            $('#label-dropdown').hide();
                            $('#alllabels').show();

                            var scroll = $('#alllabels').find('.pre-scrollable');
                            var height = scroll[0].scrollHeight;
                            scroll.scrollTop(height);


                        },

                        error: function (data) {

                            console.log('Error:', data);
                        }
                    });
                }
                e.stopPropagation();
            });



            $('#cardModal').find('.dropdown-labels').unbind().on('show.bs.dropdown', function (e) {

                var allcardlabels=[];

                obj.find('.span-label').each(function () {

                    allcardlabels.push($(this).text());
                });

                $('#cardModal').find('.boardlabel').each(function () {


                    for(var j=0;j<allcardlabels.length;j++)
                    {
                        console.log(allcardlabels[j]);
                        if($(this).children().text()==allcardlabels[j])
                        {
                            $(this).addClass('act');
                            $(this).next().removeClass('ti-plus');
                            $(this).next().addClass('ti-check');

                        }

                    }

                });

                console.log(allcardlabels);



            });

            $('#cardModal').find('.dropdown-labels').on('hide.bs.dropdown', function (e) {

                $('#cardModal').find('.boardlabel').each(function () {

                    if($(this).attr('class').includes('act'))
                    {
                        $(this).removeClass('act');
                        $(this).next().removeClass('ti-check');
                        $(this).next().addClass('ti-plus');
                    }

                });



        });




        $('#cardModal').find('.dropdown').on('show.bs.dropdown', function (e) {

            var allcardmembers=[];

            $('#cardModal').find('.user-link').each(function () {

                allcardmembers.push($(this).text());
            });

            $(this).find('.li-card-members').each(function () {

                for(var j=0;j<allcardmembers.length;j++)
                {
                    if($(this).find('a').text()==allcardmembers[j])
                    {
                        $(this).addClass('act');
                        $(this).find('i').removeClass('ti-plus');
                        $(this).find('i').addClass('ti-check');
                    }

                }
            });

            console.log(allcardmembers);

        });


        $('#cardModal').find('.dropdown').on('hide.bs.dropdown', function (e) {

            $(this).find('.li-card-members').each(function () {

                if($(this).attr('class').includes('act'))
                {
                    $(this).removeClass('act');
                    $(this).find('i').removeClass('ti-check');
                    $(this).find('i').addClass('ti-plus');
                }

            });

        });

        console.log(alllabels);

        if(alllabels.length!=0)
        {
            $("#cardModal").find('.card-labels').show();

            for(var k=0;k<alllabels.length;k++)
            {
                $("#cardModal").find('.all-labels').append('<span class="label">'+alllabels[k].name+'</span>');
                var attr=$("#cardModal").find('.all-labels').children().last().attr('class');
                $("#cardModal").find('.all-labels').children().last().attr('class',attr+' '+alllabels[k].color);

            }
        }



        });




        $('.listcards ').sortable({

            connectWith: ".listcards",
            delay: 300,
            scrollSpeed: 40,
            scrollSensitivity: 10,
            scroll: true,
            appendTo: '#listgroup',
            helper: "clone",
            forcePlaceholderSize: true,
            forceHelperSize: true,
            cancel: '.form-card',
            cursor: "grab",
            placeholder: "cardholder",

            start: function (event, ui) {
                console.log(ui);
                liste_id_initial = ui.item.parents().filter('.listcards').prev().val();
                card_id = ui.item.find('.cardsid').val();


                console.log(liste_id_initial);

                ui.placeholder.height(ui.helper.height());
                ui.helper.css("transform", "rotate(5deg)");

                card_initial_position = ui.item.index();
                console.log(ui.item.index());

                finalposition = ui.item.parents().first().children().last().index() - 2;
                console.log(finalposition);


            },

            stop: function (event, ui) {
                liste_id_dragged = ui.item.parents().filter('.listcards').prev().val();
                console.log(liste_id_dragged);

                last_position = ui.item.parents().first().children().last().index() - 1;
                console.log("lastposition=" + last_position);

                card_id_dragged = ui.item.find('.cardsid').val();

                card_dragged_position = ui.item.index();
                console.log(card_dragged_position);

                $.ajax({

                    url: "{{route('updatecardposition')}}",
                    method: "PUT",
                    data: {
                        id_liste_initial: liste_id_initial,
                        id_liste_dragged: liste_id_dragged,
                        card_initial_position: card_initial_position,
                        card_dragged_position: card_dragged_position,
                        card_id: card_id,
                        last_position: last_position,
                        card_id_dragged,
                        finalposition: finalposition
                    },

                    success: function (data) {

                        console.log(data);
                    }
                });

            },
        });

        $('#cardModal').on('shown.bs.modal', function (e) {

            //$('.descriptions').focus();
            $('.descriptions').val('');
            $('#commentText').val('');

        });



        $('#cardModal').on('hidden.bs.modal', function (e) {

            $(this).find('.comments-list').empty();
            $(this).find('.users-links').empty();

            $(this).find('.card-labels').hide();
            $(this).find('.all-labels').empty();

            $(this).find('.card-members').hide();
            $(this).find('#description-text').text('');

            if($(this).find('.closedescription').css('display')!='none')
            {
                $(this).find('.closedescription').hide();
            }


        });


    })


</script>
@endsection
