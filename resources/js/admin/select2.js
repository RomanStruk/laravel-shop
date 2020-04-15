require('admin-lte/plugins/select2/js/select2.full');
$(function () {
    //Initialize Select2 Elements
    $('#input-product').select2();
    $("#input-related").select2({
        ajax: {
            url: "/api/v1/product/search",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data.data,
                    pagination: {
                        more: (params.page * 30) < data.total
                    }
                };
            },
            cache: true
        },
        placeholder: 'Search for a product',
        minimumInputLength: 1
    });
});
