<div class="modal fade" id="confirm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <i class="ti-alert"></i> Confirmation de la suppression</h4>
            </div>
            <div class="modal-body">
                <p>Etes vous sur de supprimer ce board ?</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['method' => 'DELETE', 'route' => ['board.destroy', $array['board']->id_board]]) !!}
                {!! Form::submit('Supprimer', ['class' => 'btn btn-sm btn-success','id'=>'delete-btn']) !!}
                {!! Form::button('Fermer', ['class' => 'btn btn-sm btn-default','data-dismiss'=>'modal']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>