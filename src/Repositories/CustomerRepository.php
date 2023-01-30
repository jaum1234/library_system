<?php

use Library\Helpers\EntityManagerCreator;
use Library\Interfaces\Repository;
use Library\Models\Customer;

class CustomerRepository implements Repository
{
    private $repository;
    private $entityManager;

    function __construct()
    {
        $this->entityManager = EntityManagerCreator::create();
        $this->repository = $this->entityManager->getRepository(Customer::class);
    }

    public function fetchAll(): array
    {
        return $this->repository->findAll();
    }

    public function fetch(array $criteria): ?object
    {
        return $this->repository->findOneBy($criteria);
    }

    public function store(array $data): void
    {
        $customer = new Customer($data["name"]);

        $this->entityManager->persist($customer);
        $this->entityManager->flush();
    }

    public function update(array $criteria, array $data): void
    {
        $customer = $this->repository->findOneBy($criteria);

        $customer->setName($data["name"]);

        $this->entityManager->flush();
    }

    public function remove(array $criteria)
    {
        $customer = $this->repository->findOneBy($criteria);

        if ($customer === null) {
            return;
        }

        $this->entityManager->remove($customer);
        $this->entityManager->flush();
    }

}

?>