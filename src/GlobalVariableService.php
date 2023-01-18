<?php

namespace JobMetric\GlobalVariable;

use JobMetric\GlobalVariable\Object\Document;
use JobMetric\GlobalVariable\Object\Configuration;

class GlobalVariableService
{
    /**
     * get instance document object
     *
     * @return Document
     */
    public function document(): Document
    {
        return Document::getInstance();
    }

    /**
     * get instance config object
     *
     * @return Configuration
     */
    public function configuration(): Configuration
    {
        return Configuration::getInstance();
    }
}
