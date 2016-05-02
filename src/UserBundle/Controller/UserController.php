<?php

namespace UserBundle\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/users/", methods={"GET"})
     */
    public function listAction()
    {
        $users = $this->get('doctrine')->getRepository('AppBundle:User')->findAll();
        return new JsonResponse($users);
    }

    /**
     * @Route("/users/{id}", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function viewAction($id)
    {
        try {

            $user = $this->get('user.model')->get($id);

        } catch (Exception $e) {

            return new JsonResponse(['code' => $e->getCode(), 'message' => $e->getMessage()], 500);

        }

        return new JsonResponse($user);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/users/create", methods={"GET"})
     */
    public function createAction(Request $request)
    {
        try {

            $user = $this->get('user.model')->create($request);

        } catch (Exception $e) {

            return new JsonResponse(['code' => $e->getCode(), 'message' => $e->getMessage()], 500);

        }

        return new JsonResponse($user);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/users/{id}/modify", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function modifyAction(Request $request, $id)
    {
        try {

            $user = $this->get('user.model')->update($request, $id);

        } catch (Exception $e) {

            return new JsonResponse(['code' => $e->getCode(), 'message' => $e->getMessage()], 500);

        }

        return $user;
    }
}
