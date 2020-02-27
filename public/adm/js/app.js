(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/adm/js/app"],{

/***/ "./resources/js/admin/app.js":
/*!***********************************!*\
  !*** ./resources/js/admin/app.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

window._ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");

try {
  window.Popper = __webpack_require__(/*! popper.js */ "./node_modules/popper.js/dist/esm/popper.js")["default"];
  window.$ = window.jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

  __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js");
} catch (e) {}

window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");
var app = new Vue({
  el: '#app'
});

var fa = __webpack_require__(/*! fontawesome */ "./node_modules/fontawesome/index.js");

$(function () {
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://api.novaposhta.ua/v2.0/json/",
    "method": "POST",
    "headers": {
      "content-type": "application/json"
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
    "data": "{" + "\"apiKey\": \"f2595f7fe8718f38f17195c10127fcb2\"," + "\"modelName\": \"AddressGeneral\"," + "\"calledMethod\": \"getWarehouses\"," + "\"methodProperties\": {" + " \"CityName\": \"Седлище\"," + " \"Limit\": 5" + "}" + "}"
  }; //console.log(settings.data);
  // $.ajax(settings).done(function (response) {
  //    console.log(response);
  // });
});

/***/ }),

/***/ "./resources/sass/admin/app.scss":
/*!***************************************!*\
  !*** ./resources/sass/admin/app.scss ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***************************************************************************************************!*\
  !*** multi ./resources/js/admin/app.js ./resources/sass/app.scss ./resources/sass/admin/app.scss ***!
  \***************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /home/roman/Документи/Programming/PHP/laravel.shop/resources/js/admin/app.js */"./resources/js/admin/app.js");
__webpack_require__(/*! /home/roman/Документи/Programming/PHP/laravel.shop/resources/sass/app.scss */"./resources/sass/app.scss");
module.exports = __webpack_require__(/*! /home/roman/Документи/Programming/PHP/laravel.shop/resources/sass/admin/app.scss */"./resources/sass/admin/app.scss");


/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);