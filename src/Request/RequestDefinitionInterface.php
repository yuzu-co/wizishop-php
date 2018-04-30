<?php

namespace Yuzu\Wizishop\Request;

interface RequestDefinitionInterface
{
    public function getMethod();

    public function getUrl();

    public function addRequiredOption($key, $value);
}