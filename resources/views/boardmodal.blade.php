<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: white"> <i class="ti-plus"></i> Ajouter un board</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' =>'board.store']) !!}
                <div class="form-group">
                    {!! Form::label('titre', 'Titre ') !!}
                    {!! Form::text('titre', null, ['class' => 'form-control border-input', 'placeholder' => 'Entrez le titre de votre board','id'=>'titre']) !!}
                    {!! $errors->first('titre', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Description ') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control','rows'=>'3','placeholder'=>'Entrez une description du board','id'=>'description']) !!}
                    {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                </div>
               
                <div class="text-center">
                    {!! Form::submit('Ajouter board', ['class' => 'btn  btn-fill ','id'=>'ajaxSubmit','style'=>'background:#32CD32']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>