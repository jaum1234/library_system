<?php

namespace Library\Interfaces;

interface Repository
{
    public function fetchAll(): array;
    public function fetch(array $criteria): object | null;
    public function store(array $data): void;
    public function update(array $criteria, array $data): void;
    public function remove(array $criteria);
}
