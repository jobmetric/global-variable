<?php

namespace JobMetric\GlobalVariable\Events\Document;

use App\Library\Document;

class Construct
{
    public string $section;

    public function __construct()
    {
        $this->section = Document::getInstance()->getSection();
    }
}
