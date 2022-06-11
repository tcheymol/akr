<?php

namespace App\Controller\Admin;

use App\Entity\Spot;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SpotCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Spot::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('name');
        yield TextField::new('position');
        yield TextField::new('access');
        yield TextField::new('description');
        yield TextField::new('orientation');
        yield TextField::new('water');
        yield TextField::new('dangers');
        yield TextField::new('more');
        yield TextField::new('security');
        yield TextField::new('subtitle');
        yield ImageField::new('picture')->setBasePath('uploads/spots')
            ->setUploadDir('public/uploads/spots');
    }
}
