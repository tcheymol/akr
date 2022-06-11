<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email'),
            TextField::new('password')->onlyOnForms(),
            ArrayField::new('roles'),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, mixed $user): void
    {
        if ($password = $user->getPassword()) {
            $user->setPassword($this->hasher->hashPassword($user, $password));
        }

        parent::persistEntity($entityManager, $user);
    }

    public function updateEntity(EntityManagerInterface $entityManager, mixed $user): void
    {
        if ($password = $user->getPassword()) {
            $user->setPassword($this->hasher->hashPassword($user, $password));
        }

        parent::updateEntity($entityManager, $user);
    }
}
