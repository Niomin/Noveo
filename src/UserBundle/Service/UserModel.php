<?php

namespace UserBundle\Service;

use AppBundle\Entity\User;
use Components\Model;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Exception;
use GroupBundle\Service\GroupModel;
use Symfony\Component\HttpFoundation\Request;

class UserModel extends Model
{
    /** @var GroupModel */
    private $groupModel;

    /**
     * @param EntityRepository $repository
     * @param EntityManager $em
     * @param GroupModel $groupModel
     */
    public function __construct(EntityRepository $repository, EntityManager $em, GroupModel $groupModel)
    {
        parent::__construct($repository, $em);
        $this->groupModel = $groupModel;
    }

    public function createEntity(Request $request)
    {
        $user = new User();
        $user->setEmail($request->get('email'));
        $user->setFirstName($request->get('firstName'));
        $user->setLastName($request->get('lastName'));
        $user->setState($request->get('state'));

        $group = $this->groupModel->get($request->get('group'));
        $user->setGroup($group);

        return $user;
    }

    /**
     * @param Request $request
     * @param User $user
     * @return User
     */
    public function updateEntity(Request $request, $user)
    {
        $params = ['firstName', 'lastName', 'state', 'email'];

        foreach ($params as $param) {
            if ($request->get($param)) {
                $method = 'set' . ucfirst($param);
                $user->$method($request->get('param'));
            }
        }
        if ($request->get('group')) {
            $group = $this->groupModel->get($request->get('group'));
            $user->setGroup($group);
        }

        $this->em->flush($user);
    }

    /**
     * @param $id
     * @return User
     * @throws Exception
     */
    public function get($id)
    {
        return parent::get($id);
    }

    protected function throwNotFound()
    {
        throw new Exception('User not found!');
    }


}