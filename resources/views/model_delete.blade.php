<div class="modal fade" id="{{$idModel}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SettingLanguage">{{$title}}</h5>
        <button type="button" id="close_button" onclick="closeModal('#{{$idModel}}')" class="btn btn-dark">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="{{$action}}" method="POST">
            <div class="modal-body">
            @csrf
            @include('form_id')
            {{$message}}<spam>-{{$name}}</spam>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{$button}}</button>
            </div>
        </form>
        </div>
    </div>
</div>