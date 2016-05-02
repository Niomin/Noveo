<?php

namespace Components;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;

abstract class Model
{
    /** @var EntityRepository */
    protected $repository;

    /** @var EntityManager */
    protected $em;

    /**
     * @param EntityRepository $repository
     * @param EntityManager $em
     */
    public function __construct(EntityRepository $repository, EntityManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    abstract protected function createEntity(Request $request);

    abstract protected function throwNotFound();

    abstract protected function updateEntity(Request $request, $entity);

    public function create(Request $request)
    {
        $entity = $this->createEntity($request);

        $this->em->persist($entity);
        $this->em->flush($entity);

        return $entity;
    }

    public function update(Request $request, $id)
    {
        $entity = $this->get($id);

        $this->updateEntity($request, $entity);

        $this->em->persist($entity);
        $this->em->flush($entity);

        return $entity;
    }

    /**
     * @param $id
     * @return object
     */
    public function get($id)
    {
        $group = $this->repository->find($id);

        if (!$group) {
            $this->throwNotFound();
        }

        return $group;
    }
}