<?php

namespace JobMetric\GlobalVariable\Object;

use Exception;
use JobMetric\GlobalVariable\Events\Document\AddPlugin;
use Mobile_Detect;

class Document
{
    private static Document $instance;

    private ?string $section = null;
    private ?string $title = null;
    private ?string $description = null;
    private ?string $keywords = null;
    private ?string $canonical = null;
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
     * @return string|null
     */
    public function getCanonical(): ?string
    {
        return $this->canonical;
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
