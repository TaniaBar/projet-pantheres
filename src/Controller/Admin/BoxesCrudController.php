<?php

namespace App\Controller\Admin;

use App\Entity\Boxes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BoxesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Boxes::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextEditorField::new('description'),
            MoneyField::new('price')->setCurrency('EUR'),
            IntegerField::new('stock'),
            DateTimeField::new('created_at'),
        ];
    }
    
}
