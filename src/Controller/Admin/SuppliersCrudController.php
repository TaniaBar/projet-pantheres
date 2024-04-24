<?php

namespace App\Controller\Admin;

use App\Entity\Suppliers;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SuppliersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Suppliers::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
        
            TextField::new('name'),
            TextField::new('region'),
            TextEditorField::new('description'),
            TextField::new('img'),
        ];
    }
    
}
