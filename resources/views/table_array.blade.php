<th>
    <img class="style_icon_menu pointer" src="{{asset('/lib/icons/wrench-adjustable.svg')}}" onclick="displayEditForm('#editModel{{$index}}', $('#editForm{{$index}}').find('#word'), '{{$items}}')"/> 
@include('start_model')
    <div class="input-group input-group-lg">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-lg">{{$lang->label3}}</span>
        </div>
        <input
        title="{{$lang->WordHint}}"
        placeholder="{{$lang->WordHint}}"
        minlength="3" 
        required
        oninvalid="showMessageCustom(this ,'{{$lang->error1}}', '{{$lang->error2}}')"
        oninput="showMessageCustom(this ,'{{$lang->error1}}', '{{$lang->error2}}')"
        type="text" name="word" id="word" value="{{$items}}" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
    </div>
@include('end_model')
</th>
