@include('start_model')
@isset($index)
    @include('form_id')
@endisset
@foreach($items??$lang->Hint as $key=>$value)
  <div class="mb-3">
      <label for="name" class="form-label">{{$lang->Label[$key]}}</label>
      <input 
      title="{{$lang->Hint[$key]}}"
      minlength="3" 
      required
      oninvalid="showMessageCustom(this ,'{{$lang->ErrorsMessageReq[$key]}}', '{{$lang->ErrorsMessageInv[$key]}}')"
      oninput="showMessageCustom(this ,'{{$lang->ErrorsMessageReq[$key]}}', '{{$lang->ErrorsMessageInv[$key]}}')"
      type="text" id="{{$key}}" class="form-control" name="{{$key}}" value="{{isset($index)?$value:''}}" placeholder="{{$lang->Hint[$key]}}">
  </div>
@endforeach
@include('end_model')
                


