<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

 
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('name'), 
            TextField::new('reference'),     
            TextField::new('description'),
            NumberField::new('price'),     
            IntegerField::new('stock'), 
            TextField::new('etat'),
            TextField::new('picture'),   

            AssociationField::new('sousCategorie'),
        ];
    }

}
