<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

use App\Entity\Panier;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PanierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Panier::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('idUser'),
            IntegerField::new('idProduit'),
            /*IntegerField::new('quantite'),*/
        ];
    }
    
}
