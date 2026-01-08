@extends('layout_admin')
@section('containt')
@include('start_nav')
<div class="start-page container">
    <button class="btn btn-primary" onClick="openModal('#createModel')">{{$lang->ButtonModelCreate}}</button>
    @include('modal_custom_table', [
    'idModal'=>'createModel',
    'idForm'=>'createForm',
    'action'=>route('addTable'), 
    'title'=>$lang->ScreenModelCreate, 
    'button'=>$lang->ButtonModelAdd])
    <table id="example" class="table table-striped" >
        <thead>
            <tr>
                <th>{{ $lang->TableId }}</th>
                <th>{{ $lang->TableName }}</th>
                <th>{{ $lang->TabelEvent }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lang->getDataTable() as $index=>$item)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$item->getName()}}</td>
                <td>
                    <img class="style_icon_menu pointer" src="{{asset('/lib/icons/trash3.svg')}}" onclick="openModal('#deleteModel{{$index}}')"/>
                    @include('model_delete', [
                    'idModel'=>'deleteModel'.$index, 
                    'message'=>$lang->messageModelDelete,
                    'title'=>$lang->titleModelDelete,
                    'button'=>$lang->buttonModelDelete,
                    'name'=>$item->getName(), 'action'=>route('deleteTable')])
                    <img class="style_icon_menu pointer" src="{{asset('/lib/icons/wrench-adjustable.svg')}}" onclick="displayEditForm('#editModel{{$index}}', '{{$item->getName()}}')"/>
                    @include('modal_custom_table', [
                        'idModal'=>'editModel'.$index, 
                        'idForm'=>'editForm'.$index, 
                        'action'=>route('editTable'), 
                        'title'=>$lang->ScreenModelEdit, 
                        'button'=>$lang->ButtonModelEdit])
                </td>
            </tr>
            @endforeach            
        </tbody>
        <tfoot>
            <tr>
                <th>{{ $lang->TableId }}</th>
                <th>{{ $lang->TableName }}</th>
                <th>{{ $lang->TabelEvent }}</th>
            </tr>
        </tfoot>
    </table>
</div>
<script type="text/javascript">
    let setting = [
    { 'searchable': true, className: "text-left" },
    { 'searchable': true, className: "text-left" },
    { 'searchable': false }
];
function displayEditForm(id, name){
    removeClass(id);
    openModal(id);
    $(id).find('#name').val(name);
}
 $('#input_number').on('input invalid', function() {
    if (this.validity.valueMissing)
        this.setCustomValidity(@json($lang->error3));
    else if (this.value < 1 || this.value > 8)
        this.setCustomValidity(@json($lang->error4));
    else
        this.setCustomValidity('');
});

</script>
@endsection