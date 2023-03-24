<?php

namespace JobMetric\GlobalVariable\Object;

use Exception;
use JobMetric\GlobalVariable\Events\Document\AddPlugin;
use JobMetric\GlobalVariable\Events\Document\InitDocument;
use Mobile_Detect;

class Document
{
    private static Document $instance;

    private ?string $logo = null;
    private ?string $favicon = null;
    private ?string $theme_color = null;
    private ?string $background_color = null;
    private ?string $section = null;
    private ?string $title = null;
    private ?string $description = null;
    private ?string $keywords = null;
    private ?string $canonical = null;
    private ?string $image = null;
    private ?string $page_type = null;
    private ?string $robots = 'index,follow';
    private ?string $body_class = null;
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
        if(config()->has('global-variable.logo')) {
            $this->logo = config('global-variable.logo');
        }

        if(config()->has('global-variable.favicon')) {
            $this->favicon = config('global-variable.favicon');
        }

        if(config()->has('global-variable.pwa.theme_color')) {
            $this->theme_color = config('global-variable.pwa.theme_color');
        }

        if(config()->has('global-variable.pwa.background_color')) {
            $this->background_color = config('global-variable.pwa.background_color');
        }
    }

    /**
     * get instance object
     *
     * @return Document
     */
    public static function getInstance(): Document
    {
        if(empty(Document::$instance)) {
            Document::$instance = new Document();

            event(new InitDocument);
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
     * set base image
     *
     * @param string $url
     *
     * @return void
     */
    public function setImage(string $url): void
    {
        $this->image = $url;
    }

    /**
     * set page type
     *
     * @param string $type
     *
     * @return void
     */
    public function setPageType(string $type = 'website'): void
    {
        $this->page_type = $url;
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
     * set body class
     *
     * @param string $body_class
     *
     * @return void
     */
    public function setBodyClass(string $body_class): void
    {
        $this->body_class = $body_class;
    }

    /**
     * set plugins
     *
     * @param string   $key
     * @param callable $func
     *
     * @return void
     */
    public function setPlugin(string $key, callable $func): void
    {
        $this->plugins[$key] = $func;
    }

    /**
     * add link
     *
     * @param string $href
     * @param string $rel
     *
     * @return void
     */
    public function addLink(string $href, string $rel): void
    {
        $this->links[md5($href)] = [
            'href' => $href,
            'rel'  => $rel
        ];
    }

    /**
     * add style
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
     * add style page
     *
     * @param string $slug
     * @param string $rel
     * @param string $media
     *
     * @return void
     */
    public function addStylePage(string $slug, string $rel = 'stylesheet', string $media = ''): void
    {
        $href = 'template/page/'.$slug.'.css';

        $this->styles[md5($href)] = [
            'href'  => $href,
            'rel'   => $rel,
            'media' => $media
        ];
    }

    /**
     * add script
     *
     * @param string $src
     * @param bool   $async
     * @param bool   $defer
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
     * add script page
     *
     * @param string $slug
     * @param bool   $async
     * @param bool   $defer
     *
     * @return void
     */
    public function addScriptPage(string $slug, bool $async = false, bool $defer = false): void
    {
        $src = 'template/page/'.$slug.'.js';

        $this->scripts[md5($src)] = [
            'src'   => $src,
            'async' => $async,
            'defer' => $defer
        ];
    }

    /**
     * set localize data
     *
     * @param string|null $key
     * @param array       $l10n
     *
     * @return void
     */
    public function addLocalize(string $key = null, array $l10n = []): void
    {
        if($key) {
            foreach($l10n as $index => $value) {
                if(!is_scalar($value)) {
                    continue;
                }

                if($value === true) {
                    $l10n[$index] = true;
                } else if($value === false) {
                    $l10n[$index] = false;
                } else {
                    $l10n[$index] = html_entity_decode((string)$value, ENT_QUOTES, 'UTF-8');
                }
            }

            if(isset($this->localize[$key])) {
                $this->localize[$key] = array_merge_recursive($this->localize[$key], $l10n);
            } else {
                $this->localize[$key] = $l10n;
            }
        }
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
        foreach($plugins as $key => $func) {
            $this->setPlugin($key, $func);
        }

        event(new AddPlugin);

        foreach($parameters as $parameter) {
            if(!isset($this->localize_counter[$parameter])) {
                $this->localize_counter[$parameter] = true;

                if(isset($this->plugins[$parameter])) {
                    $this->plugins[$parameter]();
                } else {
                    abort(405, 'Document add plugin "Type" not found');
                }
            }
        }
    }

    /**
     * get logo value
     *
     * @return string|null
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * get favicon value
     *
     * @return string|null
     */
    public function getFavicon(): ?string
    {
        return $this->favicon;
    }

    /**
     * get theme color value
     *
     * @return string|null
     */
    public function getThemeColor(): ?string
    {
        return $this->theme_color;
    }

    /**
     * get background color value
     *
     * @return string|null
     */
    public function getBackgroundColor(): ?string
    {
        return $this->background_color;
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
     * get body class
     *
     * @return string|null
     */
    public function getBodyClass(): ?string
    {
        return $this->body_class;
    }

    /**
     * get base tag
     *
     * @return string|null
     */
    private function getBaseTag(): ?string
    {
        return '<!-- base tag -->
    <base href="'.env('APP_URL').'">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />';
    }

    /**
     * get title
     *
     * @return string|null
     */
    private function getTitle(): ?string
    {
        if(is_null($this->title) && is_null(__('base.name'))) {
            return null;
        }

        $title = null;
        switch(config('global-variable.title_mode')) {
            case 'default':
                $title = (__('base.name') ? __('base.name').' | ' : '').$this->title;
                break;
            case 'base':
                $title = $this->title;
                break;
            case 'title':
                $title = __('base.name');
                break;
        }

        return $title;
    }

    /**
     * get title tag
     *
     * @return string|null
     */
    private function getTitleTag(): ?string
    {
        return '<!-- title -->
    <title>'.($this->getTitle() ?? 'No Title mode').'</title>';
    }

    /**
     * get description tag
     *
     * @return string|null
     */
    private function getDescriptionTag(): ?string
    {
        if(is_null($this->description)) {
            return null;
        }

        return '<!-- description -->
    <meta name="description" content="'.$this->description.'" />';
    }

    /**
     * get keywords tag
     *
     * @return string|null
     */
    private function getKeywordsTag(): ?string
    {
        if(is_null($this->keywords)) {
            return null;
        }

        return '<!-- keywords -->
    <meta name="keywords" content="'.$this->keywords.'" />';
    }

    /**
     * get csrf tag
     *
     * @return string
     */
    private function getCsrfTag(): string
    {
        return '<!-- csrf -->
    <meta name="csrf-token" content="'.csrf_token().'"/>';
    }

    /**
     * get canonical link
     *
     * @return string|null
     */
    private function getCanonicalTag(): ?string
    {
        if(is_null($this->canonical)) {
            return null;
        }

        $theme .= '<!-- canonical -->
    <link rel="canonical" href="'.$this->canonical.'" />';
    }

    /**
     * get robots tag
     *
     * @return string|null
     */
    private function getRobotsTag(): ?string
    {
        if(is_null($this->robots)) {
            return null;
        }

        return '<!-- robots -->
    <meta name="robots" content="'.$this->robots.'">';
    }

    /**
     * get theme color tag
     *
     * @return string|null
     */
    private function getThemeColorTag(): ?string
    {
        if(is_null($this->theme_color)) {
            return null;
        }

        return '<!-- theme color -->
    <meta name="theme-color" content="'.$this->theme_color.'">
    <meta name="msapplication-TileColor" content="'.$this->theme_color.'">';
    }

    /**
     * get open graph tag
     *
     * @return string|null
     */
    private function getOpenGraphTag(): ?string
    {
        $theme = '<!-- open graph -->';

        if(!is_null($this->getTitle())) {
            $theme .= '
    <meta property="og:title" content="'.$this->getTitle().'">';
        }

        if(!is_null($this->description)) {
            $theme .= '
    <meta name="og.description" content="'.$this->description.'">';
        }

        if(!is_null($this->canonical)) {
            $theme .= '
    <meta property="og:url" content="'.$this->canonical.'">';
        }

        if(!is_null($this->image)) {
            $theme .= '
    <meta property="og:image" content="'.$this->image.'">';
        }

        if(!is_null($this->page_type)) {
            $theme .= '
    <meta property="og:type" content="'.$this->page_type.'">';
        }

        if(is_null(__('base.og.locale'))) {
            $theme .= '
    <meta property="og:locale" content="'.__('base.og.locale').'">';
        }

        return $theme;
    }

    /**
     * get favicon tag
     *
     * @return string|null
     */
    private function getFaviconTag(): ?string
    {
        if(is_null($this->favicon)) {
            return null;
        }

        return '<!-- favicon -->
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

    /**
     * get pwa manifest tag
     *
     * @return string
     */
    private function getPwaManifestTag(): string
    {
        $theme = '<!-- manifest -->';
        if($this->checkDevice('mobile') or $this->checkDevice('tablet')) {
            $theme .= '
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
          media="(min-device-width: 1024px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">';
        }

        $theme .= '
    <link rel="manifest" href="'.route('global.manifest.index').'">';

        return $theme;
    }

    /**
     * get links tag
     *
     * @return string|null
     */
    private function getLinksTag(): ?string
    {
        if(empty($this->links)) {
            return null;
        }

        $theme = '<!-- link -->';
        foreach($this->links as $item) {
            $theme .= '
    <link rel="'.$item['rel'].'" href="'.$item['href'].'" />';
        }

        return $theme;
    }

    /**
     * get style tag
     *
     * @return string|null
     */
    private function getStylesTag(): ?string
    {
        if(empty($this->styles)) {
            return null;
        }

        $theme = '<!-- style -->';
        foreach($this->styles as $style) {
            $media = ($style['media'] != '') ? ' media="'.$style['media'].'"' : '';
            $theme .= '
    <link rel="'.$style['rel'].'" type="text/css" href="'.$style['href'].'"'.$media.'/>';
        }

        return $theme;
    }

    /**
     * get script tag
     *
     * @return string|null
     */
    private function getScriptsTag(): ?string
    {
        if(empty($this->scripts)) {
            return null;
        }

        $theme = '<!-- script -->';
        foreach($this->scripts as $script) {
            $async = $script['async'] ? ' async' : '';
            $defer = $script['defer'] ? ' defer' : '';

            $theme .= '
    <script type="text/javascript" src="'.$script['src'].'"'.$async.$defer.'></script>';
        }

        return $theme;
    }

    /**
     * get localize data tag
     *
     * @return string
     */
    private function getLocalize(): string
    {
        return '<script type="text/javascript">let localize = '.json_encode($this->localize, JSON_UNESCAPED_UNICODE).';</script>';
    }

    /**
     * set new line
     *
     * @return string
     */
    private function setNewLine(): string
    {
        return '
    ';
    }

    /**
     * get header
     *
     * @return string
     */
    public function getHeader(): string
    {
        $theme = '';
        $theme .= $this->getBaseTag();
        $theme .= $this->setNewLine();
        $theme .= $this->getTitleTag();
        $theme .= $this->setNewLine();
        $theme .= $this->getDescriptionTag();
        $theme .= $this->setNewLine();
        $theme .= $this->getKeywordsTag();
        $theme .= $this->setNewLine();
        $theme .= $this->getCsrfTag();
        $theme .= $this->setNewLine();
        $theme .= $this->getRobotsTag();
        $theme .= $this->setNewLine();
        $theme .= $this->getThemeColorTag();
        $theme .= $this->setNewLine();
        $theme .= $this->getCanonicalTag();
        $theme .= $this->setNewLine();
        $theme .= $this->getOpenGraphTag();
        $theme .= $this->setNewLine();
        $theme .= $this->getFaviconTag();
        $theme .= $this->setNewLine();
        $theme .= $this->getLinksTag();
        $theme .= $this->setNewLine();
        $theme .= $this->getStylesTag();
        $theme .= $this->setNewLine();
        $theme .= $this->getPwaManifestTag();

        return $theme;
    }

    /**
     * get footer
     *
     * @return string
     */
    public function getFooter(): string
    {
        $theme = '';
        $theme .= $this->getLocalize();
        $theme .= $this->setNewLine();
        $theme .= $this->getScriptsTag();

        return $theme;
    }

    /**
     * check device
     *
     * @param string $state
     *
     * @return bool
     */
    public function checkDevice(string $state): bool
    {
        $detect = new Mobile_Detect;

        if($state == 'mobile') {
            $check = $detect->isMobile();
        } else if($state == 'tablet') {
            $check = $detect->isTablet();
        } else {
            try {
                $check = $detect->is($state);
            } catch(Exception $exception) {
                $check = false;
            }
        }

        return $check;
    }
}
