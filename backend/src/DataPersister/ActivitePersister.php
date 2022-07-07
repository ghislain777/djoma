<?php
namespace App\DataPersister;

use App\Entity\Activite;
use App\Entity\Privilege;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class ActivitePersister implements ContextAwareDataPersisterInterface
{
    private $em;
    private $roleRepository;
    private $request;

    public function __construct(EntityManagerInterface $em, RoleRepository $roleRepository, RequestStack $request)
    {
        $this->em = $em;
        $this->roleRepository = $roleRepository;
        $this->request = $request->getCurrentRequest();
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Activite;
    }

    public function persist($data, array $context = [])
    {
        $this->em->persist($data);
        // call your persistence layer to save $data
        if ($this->request->getMethod() === 'POST') {

            $tousLesRoles = $this->roleRepository->findAll();

            foreach ($tousLesRoles as $role) {
                 $privilege = new Privilege();
                 $privilege->setActif(true)
                 ->setActivite($data)
                 ->setRole($role);
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
