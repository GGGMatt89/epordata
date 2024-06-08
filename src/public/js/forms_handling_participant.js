$(document).ready(function () {
    $('#customer_id').change(function () {
        let selected = $(this).val();
        $.ajaxSetup({
            cache: false
        });
        $.ajax({
            url: "/getCustomer/" + selected,
            method: 'GET',
            success: function(result){
                $('#customer_id').val(result.id);
                $('#first_name').val(result.first_name);
                $('#last_name').val(result.last_name);
            }

        }

        )
    });
});