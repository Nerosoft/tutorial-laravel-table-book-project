@extends('layout_admin')
@section('containt')
@include('start_nav')
<div class="start-page container">
    <button class="btn btn-primary" onClick="openModal('#createModel')">{{$lang->ButtonModelCreate}}</button>
@include('create_edit_flex_table',[
    'idModal'=>'createModel',
    'idForm'=>'createForm',
    'action'=>route('createFlexTable', request()->route('id')), 
    'title'=>$lang->ScreenModelCreate, 
    'button'=>$lang->ButtonModelAdd])
<table id="example" class="table table-striped">
    <thead>
            <tr>
                <th>{{ $lang->TableId }}</th>
                @foreach($lang->TableHead as $index=>$name)
                    <th>{{$name}}</th>
                @endforeach
                <th>{{ $lang->TabelEvent }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lang->getDataTable() as $index=>$items)
            <tr>
                <th>{{$loop->index+1}}</th>
                @foreach($items as $item)
                    <th>{{$item}}</th>
                @endforeach
                <th>
                        <img class="style_icon_menu pointer" src="{{asset('/lib/icons/trash3.svg')}}" onclick="openModal('#deleteModel{{$index}}')"/>
                        @include('model_delete', [
                        'idModel'=>'deleteModel'.$index, 
                        'message'=>$lang->messageModelDelete,
                        'title'=>$lang->titleModelDelete,
                        'button'=>$lang->buttonModelDelete,
                        'name'=>$items[array_key_first($items)], 'action'=>route('flextable.delete', request()->route('id'))])
                    <img class="style_icon_menu pointer" src="{{asset('/lib/icons/wrench-adjustable.svg')}}" onclick="displayEditForm('#editModel{{$index}}', '{{json_encode($items)}}')"/>
                    @include('create_edit_flex_table', ['idModal'=>'editModel'.$index, 
                    'action'=>route('editFlexTable', request()->route('id')), 
                    'idForm'=>'editForm'.$index,
                    'title'=>$lang->ScreenModelEdit, 
                    'button'=>$lang->ButtonModelEdit])
                </th>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
             <tr>
                <th>{{ $lang->TableId }}</th>
                @foreach($lang->TableHead as $index=>$name)
                    <th>{{$name}}</th>
                @endforeach
                <th>{{ $lang->TabelEvent }}</th>
            </tr>
        </tfoot>
        
</table>
</div>
<script type="text/javascript">
    let setting = [{ 'searchable': true, className: "text-left" }];
    for (const key in @json($lang->TableHead))
        setting.push({ 'searchable': true, className: "text-left" });
    setting.push({ 'searchable': false, className: "text-left" });
    function displayEditForm(id, obj){
        removeClass(id);
        openModal(id);
        let myObj = JSON.parse(obj); 
        for (const key in myObj) 
            $(id).find('#'+key).val(myObj[key]);
    }
</script>
@endsection
