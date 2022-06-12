<?php

namespace App\Controller\Admin;

use App\Entity\Spot;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
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
        yield TextField::new('access')->hideOnIndex();
        yield TextField::new('description')->hideOnIndex();
        yield TextField::new('orientation')->hideOnIndex();
        yield TextField::new('water')->hideOnIndex();
        yield TextField::new('dangers')->hideOnIndex();
        yield TextField::new('more')->hideOnIndex();
        yield TextField::new('security')->hideOnIndex();
        yield TextField::new('subtitle')->hideOnIndex();
        yield IntegerField::new('windguruId');
        yield ImageField::new('picture')->setBasePath('uploads')
            ->setUploadDir('public/uploads')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
    }
}
