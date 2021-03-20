<?php


namespace App\Traits\Api\Request;


trait RequestSanitizer
{
    public function getSanitized()
    {
        return $this->validated();
    }
}
