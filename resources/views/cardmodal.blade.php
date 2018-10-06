<div  class="modal " id="cardModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="background-color: #edeff0;width: 750px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <i class="ti-credit-card" style="display: inline-block;vertical-align: top;margin-top: 8px;margin-right: 8px;"></i> <h4 class="modal-title" style="color: black;display: inline-block;width: 600px;">Title card</h4>
            </div>
            <div class="modal-body" style="padding-top: 0px">

                <div class="card-labels">

                    <h4 >Labels </h4>

                    <div class="all-labels">

                    </div>
                </div>

                <div class="card-members">

                    <h4 style="display: inline-block" >Membres de la carte </h4>
                    <div class="users-links">
                    </div>
                </div>

                <div class="card-description">
                 <h4  > <i class='ti-align-justify'></i> Description </h4>
                    <a href="#" class="description-link">Editer</a>

                    <div class="formcard">
                      <div class='form-group'>
                        <textarea class='form-control descriptions' placeholder='Entrez une description' style='height:80px;border:0;width: 500px;'></textarea>
                       </div>
                    <button class='btn btn-fill addCardDescription' style='background:#32CD32;border-radius:0px'>Ajouter description</button>
                        <button type='button' class='closedescription close' aria-label='Close' style="padding-right: 8px;padding-left: 8px;margin-left: 0px;padding-bottom: 10px;display:none;float:none" ><span aria-hidden='true'>&times;</span></button>

                    </div>
                    <p id='description-text' style='overflow-wrap: break-word;white-space: initial;display:none;width: 500px'>Description of the card</p>

                </div>

                <div class="card-buttons" style="display: inline-block;float: right;margin-top: 30px;">
                    <h3>Ajouter à la carte</h3>

                    <div class="dropdown dropdown-labels">
                       <button class="btn btn-fill dropdown-toggle" style="display: block;background:#e2e4e6;;border-radius:0px;width: 170px;font-weight: 700;color: #444;border-radius: 3px;" id="card-tag" data-toggle="dropdown"><i class="ti-tag"></i> Etiquettes</button>

                        <ul class="dropdown-menu" style="border-radius: 0px;width: 300px;background-color:white;padding-bottom: 0px;" id="alllabels">
                            <li class="dropdown-header" style="text-align: center">Etiquettes</li>
                            <li class="divider"></li>

                            <li class="pre-scrollable" style="max-height: 200px;">
                                <ul class="list-group "  id="boardlabels">

                                    @foreach($array['board']->labels as $label)
                                        <a class="list-group-item boardlabel" href="#" style="border: 0;display: inline-block;width: 260px;margin-top: 8px;"><span class="label  span-badge {{$label->color}}" >{{$label->name}}</span></a>
                                        <i class="ti-plus" style="float: right;margin-top: 20px;margin-right: 8px;"></i>
                                        <input type="hidden" value="{{$label->id_label}}" />
                                        <input  type="hidden" value="{{$label->color}}" />
                                    @endforeach
                                 </ul>
                            </li>


                            <li id="addlabel"  >
                                <a href="#" class="label-addlink" id="addlabellink">Creer une etiquette</a>
                            </li>

                        </ul>

                        <ul class="dropdown-menu " style="display: none;border-radius: 0px;width: 300px;padding-bottom: 10px;background-color:white" id="label-dropdown">

                            <li class="dropdown-header">
                                <a style="display: inline-block;text-decoration: none" id="link-prev"><i class="ti-arrow-left"></i> </a>
                                <a style="display: inline-block;text-decoration: none;margin-left: 20px;">Creer une etiquette</a>
                            </li>
                            <li class="form-group">
                                <label for="labelname" style="margin-left: 5px">Name :</label>
                                <input type="text" class="form-control" id="labelname" />
                            </li>

                            <li>
                                <label style="margin-left: 5px">Choose a color</label>

                            </li>

                            <li id="label-colors">
                                <ui class="list-group ">
                                    <a class="label-color list-group-item " href="#"><span class="label label-default span-badge" style="height: 30px;" ><input type="hidden" value="label-default"/><i class="ti-check" style="margin-top: 5px;display: none"></i></span></a>
                                    <a class="label-color list-group-item " href="#" ><span class="label label-primary span-badge" style="height: 30px;" > <input type="hidden" value="label-primary"/><i class="ti-check" style="margin-top: 5px;display: none"></i></span></a>
                                    <a class="label-color list-group-item " href="#" ><span class="label label-success span-badge" style="height: 30px;" ><input type="hidden" value="label-success"/><i class="ti-check" style="margin-top: 5px;display: none"></i></span></a>
                                    <a  class="label-color list-group-item" href="#" ><span class="label label-info span-badge" style="height: 30px;"><input type="hidden" value="label-info"/><i class="ti-check" style="margin-top: 5px;display: none"></i></span></a>
                                    <a class="label-color list-group-item " href="#" ><span class="label label-warning span-badge" style="height: 30px;"><input type="hidden" value="label-warning"/><i class="ti-check" style="margin-top: 5px;display: none"></i></span></a>
                                    <a class="label-color list-group-item " href="#" ><span class="label label-danger span-badge" style="height: 30px;"><input type="hidden" value="label-danger"/><i class="ti-check" style="margin-top: 5px;display: block"></i></span></a>

                                </ui>
                            </li>

                            <li>
                                <button class='btn btn-fill' style='background:#32CD32;border-radius:0px;margin-left: 10px;margin-top: 5px;' id="addlabelButton">Add</button>

                            </li>

                        </ul>

                    </div>

                    <div class="dropdown" >

                        <button class="btn btn-fill dropdown-toggle" data-toggle="dropdown" style="display: block;background:#e2e4e6;border-radius:0px;width: 170px;margin-top: 8px;font-weight: 700;color: #444;border-radius: 3px;" > <i class="ti-user"></i> Membres</button>

                        <ui class="dropdown-menu " style="border-radius: 0px;width: 250px;background-color:white" >
                            <li class="dropdown-header" style="text-align: center">Ajouter un membre dans une carte</li>
                            <li class="divider"></li>


                                <ui class="dropdown-menu" style="border-radius: 0px;width: 250px;background-color:white;max-height:200px;overflow-y: auto;margin-top: 0px;" id="members-added">

                                    @if(count($array['members'])==1)
                                        <li id="no-member2" class="act"><a href="#">Aucun membre disponible</a></li>

                                    @else
                                        @foreach ($array['members'] as $member)
                                            @if($member->name!=$user->name)
                                                <li class="li-card-members">
                                                    <a href="#" style="display: inline-block;width: 200px;">{{$member->name}}</a>
                                                    <i class="ti-plus" style="float: right;margin-top: 8px;margin-right: 8px;"></i></li>
                                                <input type="hidden" value="{{$member->id}}" />
                                            @endif
                                        @endforeach
                                    @endif

                                </ui>


                        </ui>
                    </div>

                    <button class="btn btn-fill" style="display: block;background:#e2e4e6;;border-radius:0px;width: 170px;font-weight: 700;color: #444;border-radius: 3px;margin-top: 8px;" ><i class="ti-alarm-clock"></i> Date limite</button>
                </div>




                <div class="container" style="padding-left: 0px;">
                <div class="row">
                    <div class="col-md-4">
                        <h4 style="color: #333;font-family: Helvetica Neue,Arial,Helvetica,sans-serif;">  <i class="ti-comment"></i> Commentaires </h4>

                        <div class="comment-input form-group" style="background-color: white;padding-right: 15px;height: 100px;width: 500px;">

                            <textarea class='form-control' placeholder='Entrez un commentaire ...' style='height:60px;border:0' id="commentText"></textarea>


                            <input type="hidden" value="{{$user->id}}" id="user-name" />

                            <div class="comment-options">

                                    <div class="dropdown" style="display: inline-block">
                                        <a  style="padding-right: 10px;" class="dropdown-toggle" data-toggle="dropdown" href="#" ><span class="ti-face-smile"></span></a>

                                        <ul class="dropdown-menu list-inline" style="border-radius: 0px;width: 250px;background-color:white;max-height:200px;overflow-y: auto">

                                            <li class="dropdown-header" style="text-align: center">Choisissez votre emoticone</li>
                                            <li class="divider emoticons-divider"></li>
                                            <li class="emoticons list-inline-item"> <a href="#">&#128547</a></li>
                                            <li class="emoticons list-inline-item"><a href="#"> &#128512</a></li>
                                            <li class="emoticons list-inline-item"><a href="#">&#128546</a></li>
                                            <li class="emoticons list-inline-item"><a href="#">&#128522</a></li>
                                            <li class="emoticons list-inline-item"><a href="#">&#128578</a></li>
                                            <li class="emoticons list-inline-item"><a href="#">&#128591</a></li>
                                            <li class="emoticons list-inline-item"><a href="#">&#128545</a></li>
                                            <li class="emoticons list-inline-item"><a href="#">&#128514</a></li>
                                            <li class="emoticons list-inline-item"><a href="#">&#128521</a></li>
                                            <li class="emoticons list-inline-item"><a href="#">&#128525</a></li>
                                            <li class="emoticons list-inline-item"><a href="#">&#128539</a></li>
                                          </ul>
                                    </div>

                                <div class="dropdown" style="display: inline-block">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="ti-user"></span></a>
                                    <ui class="dropdown-menu " style="border-radius: 0px;width: 250px;background-color:white" >
                                        <li class="dropdown-header" style="text-align: center">Mentionnez un membre</li>
                                        <li class="divider"></li>


                                            <ui class="dropdown-menu " style="border-radius: 0px;width: 250px;background-color:white;max-height:200px;overflow-y: auto;margin-top: 0px;" id="ui-members">
                                                @if(count($array['members'])==1)
                                                    <li id="no-member" class="act"><a href="#">Aucun membre disponible</a></li>

                                                @else
                                                 @foreach ($array['members'] as $member)
                                                   @if($member->name!=$user->name)
                                                     <li class="li-members"><a href="#">{{$member->name}}</a></li>
                                                   @endif
                                                 @endforeach
                                                @endif
                                            </ui>

                                    </ui>
                                </div>

                            </div>

                        </div>

                        <button class='btn btn-fill' style='background:#32CD32;border-radius:0px' id="addComment">Ajouter commentaire</button>
                        <div class="comments-list" style="margin-top: 40px;">


                        </div>



                    </div>
                </div>
            </div>

               <!-- <div class="card-members">
                    <h4 style="color: #333;font-family: Helvetica Neue,Arial,Helvetica,sans-serif;display: inline-block"> <i class="ti-user"></i> Membres de la carte</h4>

                </div> -->

            </div>
        </div>
    </div>
</div>