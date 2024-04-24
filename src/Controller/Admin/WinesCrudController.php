<?php

namespace App\Controller\Admin;

use App\Entity\Wines;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class WinesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Wines::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('name'),
            TextEditorField::new('description'),
            MoneyField::new('price')->setCurrency('EUR'),
            IntegerField::new('stock'),
            TextField::new('origin'),
            TextField::new('variety'),
            TextField::new('accords'),
            AssociationField::new('categories')->setLabel('Category'),
            AssociationField::new('suppliers')->setLabel('Supplier'),
            DateTimeField::new('created_at'),

            

        ];
    }
    
}
