require('./basic');
require('./require/import-axios');

//
// ToaStr
global.toastr = require('admin-lte/plugins/toastr/toastr.min');
//select2
require('admin-lte/plugins/select2/js/select2.full.min');
//jQuery ready
$(document).ready(function () {

    'use strict';

    //Initialize Select2 Elements
    $("#supplier").select2({
        ajax: {
            url: "/api/v1/supplier", // index
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
                    obj.text = obj.name; // replace name with the property used for the text
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
        minimumInputLength: 1
    });

    //Initialize Select2 Elements
    $("#product").select2({
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
