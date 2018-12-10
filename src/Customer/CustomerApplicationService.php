<?php

declare(strict_types=1);

namespace LoanApplication;

class CustomerApplicationService
{

    /**
     * @var RepositoryInterface
     */
    private $repository;
    /**
     * @var CustomerLocatorInterface
     */
    private $customerLocator;

    public function __construct(
        RepositoryInterface $repository,
        CustomerLocatorInterface $customerLocator
    )
    {

        $this->repository = $repository;
        $this->customerLocator = $customerLocator;
    }

}