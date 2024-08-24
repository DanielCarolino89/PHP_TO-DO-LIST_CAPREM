document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('ModalEditar');

    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var descricao = button.getAttribute('data-descricao');

        var inputDescricao = modal.querySelector('#edit_descricao');
        var inputId = modal.querySelector('#edit_id');

        inputDescricao.value = descricao;
        inputId.value = id;
    });
});



