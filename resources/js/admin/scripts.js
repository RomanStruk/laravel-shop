
require('admin-lte/plugins/jquery-ui/jquery-ui.min');

// <!-- Bootstrap 4 -->
require('admin-lte/plugins/bootstrap/js/bootstrap.bundle');

// <!-- ChartJS -->
global.Chart = require('chart.js');

// <!-- Sparkline -->
global.Sparkline = require('admin-lte/plugins/sparklines/sparkline');

// <!-- JQVMap -->
require('admin-lte/plugins/jqvmap/jquery.vmap.min');
require('admin-lte/plugins/jqvmap/maps/jquery.vmap.usa');

// <!-- jQuery Knob Chart -->
require('admin-lte/plugins/jquery-knob/jquery.knob.min');

// <!-- daterangepicker -->
global.moment = require('moment');
import 'daterangepicker';
import 'moment-timezone';

// <!-- Tempusdominus Bootstrap 4 -->
require('tempusdominus-bootstrap-4');



// <!-- Summernote -->
require('admin-lte/plugins/summernote/summernote-bs4.min');

// <!-- overlayScrollbars -->
require('admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min');


import bsCustomFileInput from 'admin-lte/plugins/bs-custom-file-input/bs-custom-file-input'
$(document).ready(function () {
    bsCustomFileInput.init();
});

