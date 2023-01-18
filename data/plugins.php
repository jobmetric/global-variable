<?php

use GlobalVariable;

return [

    /*
    |--------------------------------------------------------------------------
    | Plugins
    |--------------------------------------------------------------------------
    |
    | All default plugins in document object
    |
    */

    'jquery'      => function () {
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/jquery/jquery.min.js');
    },
    'jquery.form' => function () {
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/jquery.form/jquery.form.min.js');
    },
    'jquery.ui' => function () {
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/jquery-ui/jquery-ui.js');

        GlobalVariable::document()->addStyle('vendor/global-variable/plugins/jquery-ui-bootstrap/jquery.ui.ie.css');
        GlobalVariable::document()->addStyle('vendor/global-variable/plugins/jquery-ui-bootstrap/jquery-ui.css');

        GlobalVariable::document()->addStyle('vendor/global-variable/plugins/datetime/jquery-ui-timepicker-addon.css');
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/datetime/jquery-ui-timepicker-addon.js');
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/datetime/jquery-ui-timepicker-addon-i18n.js');

        if (Session::get('calendar') == 'jalali') {
            GlobalVariable::document()->addScript('vendor/global-variable/plugins/datetime/jalali.js');
        }
    },
    'jquery.ui.theme' => function () {
        GlobalVariable::document()->addPlugin('jquery-ui');

        GlobalVariable::document()->addStyle('vendor/global-variable/plugins/jquery-ui/jquery-ui.min.css');
        GlobalVariable::document()->addStyle('vendor/global-variable/plugins/jquery-ui/jquery-ui.theme.min.css');
        GlobalVariable::document()->addStyle('vendor/global-variable/plugins/jquery-ui/jquery-ui.structure.min.css');
    },
    'sweetalert' => function () {
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/sweetalert2/dist/sweetalert2.min.js');
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/sweetalert2/dist/sweetalert2.init.js');

        if (__('base.direction') == 'rtl') {
            GlobalVariable::document()->addStyle('vendor/global-variable/plugins/sweetalert2/dist/sweetalert2.rtl.min.css');
        } else {
            GlobalVariable::document()->addStyle('vendor/global-variable/plugins/sweetalert2/dist/sweetalert2.min.css');
        }

        GlobalVariable::document()->addLocalize('language', [
            'sweetalert' => [
                'title'    => [
                    'warning'    => trans('global-variable:base.sweetalert.title.warning'),
                    'attention'  => trans('global-variable:base.sweetalert.title.attention'),
                    'permission' => trans('global-variable:base.sweetalert.title.permission'),
                    'timer'      => trans('global-variable:base.sweetalert.option.timer'),
                    'background' => trans('global-variable:base.sweetalert.option.background'),
                ],
                'button'   => [
                    'realized'       => trans('global-variable:base.sweetalert.button.realized'),
                    'got_it'         => trans('global-variable:base.sweetalert.button.got_it'),
                    'confirm_button' => trans('global-variable:base.sweetalert.button.ok'),
                    'cancel_button'  => trans('global-variable:base.sweetalert.button.cancel'),
                    'cancel'         => trans('global-variable:base.sweetalert.button.cancel'),
                    'ok'             => trans('global-variable:base.sweetalert.button.ok'),
                ],
                'position' => [
                    'center' => trans('global-variable:base.sweetalert.option.position.center'),
                    'end'    => trans('global-variable:base.sweetalert.option.position.end'),
                ],
            ],
        ]);
    },
    'datatable' => function () {
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/datatables/datatables.bundle.js');

        if (__('base.direction') == 'rtl') {
            GlobalVariable::document()->addStyle('vendor/global-variable/plugins/datatables/datatables.bundle.rtl.css');
        } else {
            GlobalVariable::document()->addStyle('vendor/global-variable/plugins/datatables/datatables.bundle.css');
        }

        GlobalVariable::document()->addLocalize('language', [
            'datatable' => [
                'processing'     => trans('global-variable:base.datatable.processing'),
                'search'         => trans('global-variable:base.datatable.search'),
                'lengthMenu'     => trans('global-variable:base.datatable.lengthMenu'),
                'info'           => trans('global-variable:base.datatable.info'),
                'infoEmpty'      => trans('global-variable:base.datatable.infoEmpty'),
                'infoFiltered'   => trans('global-variable:base.datatable.infoFiltered'),
                'infoPostFix'    => trans('global-variable:base.datatable.infoPostFix'),
                'loadingRecords' => trans('global-variable:base.datatable.loadingRecords'),
                'zeroRecords'    => trans('global-variable:base.datatable.zeroRecords'),
                'emptyTable'     => trans('global-variable:base.datatable.emptyTable'),
                'paginate'       => [
                    'first'    => trans('global-variable:base.datatable.paginate_first'),
                    'previous' => trans('global-variable:base.datatable.paginate_previous'),
                    'next'     => trans('global-variable:base.datatable.paginate_next'),
                    'last'     => trans('global-variable:base.datatable.paginate_last'),
                ],
            ]
        ]);

        GlobalVariable::document()->addLocalize('settings', [
            'datatable' => [
                'limit' => config('global-variable.page_limit')
            ]
        ]);
    },
    'select2' => function () {
        GlobalVariable::document()->addStyle('vendor/global-variable/plugins/select2/dist/css/select2.min.css');
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/select2/dist/js/select2.full.min.js');

        GlobalVariable::document()->addScript('vendor/global-variable/plugins/select2/dist/js/i18n/'.__('base.lang').'.js');
    },
    'tree' => function () {
        GlobalVariable::document()->addStyle('vendor/global-variable/plugins/tree/tree.css');
    },
    'md5' => function () {
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/md5/md5.js');
    },
    'cookie' => function () {
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/cookie/src/js.cookie.js');
    },
    'storage' => function () {
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/storage/jquery.storage.min.js');
    },
    'fullscreen' => function () {
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/fullscreen/jquery.fullscreen.js');
    },
    'owl.carousel' => function () {
        GlobalVariable::document()->addStyle('vendor/global-variable/plugins/owl.carousel/owl.carousel.min.css');
        GlobalVariable::document()->addStyle('vendor/global-variable/plugins/owl.carousel/owl.theme.default.min.css');

        GlobalVariable::document()->addScript('vendor/global-variable/plugins/owl.carousel/owl.carousel.min.js');
    },
    'draggable' => function () {
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/draggable/draggable.bundle.js');
    },
    'tinymce' => function () {
        GlobalVariable::document()->addScript('vendor/global-variable/plugins/tinymce/tinymce.bundle.js');
    }

];
