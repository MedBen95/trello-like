@extends('template')

@section('a')
    <a class="navbar-brand" href="#"><i class="ti-user"></i> Mon profil</a>
@endsection

@section('linav')
    <li>
        <a href="{{route('board.index')}}">
            <i class="ti-angle-right"></i>
            <p>Mes boards</p>
        </a>
    </li>

    <li  class="active">
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
             <div class="content">

                 <div class="container">
                   <div class="card">
                     <div class="content">
                      <form action="{{route('profil.edit',['user'=>$user->id])}}" method="post" enctype="multipart/form-data" id='form-profile'>

                        @csrf

                        <div class="row">
                          <div class="col-md-offset-5 form-group">
                            <input id="upload-photo" type="file" style="display:none" name="avatar"/>
                            <a href="#" id="upload-link">
                              <img src="{{asset("img/default-user.png")}}" class="img-circle" style="height: 100px;"  />
                           </a>
                           <div class="progress" style="width: 100px;margin-top: 10px;display:none">
                             <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:0%"></div>
                           </div>
                         </div>
                        </div>
                         <div class="row">
                             <div class="col-md-4 form-group">
                                 <label for="name">Nom complet:</label>
                                 <input type="text" class="form-control border-input" style="background-color: #fffcf5;" name="name" value="{{$user->name}}">
                                 {!! $errors->first('name', '<strong>:message</strong>') !!}
                              </div>
                              <div class="col-md-4 form-group">
                                  <label for="email">Adresse mail:</label>
                                  <input type="email" class="form-control border-input" style="background-color: #fffcf5;" name="email" value="{{$user->email}}">
                                  {!! $errors->first('email', '<strong>:message</strong>') !!}
                               </div>
                               <div class="col-md-4 form-group">
                                   <label for="telephone">Telephone:</label>
                                   <input type="text" class="form-control border-input" style="background-color: #fffcf5;" placeholder="Entrez votre numero" name="telephone" value="{{$user->telephone}}">
                                   {!! $errors->first('telephone', '<strong>:message</strong>') !!}
                                </div>
                         </div>

                        <!-- <div class="row">
                           <div class="col-md-6 form-group">
                               <label for="pays">Pays:</label>
                               <input type="text" class="form-control border-input" style="background-color: #fffcf5;"placeholder="Entrez votre pays">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="ville">Ville:</label>
                                <input type="text" class="form-control border-input" style="background-color: #fffcf5;"placeholder="Entrez votre ville">
                             </div>

                         </div> -->

                         <div class="row">

                            <div class="col-md-12 form-group">
                              <label for="name">Adresse:</label>
                              <input type="text" class="form-control border-input" style="background-color: #fffcf5;"placeholder="Entrez votre adresse" name="adresse" value="{{$user->adresse}}">
                              {!! $errors->first('adresse', '<strong>:message</strong>') !!}
                            </div>

                            </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                              <label for="name">A propos:</label>
                              <textarea class="form-control border-input" style="background-color: #fffcf5;"placeholder="A propos de vous ..." name="apropos">{{$user->apropos}}</textarea>
                              {!! $errors->first('apropos', '<strong>:message</strong>') !!}
                            </div>
                        </div>

                        <div class="text-center">
                              <button type="submit" class="btn btn-success btn-fill btn-wd">Modifier profil</button>
                        </div>



                         </div>

                      </form>
                    </div>
                    </div>

                     </div>
                 </div>
              </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {

          $("#upload-link").on('click', function(e){
             e.preventDefault();
            $("#upload-photo").trigger('click');
          });

            $("#upload-photo").change(function(){

              var token="{{csrf_token()}}";
              console.log(token);

                if($(this).val()!=''){

                  var formData = new FormData();
                  formData.append('file', $("#upload-photo")[0].files[0]);
                  //formData.append('_token', '{{csrf_token()}}');

                  console.log($("#upload-photo")[0].files[0].name);
                  console.log(formData);

                  $.ajax({

                      url: "{{route('profil.upload',['user'=>$user->id])}}",
                      method: "PUT",
                      data: formData,
                      processData: false,
                      contentType: false,

                      success: function (data) {
                          console.log(data);
                      }
                  });
                }
            });

            $(".progress-bar").animate({
                width: '100%'
            }, 2500);

        });
  </script>

@endsection
