<?php

namespace GroupBundle\Controller;

use Components\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends Controller
{
    protected function getModel()
    {
        return $this->get('group.model');
    }

    /**
     * @Route("/groups/", methods={"GET"})
     */
    public function listAction()
    {
        return parent::listAction();
    }

    /**
     * @Route("/groups/{id}", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/groups/create", methods={"GET"})
     */
    public function createAction(Request $request)
    {
        return parent::createAction($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/groups/{id}/modify", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function modifyAction(Request $request, $id)
    {
        return parent::modifyAction($request, $id);
    }
}