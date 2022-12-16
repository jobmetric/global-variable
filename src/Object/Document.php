<?php

namespace JobMetric\GlobalVariable\Object;

use Exception;
use Mobile_Detect;

class Document
{
    private static Document $instance;

    private ?string $section = null;
    private ?string $title = null;
    private ?string $description = null;
    private ?string $keywords = null;
    private ?string $canonical = null;
    private array $localize = [];
    private array $localize_counter = [];
    private array $links = [];
    private array $styles = [];
    private array $scripts = [];

    /**
     * construct instance object
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * get instance object
     *
     * @return Document
     */
    public static function getInstance(): Document
    {
        if (empty(Document::$instance)) {
            Document::$instance = new Document();
        }

        return Document::$instance;
    }

    /**
     * set app section
     *
     * @param string $section
     *
     * @return void
     */
    public function setSection(string $section)
    {
        $this->section = $section;
    }

    /**
     * get app section
     *
     * @return string
     */
    public function getSection(): string
    {
        return $this->section;
    }

    /**
     * set title page
     *
     * @param string $title
     *
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * get title page
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * set description page
     *
     * @param string $description
     *
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * get description page
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * set keywords page
     *
     * @param string $keywords
     *
     * @return void
     */
    public function setKeywords(string $keywords): void
    {
        $this->keywords = $keywords;
    }

    /**
     * get keywords page
     *
     * @return string
     */
    public function getKeywords(): string
    {
        return $this->keywords;
    }

    /**
     * set canonical link
     *
     * @param string $url
     *
     * @return void
     */
    public function setCanonical(string $url): void
    {
        $this->canonical = $url;
    }

    /**
     * get canonical link
     *
     * @return string|null
     */
    public function getCanonical(): ?string
    {
        return $this->canonical;
    }

    /**
     * set link page
     *
     * @param string $href
     * @param string $rel
     *
     * @return void
     */
    public function addLink(string $href, string $rel): void
    {
        $this->links[$href] = [
            'href' => $href,
            'rel'  => $rel
        ];
    }

    /**
     * get link page
     *
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * set style page
     *
     * @param string $href
     * @param string $rel
     * @param string $media
     *
     * @return void
     */
    public function addStyle(string $href, string $rel = 'stylesheet', string $media = ''): void
    {
        $this->styles[md5($href)] = [
            'href'  => $href,
            'rel'   => $rel,
            'media' => $media
        ];
    }

    /**
     * get style theme
     *
     * @return string
     */
    public function getStyles(): string
    {
        $theme = '';
        foreach ($this->styles as $style) {
            if ($style['media'] != '') {
                $theme .= '<link rel="'.$style['rel'].'" type="text/css" media="'.$style['media'].'" href="'.$style['href'].'"/>';
            } else {
                $theme .= '<link rel="'.$style['rel'].'" type="text/css" href="'.$style['href'].'"/>';
            }
        }

        return $theme;
    }

    /**
     * set script page
     *
     * @param string $script
     *
     * @return void
     */
    public function addScript(string $script): void
    {
        $this->scripts[md5($script)] = $script;
    }

    /**
     * get script theme
     *
     * @return string
     */
    public function getScripts(): string
    {
        $theme = '';
        foreach ($this->scripts as $script) {
            $theme .= '
        <script type="text/javascript" src="'.$script.'"></script>';
        }

        return $theme;
    }

    /**
     * set localize data page
     *
     * @param string|null $key
     * @param array $l10n
     *
     * @return void
     */
    public function addLocalize(string $key = null, array $l10n = []): void
    {
        if ($key) {
            foreach ($l10n as $index => $value) {
                if (!is_scalar($value)) {
                    continue;
                }

                if ($value === true) {
                    $l10n[$index] = true;
                } else if ($value === false) {
                    $l10n[$index] = false;
                } else {
                    $l10n[$index] = html_entity_decode((string)$value, ENT_QUOTES, 'UTF-8');
                }
            }

            if (isset($this->localize[$key])) {
                $this->localize[$key] = array_merge_recursive($this->localize[$key], $l10n);
            } else {
                $this->localize[$key] = $l10n;
            }
        }
    }

    /**
     * get localize theme
     *
     * @return string
     */
    public function getLocalize(): string
    {
        return '<script type="text/javascript">let localize = '.json_encode($this->localize, JSON_UNESCAPED_UNICODE).';</script>';
    }

