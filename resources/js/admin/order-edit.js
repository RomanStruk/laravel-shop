require('./basic');
//
require('admin-lte/plugins/select2/js/select2');
$(function () {
    'use strict';
    //Initialize Select2 Elements
    // $('#input-product').select2();
    //generates random id;
    let guid = () => {
        let s4 = () => {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }
        //return id of format 'aaaaaaaa'-'aaaa'-'aaaa'-'aaaa'-'aaaaaaaaaaaa'
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
    };

    let select2ProductsOptions = {
        ajax: {
            url: "/api/v1/search/products",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                let res = $.map(data.data, function (obj) {
                    obj.text = obj.title; // replace name with the property used for the text
                    return obj;
                });
                return {
                    results: res,
                    pagination: {
                        more: (params.page * 30) < data.total
                    }
                };
            },
            cache: true
        },
        placeholder: 'Search for a product',
        minimumInputLength: 1,
        allowClear: true
    };
    let select2UserOptions = {
        ajax: {
            url: "/api/v1/search/users",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                // scrolling can be used
                params.page = params.page || 1;
                let res = $.map(data.data, function (obj) {
                    obj.text = obj.text || obj.fullName; // replace name with the property used for the text
                    return obj;
                });
                return {
                    results: res,
                    pagination: {
                        more: (params.page * 30) < data.total
                    }
                };
            },
            cache: true
        },
        placeholder: 'Enter user`s email or name',
        minimumInputLength: 1,
        allowClear: true
    };
    let select2ShippingOptions = {
        ajax: {
            url: "/api/v1/shipping/city",
            dataType: 'json',
            delay: 1000,
            data: function (params) {
                return {
                    title: params.term, // search term
                    shipping_method: 'novaposhta',
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                let res = $.map(data, function (obj) {
                    obj.text = obj.description; // replace name with the property used for the text
                    obj.id = obj.code; // replace name with the property used for the text
                    return obj;
                });
                return {results: res};
            },
            cache: true
        },
        placeholder: 'Введіть назву населеного пункту',
        minimumInputLength: 1,
        allowClear: false
    };
    let select2AddressOptions = {
        ajax: {
            url: "/api/v1/shipping/address",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    code: $("#shipping-select2").val(), // search term
                    search: params.term, // search term
                    shipping_method: 'novaposhta',
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                let res = $.map(data, function (obj) {
                    obj.text = obj.text || obj.title; // replace name with the property used for the text
                    obj.id = obj.code; // replace name with the property used for the text
                    return obj;
                });
                return {results: res};
            },
            cache: true
        },
        placeholder: 'Виберіть відділення',
    };

    let select2SyllableOptions = {
        ajax: {
            url: "/api/v1/syllable/index",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                let res = $.map(data, function (obj) {
                    obj.text = obj.text || obj.title; // replace name with the property used for the text
                    obj.id = obj.code; // replace name with the property used for the text
                    return obj;
                });
                return {results: res};
            },
            cache: true
        },
        placeholder: 'Виберіть товар зі складу',
    };
    $(".product-select2").select2(select2ProductsOptions);
    $("#user-select2").select2(select2UserOptions);
    $("#shipping-select2").select2(select2ShippingOptions);
    $("#address-select2").select2(select2AddressOptions);

    $('.product-select2').on('select2:select', function (e) {
        var data = e.params.data;
        select2SyllableOptions.ajax.url = "/api/v1/syllable/index?product_id="+data.id;
        $(".syllable-select2").select2(select2SyllableOptions);
        console.log(data);
    });

    $('input[name="shipping_method"]').click(function () {
        $(this).tab('show');
        $(this).removeClass('active');
    });
    $('#add-new-field').click(function () {
        // $("#ele-for-clone").clone().appendTo("#card-for-clone");
        let id = guid();
        $('#card-for-append').append(
            '<div class="form-group row">\n' +
            '            <div class="col-6">\n' +
            '                <select name="products['+id+'][id]" class="form-control product-select2" id="'+id+'"></select>\n' +
            '            </div>\n' +
            '             <div class="col-4">\n' +
            '                <select name="products['+id+'][syllable]" class="form-control syllable-select2"></select>\n' +
            '            </div>' +
            '            <div class="col-2">\n' +
            '                <input type="number" name="products['+id+'][count]" class="form-control" value="1">\n' +
            '            </div>\n' +
            '</div>');
        $(".product-select2").select2(select2ProductsOptions);
        return false;
    });

});
