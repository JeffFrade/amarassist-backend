<?php

namespace App\Services;

use App\Exceptions\ContactNotFoundException;
use App\Repositories\ContactRepository;

class Contact
{
    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * Contact constructor.
     */
    public function __construct()
    {
        $this->contactRepository = new ContactRepository();
    }

    /**
     * @param array $params
     * @return mixed
     * @throws ContactNotFoundException
     */
    public function index(array $params)
    {
        $contacts = $this->contactRepository->index($params['search'] ?? '');

        if (count($contacts) <= 0) {
            throw new ContactNotFoundException();
        }

        return $contacts;
    }
}
