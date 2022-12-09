<?php

namespace JobMetric\GlobalVariable\Object;

class Document
{
    private static Document $instance;

    private string $title = '';
    private string $description = '';
    private ?string $canonical = null;

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
}
