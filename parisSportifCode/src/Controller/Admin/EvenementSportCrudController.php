<?php

namespace App\Controller\Admin;

use App\Entity\EvenementSport;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EvenementSportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EvenementSport::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
