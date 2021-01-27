<?php
namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DataBaseManager extends AbstractController
{
    public function insertDataIntoBase(object $object)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist ($object);
        $entityManager->flush ();
    }
}