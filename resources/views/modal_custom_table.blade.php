@include('start_model')
@isset($index)
    @include('form_id')
@endisset
<div class="form-group">
    <label for="lang_name" class="form-label">{{$lang->LabelName}}</label>
    <input 
    minlength="3" 
    required
    oninvalid="showMessageCustom(this ,'{{$lang->error1}}', '{{$lang->error2}}')"
    oninput="showMessageCustom(this ,'{{$lang->error1}}', '{{$lang->error2}}')"
    type="text" name="name" id="name" value="{{$item?->getName()??''}}" placeholder='{{$lang->HintName}}' class="form-control">
</div>
@if(!isset($index))
<div class="form-group">
    <label for="lang_name" class="form-label">{{$lang->LabelInputNumber}}</label>
    <input 
    min="1" 
    max="8" 
    required
    type="number" name="input_number" id="input_number"  placeholder='{{$lang->HintInputNumber}}' class="form-control">
</div>
@endif
@include('end_model')

