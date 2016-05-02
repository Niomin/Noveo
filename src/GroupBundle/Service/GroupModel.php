<?php

namespace GroupBundle\Service;

use AppBundle\Entity\Group;
use Components\Model;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class GroupModel extends Model
{
    public function createEntity(Request $request)
    {
        $group = new Group();

        $group->setName($request->get('name'));

        return $group;
    }

    /**
     * @param Request $request
     * @param Group $group
     */
    public function updateEntity(Request $request, $group)
    {
        $group->setName($request->get('name'));
    }

    public function throwNotFound()
    {
        throw new Exception('Group not found!', 2);
    }

    /**
     * @param $id
     * @return Group
     */
    public function get($id)
    {
        return parent::get($id);
    }
}