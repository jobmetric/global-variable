<?php

use JobMetric\GlobalVariable\Object\Document;

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
        $this->addScript('vendor/global-variable/plugins/jquery/jquery.min.js');
    },
    'jquery.form' => function () {
        $this->addScript('vendor/global-variable/plugins/jquery.form/jquery.form.min.js');
    },
    'jquery.ui' => function () {
        $this->addScript('vendor/global-variable/plugins/jquery-ui/jquery-ui.js');

        $this->addStyle('vendor/global-variable/plugins/jquery-ui-bootstrap/jquery.ui.ie.css');
        $this->addStyle('vendor/global-variable/plugins/jquery-ui-bootstrap/jquery-ui.css');

        $this->addStyle('vendor/global-variable/plugins/datetime/jquery-ui-timepicker-addon.css');
        $this->addScript('vendor/global-variable/plugins/datetime/jquery-ui-timepicker-addon.js');
        $this->addScript('vendor/global-variable/plugins/datetime/jquery-ui-timepicker-addon-i18n.js');

        if (Session::get('calendar') == 'jalali') {
            $this->addScript('vendor/global-variable/plugins/datetime/jalali.js');
        }
    },
    'jquery.ui.theme' => function () {
        $this->addPlugin('jquery-ui');

        $this->addStyle('vendor/global-variable/plugins/jquery-ui/jquery-ui.min.css');
        $this->addStyle('vendor/global-variable/plugins/jquery-ui/jquery-ui.theme.min.css');
        $this->addStyle('vendor/global-variable/plugins/jquery-ui/jquery-ui.structure.min.css');
    },
    'sweetalert' => function () {
        $this->addScript('vendor/global-variable/plugins/sweetalert2/dist/sweetalert2.min.js');
        $this->addScript('vendor/global-variable/plugins/sweetalert2/dist/sweetalert2.init.js');

        if (__('base.direction') == 'rtl') {
            $this->addStyle('vendor/global-variable/plugins/sweetalert2/dist/sweetalert2.rtl.min.css');
        } else {
            $this->addStyle('vendor/global-variable/plugins/sweetalert2/dist/sweetalert2.min.css');
        }

        $this->addLocalize('language', [
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
        $this->addScript('vendor/global-variable/plugins/datatables/datatables.bundle.js');

        if (__('base.direction') == 'rtl') {
            $this->addStyle('vendor/global-variable/plugins/datatables/datatables.bundle.rtl.css');
        } else {
            $this->addStyle('vendor/global-variable/plugins/datatables/datatables.bundle.css');
        }

        $this->addLocalize('language', [
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

        $this->addLocalize('settings', [
            'datatable' => [
                'limit' => config('global-variable.page_limit')
            ]
        ]);
    },
    'select2' => function () {
        $this->addStyle('vendor/global-variable/plugins/select2/dist/css/select2.min.css');
        $this->addScript('vendor/global-variable/plugins/select2/dist/js/select2.full.min.js');

        $this->addScript('vendor/global-variable/plugins/select2/dist/js/i18n/'.__('base.lang').'.js');
    },
    'tree' => function () {
        $this->addStyle('vendor/global-variable/plugins/tree/tree.css');
    },
    'md5' => function () {
        $this->addScript('vendor/global-variable/plugins/md5/md5.js');
    },
    'cookie' => function () {
        $this->addScript('vendor/global-variable/plugins/cookie/src/js.cookie.js');
    },
    'storage' => function () {
        $this->addScript('vendor/global-variable/plugins/storage/jquery.storage.min.js');
    },
    'fullscreen' => function () {
        $this->addScript('vendor/global-variable/plugins/fullscreen/jquery.fullscreen.js');
    },
    'owl.carousel' => function () {
        $this->addStyle('vendor/global-variable/plugins/owl.carousel/owl.carousel.min.css');
        $this->addStyle('vendor/global-variable/plugins/owl.carousel/owl.theme.default.min.css');

        $this->addScript('vendor/global-variable/plugins/owl.carousel/owl.carousel.min.js');
    },
    'draggable' => function () {
        $this->addScript('vendor/global-variable/plugins/draggable/draggable.bundle.js');
    },
    'tinymce' => function () {
        $this->addScript('vendor/global-variable/plugins/tinymce/tinymce.bundle.js');
    }

];
