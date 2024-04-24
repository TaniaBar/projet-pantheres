<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('firstname'),
            TextField::new('lastname'),
            EmailField::new('email'),
            ArrayField::new('roles'),
            TextField::new('plainPassword')
                ->setLabel('Password')
                ->setRequired(true) 
                ->setHelp('Entrez un mot de passe sécurisé')  
                ->setFormTypeOption('mapped', false)
        ];
    }

}
