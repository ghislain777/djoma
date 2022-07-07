<?php
namespace App\DataPersister;

use App\Entity\Role;
use App\Entity\Privilege;
use App\Repository\ActiviteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class RolePersister implements ContextAwareDataPersisterInterface
{
    private $em;
    private $activiteRepository;
    private $request;

    public function __construct(EntityManagerInterface $em, ActiviteRepository $activiteRepository, RequestStack $request)
    {
        $this->em = $em;
        $this->activiteRepository = $activiteRepository;
        $this->request = $request->getCurrentRequest();
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Role;
    }

    public function persist($data, array $context = [])
    {
        $this->em->persist($data);
        // call your persistence layer to save $data
        if ($this->request->getMethod() === 'POST') {

            $tousLesActivites = $this->activiteRepository->findAll();

            foreach ($tousLesActivites as $activite) {
                 $privilege = new Privilege();
                 $privilege->setActif(true)
                 ->setActivite($activite)
                 ->setRole($data);
                 $this->em->persist($privilege);                 
            }

        }
        $this->em->flush();
        return $data;
    }

    public function remove($data, array $context = [])
    {

        // call your persistence layer to delete $data
    }
}
