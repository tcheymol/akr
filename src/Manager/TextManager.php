<?php

namespace App\Manager;

use App\Entity\Text;
use App\Repository\TextRepository;
use Symfony\Contracts\Translation\TranslatorInterface;

class TextManager
{
    private TextRepository $repository;
    private TranslatorInterface $translator;

    public function __construct(TextRepository $repository, TranslatorInterface $translator)
    {
        $this->repository = $repository;
        $this->translator = $translator;
    }

    public function getByKey(string $key): ?Text
    {
        return $this->repository->findOneBy(['key' => $key]);
    }
}
