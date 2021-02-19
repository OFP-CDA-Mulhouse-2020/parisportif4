<?php


namespace App\Controller\Admin;


use App\Entity\DocumentUser;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\MimeTypes;

class DocumentUserCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return DocumentUser::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $checkFile = Action::new('checkFile', 'Check File', 'far fa-check-square')
            ->linkToCrudAction('checkFile');

        return $actions
            ->add(Crud::PAGE_INDEX, $checkFile);
    }

    public function checkFile(
        AdminContext $context
    ): Response {

        $fileName = $context->getEntity()->getInstance()->getBrochureFilename();
        $file = './uploads/brochures/' . $fileName;

        $mimeTypes = new MimeTypes();
        $mimeType = $mimeTypes->guessMimeType('./uploads/brochures/' . $fileName);

        $response = new Response();
        $response->headers->set('content-type', $mimeType);
        $response->setContent(file_get_contents($file));

        return $response;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('brochureFilename')->setLabel('File Name'),
            BooleanField::new('is_valid')->setLabel('valid'),

        ];
    }


}