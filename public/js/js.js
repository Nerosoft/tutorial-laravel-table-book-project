function validForm(idForm){
    $(idForm).addClass('was-validated');
}
function removeClass(idModal){
    $(idModal).find('form').removeClass('was-validated');
}

function showMessageCustom(event, reqError, invError){
    if(event.validity.valueMissing)
        event.setCustomValidity(reqError);
    else if(event.validity.tooShort)
        event.setCustomValidity(invError);
    else
        event.setCustomValidity('');
}


function openModal(id){
    $(id).modal('show');
}
function closeModal(id){
    $(id).modal('hide');
}