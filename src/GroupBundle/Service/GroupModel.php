<?php

namespace GroupBundle\Service;

use AppBundle\Entity\Group;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class GroupModel
{
    /** @var EntityRepository */
    private $repository;

    /** @var EntityManager */
    private $em;

    /**
     * @param EntityRepository $repository
     * @param EntityManager $em
     */
    public function __construct(EntityRepository $repository, EntityManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    public function createGroup(Request $request)
    {
        $group = new Group();

        $group->setName($request->get('name'));

        $this->em->persist($group);
        $this->em->flush($group);

        return $group;
    }

    public function updateGroup(Request $request, $id)
    {
        $group = $this->getGroup($id);

        $group->setName($request->get('name'));

        $this->em->persist($group);
        $this->em->flush($group);

        return $group;
    }

    /**
     * @param $id
     * @return Group
     * @throws Exception
     */
    public function getGroup($id)
    {
        $group = $this->repository->find($id);

        if (!$group) {
            throw new Exception('Group not found!', 2);
        }

        return $group;
    }
}