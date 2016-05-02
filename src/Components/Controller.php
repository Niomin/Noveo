<?php

namespace Components;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Exception;
use Symfony\Component\HttpFoundation\Request;

abstract class Controller extends BaseController
{
    /**
     * @return Model
     */
    abstract protected function getModel();

    public function listAction()
    {
        $users = $this->getModel()->findAll();
        return new JsonResponse($users);
    }

    public function viewAction($id)
    {
        try {

            $user = $this->getModel()->get($id);

        } catch (Exception $e) {

            return new JsonResponse(['code' => $e->getCode(), 'message' => $e->getMessage()], 500);

        }

        return new JsonResponse($user);
    }

    public function createAction(Request $request)
    {
        try {

            $user = $this->getModel()->create($request);

        } catch (Exception $e) {

            return new JsonResponse(['code' => $e->getCode(), 'message' => $e->getMessage()], 500);

        }

        return new JsonResponse($user);
    }

    public function modifyAction(Request $request, $id)
    {
        try {

            $user = $this->getModel()->update($request, $id);

        } catch (Exception $e) {

            return new JsonResponse(['code' => $e->getCode(), 'message' => $e->getMessage()], 500);

        }

        return $user;
    }
}