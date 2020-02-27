window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
});
var fa = require("fontawesome");

$(function() {
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://api.novaposhta.ua/v2.0/json/",
        "method": "POST",
        "headers": {
            "content-type": "application/json",

        },
        "processData": false,
        // "data": {
        //     "apiKey": "f2595f7fe8718f38f17195c10127fcb2",
        //     "modelName": "Address",
        //     "calledMethod": "searchSettlements",
        //     "methodProperties": {
        //         "CityName": "київ",
        //         "Limit": 5
        //     }
        // },
        "data": "{" +
                "\"apiKey\": \"f2595f7fe8718f38f17195c10127fcb2\"," +
                "\"modelName\": \"AddressGeneral\"," +
                "\"calledMethod\": \"getWarehouses\"," +
                "\"methodProperties\": {" +
                    " \"CityName\": \"Седлище\"," +
                    " \"Limit\": 5" +
                "}" +
            "}"
    };
    //console.log(settings.data);
    // $.ajax(settings).done(function (response) {
    //    console.log(response);
    // });
});
