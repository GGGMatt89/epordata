$(document).ready(function () {
    $('#prov-select').change(function () {
        let selected = $(this).val();
        $.ajaxSetup({
            cache: false
        });
        $.ajax({
                url: "/getProvider/" + selected,
                method: 'GET',
                success: function (result) {
                    $('#provider-id').val(result.id);
                    $('#provider-name').val(result.bus_name);
                }

            }

        )
    });
});