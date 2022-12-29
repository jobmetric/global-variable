<?php

namespace JobMetric\GlobalVariable\Object;

use Exception;
use JobMetric\GlobalVariable\Events\Document\AddPlugin;
use JobMetric\GlobalVariable\Events\Document\Construct;
use Mobile_Detect;

class Document
{
    private static Document $instance;

    private ?string $section = null;
    private ?string $title = null;
    private ?string $description = null;
    private ?string $keywords = null;
    private ?string $canonical = null;
    private string $robots = 'index,follow';
    private ?string $logo = null;
    private ?string $favicon = null;
    private ?string $theme_color = null;
    private ?string $background_color = null;
    private array $plugins = [];
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
        if (config()->has('global-variable.logo')) {
            $this->logo = config('global-variable.logo');
        }

        if (config()->has('global-variable.favicon')) {
            $this->favicon = config('global-variable.favicon');
        }

        if (config()->has('global-variable.pwa.theme_color')) {
            $this->theme_color = config('global-variable.pwa.theme_color');
        }

        if (config()->has('global-variable.pwa.background_color')) {
            $this->background_color = config('global-variable.pwa.background_color');
        }

        event(new Construct);
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
     * @return string|null
     */
    public function getSection(): ?string
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
     * @return string|null
     */
    public function getTitle(): ?string
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
     * @return string|null
     */
    public function getDescription(): ?string
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
     * @return string|null
     */
    public function getKeywords(): ?string
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
     * @return string
     */
    public function getCanonical(): string
    {
        $theme = '';
        if ($this->canonical) {
            $theme .= '<!-- canonical -->
    <link rel="canonical" href="'.$this->canonical.'" />';
        }

        return $theme;
    }

    /**
     * set robots
     *
     * @param string $robots
     *
     * @return void
     */
    public function setRobots(string $robots): void
    {
        $this->robots = $robots;
    }

    /**
     * get robots
     *
     * @return string
     */
    public function getRobots(): string
    {
        return '<!-- robots -->
    <meta name="robots" content="'.$this->robots.'">';
    }

    /**
     * get theme color value
     *
     * @return string|null
     */
    public function getThemeColorValue(): ?string
    {
        return $this->theme_color;
    }

    /**
     * get theme color
     *
     * @return string
     */
    public function getThemeColor(): string
    {
        $theme = '';
        if ($this->theme_color) {
            $theme .= '<!-- theme color -->
    <meta name="theme-color" content="'.$this->theme_color.'">
    <meta name="msapplication-TileColor" content="'.$this->theme_color.'">';
        }

        return $theme;
    }

    /**
     * get background color value
     *
     * @return string|null
     */
    public function getBackgroundColorValue(): ?string
    {
        return $this->background_color;
    }

    /**
     * get open graph
     *
     * @return string
     */
    public function getOpenGraph(): string
    {
        $theme = '';
        if ($this->theme_color) {
            $theme .= '<!-- open graph -->
    <meta name="dc.title" content="'.(__('base.name') ? __('base.name').' | ' : '').$this->title.'">
    <meta name="dc.description" content="'.$this->description.'">
    <meta property="og:locale" content="'.__('base.og.locale').'">
    <meta property="og:type" content="'.__('base.og.type').'">
    <meta property="og:title" content="'.(__('base.name') ? __('base.name').' | ' : '').$this->title.'">
    <meta name="og.description" content="'.$this->description.'">
    <meta property="og:url" content="'.$this->canonical.'">
    <meta property="og:site_name" content="'.(__('base.name') ? __('base.name').' | ' : '').$this->title.'">';
        }

        return $theme;
    }

