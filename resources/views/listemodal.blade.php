<div id="listeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: white"> <i class="ti-plus"></i> Ajouter une liste</h4>
            </div>
            <div class="modal-body">
                {!! Form::open() !!}
                <div class="form-group">
                    {!! Form::label('titre', 'Titre ') !!}
                    {!! Form::text('titre', null, ['class' => 'form-control border-input', 'placeholder' => 'Entrez le titre de votre liste','id'=>'titre','required'=>true]) !!}
                </div>
                <div class="text-center">
                    {!! Form::button('Ajouter liste', ['class' => 'btn btn-fill ','style'=>'background:#32CD32','id'=>'addListButton']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>