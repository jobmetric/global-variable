<?php

namespace JobMetric\GlobalVariable\Object;

class Document
{
    private static Document $instance;

    private string $title = '';
    private string $description = '';
    private string $keywords = '';
    private ?string $canonical = null;
    private array $links = [];
    private array $styles = [];
    private array $scripts = [];

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
     * get style page
     *
     * @return array
     */
    public function getStyles(): array
    {
        return $this->styles;
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
     * get script page
     *
     * @return array
     */
    public function getScripts(): array
    {
        return $this->scripts;
    }
}
