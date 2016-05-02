<?php

namespace GroupBundle\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends Controller
{
    /**
     * @Route("/groups/", methods={"GET"})
     */
    public function listAction()
    {
        $groups = $this->get('doctrine')->getRepository('AppBundle:Group')->findAll();
        return new JsonResponse($groups);
    }

    /**
     * @Route("/groups/{id}", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function viewAction($id)
    {
        try {

            $group = $this->get('group.model')->getGroup($id);

        } catch (Exception $e) {

            return new JsonResponse(['code' => $e->getCode(), 'message' => $e->getMessage()], 500);

        }

        return new JsonResponse($group);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/groups/create", methods={"GET"})
     */
    public function createAction(Request $request)
    {
        try {

            $group = $this->get('group.model')->createGroup($request);

        } catch (Exception $e) {

            return new JsonResponse(['code' => $e->getCode(), 'message' => $e->getMessage()], 500);

        }

        return new JsonResponse($group);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/groups/{id}/modify", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function modifyAction(Request $request, $id)
    {
        try {

            $group = $this->get('group.model')->updateGroup($request, $id);

        } catch (Exception $e) {

            return new JsonResponse(['code' => $e->getCode(), 'message' => $e->getMessage()], 500);

        }

        return $group;
    }
}