require('./basic');
require('./require/import-axios');

window.Vue = require('vue');


Vue.component('UploadImages', require('./components/UploadImages.vue').default);

const app = new Vue({
    el: '#app'
});
//
// ToaStr
global.toastr = require('admin-lte/plugins/toastr/toastr.min');
//select2
require('admin-lte/plugins/select2/js/select2.full.min');

//jQuery ready
$(document).ready(function () {

    'use strict';

    $('.product-image-thumb').on('click', function() {
        const image_element = $(this).find('img');
        $('.product-image').prop('src', $(image_element).attr('src'))
        $('.product-image-thumb.active').removeClass('active');
        $(this).addClass('active');
    });

    $(document).ready(function() {
        $('.form-check-input[type=radio]').click(function (e) {
            console.log($(this).parents('.dropdown').siblings('a'));
            $(this).parents('.dropdown').children('a').removeClass('btn-secondary');
            $(this).parents('.dropdown').children('a').addClass('btn-primary');
        })
    });
    // bsCustomFileInput.init();
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    //Initialize Select2 Elements
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