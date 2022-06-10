<?php

namespace App\Manager;

use App\Repository\TextRepository;

class TextManager
{
    private TextRepository $repository;

    public function __construct(TextRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getContent(string $key): ?string {
        $text = $this->repository->findOneBy(['key' => $key]);

        return $text?->getContent();
    }
}