    /**
     * set plugin script page
     *
     * @return void
     */
    public function addPlugin(): void
    {
        $plugins = func_get_args();

        foreach ($plugins as $plugin) {
            if (!isset($this->localize_counter[$plugin])) {
                $this->localize_counter[$plugin] = true;
                switch ($plugin) {
                    case 'jquery':
                        $this->addScript('vendor/global-variable/plugins/jquery/jquery.min.js');
                        break;
                    case 'jquery.form':
                        $this->addScript('vendor/global-variable/plugins/jquery.form/jquery.form.min.js');
                        break;
                    case 'jquery-ui':
                        $this->addScript('vendor/global-variable/plugins/jquery-ui/jquery-ui.js');

                        $this->addStyle('vendor/global-variable/plugins/jquery-ui-bootstrap/jquery.ui.ie.css');
                        $this->addStyle('vendor/global-variable/plugins/jquery-ui-bootstrap/jquery-ui.css');

                        $this->addStyle('vendor/global-variable/plugins/datetime/jquery-ui-timepicker-addon.css');
                        $this->addScript('vendor/global-variable/plugins/datetime/jquery-ui-timepicker-addon.js');
                        $this->addScript('vendor/global-variable/plugins/datetime/jquery-ui-timepicker-addon-i18n.js');

                        if (Session::get('calendar') == 'jalali') {
                            $this->addScript('vendor/global-variable/plugins/datetime/jalali.js');
                        }
                        break;
                    case 'jquery-ui-theme':
                        $this->addPlugin('jquery-ui');

                        $this->addStyle('vendor/global-variable/plugins/jquery-ui/jquery-ui.min.css');
                        $this->addStyle('vendor/global-variable/plugins/jquery-ui/jquery-ui.theme.min.css');
                        $this->addStyle('vendor/global-variable/plugins/jquery-ui/jquery-ui.structure.min.css');
                        break;
                    case 'sweetalert':
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

                        break;
                    case 'datatable':
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
                        break;
                    case 'select2':
                        $this->addStyle('vendor/global-variable/plugins/select2/dist/css/select2.min.css');
                        $this->addScript('vendor/global-variable/plugins/select2/dist/js/select2.full.min.js');

                        $this->addScript('vendor/global-variable/plugins/select2/dist/js/i18n/'.__('base.lang').'.js');
                        break;
                    case 'tree':
                        $this->addStyle('vendor/global-variable/plugins/tree/tree.css');
                        break;
                    case 'md5':
                        $this->addScript('vendor/global-variable/plugins/md5/md5.js');
                        break;
                    case 'cookie':
                        $this->addScript('vendor/global-variable/plugins/cookie/src/js.cookie.js');
                        break;
                    case 'storage':
                        $this->addScript('vendor/global-variable/plugins/storage/jquery.storage.min.js');
                        break;
                    case 'fullscreen':
                        $this->addScript('vendor/global-variable/plugins/fullscreen/jquery.fullscreen.js');
                        break;
                    case 'owl.carousel':
                        $this->addStyle('vendor/global-variable/plugins/owl.carousel/owl.carousel.min.css');
                        $this->addStyle('vendor/global-variable/plugins/owl.carousel/owl.theme.default.min.css');

                        $this->addScript('vendor/global-variable/plugins/owl.carousel/owl.carousel.min.js');
                        break;
                    case 'draggable':
                        $this->addScript('vendor/global-variable/plugins/draggable/draggable.bundle.js');
                    case 'tinymce':
                        $this->addScript('vendor/global-variable/plugins/tinymce/tinymce.bundle.js');
                        break;
                    default:
                        abort(405, 'Document add plugin "Type" not found');
                }
            }
        }
    }

    /**
     * check device
     *
     * @param string $state
     *
     * @return bool
     */
    public function check_device(string $state): bool
    {
        $detect = new Mobile_Detect;

        if ($state == 'mobile') {
            $check = $detect->isMobile();
        } else if ($state == 'tablet') {
            $check = $detect->isTablet();
        } else {
            try {
                $check = $detect->is($state);
            } catch (Exception $exception) {
                $check = false;
            }
        }

        return $check;
    }
}