    /**
     * get favicon
     *
     * @return string
     */
    public function getFavicon(): string
    {
        $theme = '';
        if ($this->favicon) {
            $theme .= '<!-- favicon -->
    <link href="'.$this->favicon.'" rel="icon"/>
    <link href="'.$this->favicon.'" rel="icon" type="image/png" sizes="16x16"/>
    <link href="'.$this->favicon.'" rel="icon" type="image/png" sizes="32x32"/>
    <link href="'.$this->favicon.'" rel="icon" type="image/png" sizes="96x96"/>
    <link href="'.$this->favicon.'" rel="icon" type="image/png" sizes="160x160"/>
    <link href="'.$this->favicon.'" rel="icon" type="image/png" sizes="196x196"/>
    <link href="'.$this->favicon.'" rel="apple-touch-icon" sizes="57x57"/>
    <link href="'.$this->favicon.'" rel="apple-touch-icon" sizes="60x60"/>
    <link href="'.$this->favicon.'" rel="apple-touch-icon" sizes="72x72"/>
    <link href="'.$this->favicon.'" rel="apple-touch-icon" sizes="76x76"/>
    <link href="'.$this->favicon.'" rel="apple-touch-icon" sizes="144x144"/>
    <link href="'.$this->favicon.'" rel="apple-touch-icon" sizes="120x120"/>
    <link href="'.$this->favicon.'" rel="apple-touch-icon" sizes="152x152"/>';
        }

        return $theme;
    }
    
    /**
     * get favicon value
     *
     * @return string
     */
    public function getFaviconValue(): string
    {
        return $this->favicon;
    }

    /**
     * get manifest
     *
     * @return string
     */
    public function getManifest(): string
    {
        $theme = '';
        if ($this->check_device('mobile') or $this->check_device('tablet')) {
            $theme .= '<!-- manifest -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="msapplication-starturl" content="/">

    <link href="'.$this->favicon.'" rel="icon" sizes="192x192">
    <link href="'.$this->favicon.'" rel="icon" sizes="128x128">
    <link href="'.$this->favicon.'" rel="apple-touch-icon" sizes="128x128">
    <link href="'.$this->favicon.'" rel="apple-touch-icon-precomposed" sizes="128x128">
    <link href="'.$this->favicon.'" rel="apple-touch-startup-image"
          media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link href="'.$this->favicon.'" rel="apple-touch-startup-image"
          media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link href="'.$this->favicon.'" rel="apple-touch-startup-image"
          media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link href="'.$this->favicon.'" rel="apple-touch-startup-image"
          media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link href="'.$this->favicon.'" rel="apple-touch-startup-image"
          media="(min-device-width: 768px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">
    <link href="'.$this->favicon.'" rel="apple-touch-startup-image"
          media="(min-device-width: 834px) and (max-device-width: 834px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">
    <link href="'.$this->favicon.'" rel="apple-touch-startup-image"
          media="(min-device-width: 1024px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">

    <link rel="manifest" href="'.route('global.manifest.index').'">';
        } else {
            $theme .= '<!-- manifest -->
    <link rel="manifest" href="'.route('global.manifest.index').'">';
        }

        return $theme;
    }

    /**
     * set plugins
     *
     * @param string $key
     * @param callable $func
     *
     * @return void
     */
    public function setPlugin(string $key, callable $func): void
    {
        $this->plugins[$key] = $func;
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
                $theme .= '
<link rel="'.$style['rel'].'" type="text/css" href="'.$style['href'].'"/>';
            }
        }

        return $theme;
    }

    /**
     * set script page
     *
     * @param string $src
     * @param bool $async
     * @param bool $defer
     *
     * @return void
     */
    public function addScript(string $src, bool $async = false, bool $defer = false): void
    {
        $this->scripts[md5($src)] = [
            'src'   => $src,
            'async' => $async,
            'defer' => $defer
        ];
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
            $async = $script['async'] ? ' async' : '';
            $defer = $script['defer'] ? ' defer' : '';

            $theme .= '
    <script type="text/javascript" src="'.$script['src'].'"'.$async.$defer.'></script>';
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
        $parameters = func_get_args();

        $plugins = require realpath(__DIR__.'/../../data/plugins.php');
        foreach ($plugins as $key => $func) {
            $this->setPlugin($key, $func);
        }

        event(new AddPlugin);

        foreach ($parameters as $parameter) {
            if (!isset($this->localize_counter[$parameter])) {
                $this->localize_counter[$parameter] = true;

                if (isset($this->plugins[$parameter])) {
                    $this->plugins[$parameter]();
                } else {
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
