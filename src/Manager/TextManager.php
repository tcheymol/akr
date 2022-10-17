<?php

namespace App\Manager;

use App\Entity\Text;
use App\Repository\TextRepository;

class TextManager
{
    public function __construct(private readonly TextRepository $repository)
    {
    }

    public function getByKey(string $key): ?Text
    {
        return $this->repository->findOneBy(['key' => $key]);
    }
}
