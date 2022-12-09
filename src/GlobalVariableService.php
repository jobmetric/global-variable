<?php

namespace JobMetric\GlobalVariable;

use JobMetric\GlobalVariable\Object\Document;

class GlobalVariableService
{
    /**
     * get instance object
     *
     * @return Document
     */
    public function document(): Document
    {
        return Document::getInstance();
    }
}
