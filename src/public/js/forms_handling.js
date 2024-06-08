$(document).ready(function () {
    $('#cust-select').change(function () {
        let selected = $(this).val();
        $.ajaxSetup({
            cache: false
        });
        $.ajax({
            url: "/getCustomer/" + selected,
            method: 'GET',
            success: function(result){
                $('#cust-id').val(result.id);
                $('#cust-name').val(result.first_name);
                $('#cust-surname').val(result.last_name);
                $('#meet-place').val(result.address + ' ' + result.city);
            }

        }

        )
    });
});
