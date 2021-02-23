<?php

namespace App\Controller\Admin;

use App\Entity\Bet;
use App\Entity\Competition;
use App\Entity\DocumentUser;
use App\Entity\Equipe;
use App\Entity\EvenementSport;
use App\Entity\Joueurs;
use App\Entity\Sport;
use App\Entity\User;
use App\Repository\BetRepository;
use App\Repository\EvenementSportRepository;
use App\Repository\UserRepository;
use App\Repository\WalletRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    private UserRepository $userRepository;
    private BetRepository $betRepository;
    private EvenementSportRepository $evenementSportRepository;
    private WalletRepository  $walletRepository;

    public function __construct(UserRepository $userRepository,
                                BetRepository $betRepository,
                                EvenementSportRepository $evenementSportRepository,
                                WalletRepository $walletRepository)
    {
        $this->userRepository =$userRepository;
        $this->betRepository = $betRepository;
        $this->evenementSportRepository = $evenementSportRepository;
        $this->walletRepository = $walletRepository;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $listOfUser = $this->userRepository->findBy(['userValidation' => true]);
        $listOfBet = $this->betRepository->findAll();
        $listOfEvent = $this->evenementSportRepository->findAll();
        //$wallet = $this->walletRepository->findAll();

        $adminUrlGenerator  = $this->get(AdminUrlGenerator::class);
        $userUrl = $adminUrlGenerator->setController(UserCrudController::class)->generateUrl();
        $betUrl = $adminUrlGenerator->setController(BetCrudController::class)->generateUrl();
        $eventUrl = $adminUrlGenerator->setController(EvenementSportCrudController::class)->generateUrl();

        return $this->render('bundles/EasyAdminBundle/welcome.html.twig',[
            'countAllUser' => count($listOfUser) ,
            'countAllBet' => count($listOfBet) ,
            'countAllEvent' => count($listOfEvent) ,
            'userUrl' => $userUrl,
            'betUrl' => $betUrl,
            'eventUrl' => $eventUrl,
        ]);


    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Paris Sport');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::subMenu('Users', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('User', 'fas fa-list', User::class),
            MenuItem::linkToCrud('Document User', 'fas fa-list', DocumentUser::class)
        ]);
        yield MenuItem::linkToCrud('Bet','fas fa-list',Bet::class);
        yield MenuItem::linkToCrud('Sport','fas fa-list',Sport::class);
        yield MenuItem::linkToCrud('Teams','fas fa-list',Equipe::class);
        yield MenuItem::linkToCrud('Players','fas fa-list',Joueurs::class);
        yield MenuItem::linkToCrud('Event','fas fa-list',EvenementSport::class);
        yield MenuItem::linkToCrud('Competition','fas fa-list',Competition::class);
        yield MenuItem::linktoRoute('Payment','fas fa-list','payment_admin');

    }
}
