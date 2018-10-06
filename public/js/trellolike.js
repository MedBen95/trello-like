

$(document).ready(function () {
    var i = 1;
    var array = [];
    var card;


    $('.itemmail').each(function () {
        array.push($(this).val());
    });


    $('#member-mail').keyup(function () {

        $("#addMember").prop('disabled', true);
        $("#addIconMember").css('color','#b6bbbf');
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
            $("#addIconMember").css('color','white');
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
                $("#addIconMember").css('color','#b6bbbf');


            },


        });



    });



    //$('.myList').draggable();
    var initial_position;
    var dragged_position;
    var id_liste;

    $('.cont').sortable({

        items: ">.dynamiclists",
        delay: 200,
        scrollSpeed: 40,
        scrollSensitivity: 10,
        placeholder: 'my-placeholder',

        start: function( event,ui )
        {
            initial_position= ui.item.index();
            id_liste=ui.item.children("input.listids").val();

        },

        stop: function( event,ui )
        {
            dragged_position=ui.item.index();

            $.ajax({

                url:"{{route('updateposition',['board'=>$array['board']->id_board])}}",
                method:"PUT",
                data:{id_liste:id_liste,initial_position:initial_position,dragged_position:dragged_position},

                success:function(data)
                {
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
    $('#listgroup').on('click',".addCard",function(e) {

        console.log($(this).next().find('.form-card'));
        $(this).next().find('.form-card').show();
        $(this).next().find('.cards-input').focus();
        $(this).hide();

    });

    /* Hide form card while click close */
    $('#listgroup').on('click',".closeCard",function(e) {

        $(this).parents().filter('.form-card').filter('.form-card').hide();
        $(this).parents().filter('.listcards').prev().show();

    });

    /*add Card when click 'Ajouter carte' */
    $('#listgroup').on('click',".addCardButton",function(e) {

        var _input= $(this).parent().prev().val();
        var _idliste= $(this).parents().filter('.listcards').prev().prev().val();
        console.log(_idliste);
        var _token =$('meta[name="csrf-token"]').attr('content');
        var prescroll=$(this).parents().filter('.listcards');

        if(_input !='')
        {

            $.ajax({

                url:"{{route('card.store')}}",
                method:"POST",
                data:{titre:_input,_token:_token,idliste:_idliste},

                success:function(data)
                {
                    console.log('Success',data);
                    console.log(link);

                    $.notify({

                        icon: 'ti-credit-card',
                        message: "Carte ajoutée."

                    },{
                        type: 'success',
                    });

                },

                error: function(data) {

                    console.log('Error:', data);
                }

            });
        }

        $(this).parent().prev().val('');

    });






})
