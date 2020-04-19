window._ = require('lodash');

try {
    // <!-- REQUIRED SCRIPTS -->
    // window.Popper = require('popper.js').default;

    window.$ = window.jQuery = require('jquery');

    // <!-- Bootstrap 4 -->
    require('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min');

    require('admin-lte'); // Include AdminLTE
    // require('./scripts');
} catch (e) {}
