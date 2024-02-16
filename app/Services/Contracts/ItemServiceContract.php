<?php

namespace App\Services\Contracts;

interface ItemServiceContract
{
    public function index(array $fields);

    public function indexApiLegacy(array $fields);
}
