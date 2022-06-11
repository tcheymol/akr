<?php

namespace App\Manager;

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

    public function getContent(string $key): ?string {
        $text = $this->repository->findOneBy(['key' => $key]);

        return $text?->getContent() ?? $this->translator->trans('section_in_progress');
    }
}