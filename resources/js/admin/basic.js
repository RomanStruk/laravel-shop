window._ = require('lodash');

try {
    // <!-- REQUIRED SCRIPTS -->
    // window.Popper = require('popper.js').default;

    window.$ = window.jQuery = require('jquery');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // <!-- Bootstrap 4 -->
    require('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min');

    require('admin-lte'); // Include AdminLTE
    // require('./scripts');
} catch (e) {}

require('jquery-typeahead/dist/jquery.typeahead.min');
$.typeahead({
    input: ".js-typeahead",
    minLength: 1,
    maxItem: 15,
    order: "asc",
    hint: true,
    group: {
        template: "{{group}}"
    },
    maxItemPerGroup: 5,
    backdrop: {
        "background-color": "#fff"
    },
    href: function (item) {
        return item.route_show
    },
    dropdownFilter: "Всі результати",
    emptyTemplate: 'No result for "{{query}}"',
    dynamic: true,
    display: ["email", "fullName", "title", "content"],
    source: {
        "users": {
            ajax: function(query){
                return {
                    url: "/api/v1/search/users",
                    path: "data",
                    data: {
                        q: query
                    }
                }
            }
        },
        "products": {
            ajax:  function(query){
                return {
                    url: "/api/v1/search/products",
                    path: "data",
                    data: {
                        q: query
                    }
                }
            }
        },
    }
});