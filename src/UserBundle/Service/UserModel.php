<?php

namespace UserBundle\Service;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Exception;
use GroupBundle\Service\GroupModel;
use Symfony\Component\HttpFoundation\Request;

class UserModel
{
    /** @var EntityRepository */
    private $repository;

    /** @var EntityManager */
    private $em;

    /** @var GroupModel */
    private $groupModel;

    /**
     * UserModel constructor.
     * @param EntityRepository $repository
     * @param EntityManager $em
     * @param GroupModel $groupModel
     */
    public function __construct(EntityRepository $repository, EntityManager $em, GroupModel $groupModel)
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->groupModel = $groupModel;
    }

    public function createUser(Request $request)
    {
        $user = new User();
        $user->setEmail($request->get('email'));
        $user->setFirstName($request->get('firstName'));
        $user->setLastName($request->get('lastName'));
        $user->setState($request->get('state'));

        $group = $this->groupModel->getGroup($request->get('group'));
        $user->setGroup($group);

        $this->em->persist($user);
        $this->em->flush($user);

        return $user;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return User
     * @throws Exception
     */
    public function updateUser(Request $request, $id)
    {
        $user = $this->getUser($id);

        $params = ['firstName', 'lastName', 'state', 'email'];

        foreach ($params as $param) {
            if ($request->get($param)) {
                $method = 'set' . ucfirst($param);
                $user->$method($request->get('param'));
            }
        }
        if ($request->get('group')) {
            $group = $this->groupModel->getGroup($request->get('group'));
            $user->setGroup($group);
        }

        $this->em->flush($user);
    }

    /**
     * @param $id
     * @return User
     * @throws Exception
     */
    public function getUser($id)
    {
        $user = $this->repository->find($id);
        if (!$user) {
            throw new Exception('User not found', -1);
        }

        return $user;
    }

}