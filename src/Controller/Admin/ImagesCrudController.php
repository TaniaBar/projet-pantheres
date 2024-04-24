<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Images::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('name'),
            AssociationField::new('wines')->setLabel('Vin'),
            AssociationField::new('boxes')->setLabel('Coffret'),
        ];
    }
    
}
