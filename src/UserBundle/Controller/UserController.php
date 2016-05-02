<?php

namespace UserBundle\Controller;

use Components\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    protected function getModel()
    {
        return $this->get('user.model');
    }

    /**
     * @Route("/users/", methods={"GET"})
     * @return JsonResponse
     */
    public function listAction()
    {
        return parent::listAction();
    }

    /**
     * @Route("/users/{id}", methods={"GET"}, requirements={"id"="\d+"})
     * @return JsonResponse
     */
    public function viewAction($id)
    {
        return parent::viewAction($id);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/users/create", methods={"GET"})
     */
    public function createAction(Request $request)
    {
        return parent::createAction($request);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @Route("/users/{id}/modify", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function modifyAction(Request $request, $id)
    {
        return parent::modifyAction($request, $id);
    }
}
