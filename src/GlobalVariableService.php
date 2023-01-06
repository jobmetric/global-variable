<?php

namespace JobMetric\GlobalVariable;

use JobMetric\GlobalVariable\Object\Document;
use JobMetric\GlobalVariable\Object\Config;

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
     * @return Config
     */
    public function config(): Config
    {
        return Config::getInstance();
    }
}
