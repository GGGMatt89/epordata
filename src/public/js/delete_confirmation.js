function deleteEntry(id){
    Swal.fire({
        title: 'Sei sicuro?',
        text: "I dati cancellati non possono essere recuperati",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'rgb(5, 32, 66)',
        cancelButtonColor: '#fe3636',
        confirmButtonText: 'Conferma',
        cancelButtonText: 'Annulla'
    }).then((result) => {
        if (result.value) {
            $('#'+id+'_delete_form').submit();
        }
    });
}
