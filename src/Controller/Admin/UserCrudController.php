<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
                ->setFormTypeOption('mapped', false),
            ImageField::new('imageName')
                ->setBasePath('/visuals/users')
                ->onlyOnIndex(),
            TextField::new('imageFile', 'Visuel principal de l\'utilisateur')
                ->setFormType(VichImageType::class)
                ->hideOnIndex(),
            TextField::new('email'),
            // BooleanField::new('isVerified'),
        ];
    }

}
