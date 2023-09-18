
function showModalClientes() {
    $("#modal_clientes").modal("show");
}

function closeModal(modal){
    let modal_name = $(modal).attr('attr').toString();
    $("#" + modal_name).modal("hide");
}

function closeModalById(id){
    let modal_name = $("#" + id);
    modal_name.modal("hide");
}