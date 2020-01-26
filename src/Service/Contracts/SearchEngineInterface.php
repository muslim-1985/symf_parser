<?php


namespace App\Service\Contracts;


interface SearchEngineInterface
{
    public function index (array  $params);

    public function delete (array  $params);

    public function get (array  $params);

    public function search(array $params);
}