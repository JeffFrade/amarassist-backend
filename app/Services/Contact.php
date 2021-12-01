<?php

namespace App\Services;

use App\Exceptions\ContactNotFoundException;
use App\Helpers\StringHelper;
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

    /**
     * @param array $params
     * @return mixed
     */
    public function store(array $params)
    {
        $params = $this->formatParams($params);
        return $this->contactRepository->create($params);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ContactNotFoundException
     */
    public function show(int $id)
    {
        $contact = $this->contactRepository->findFirst('id', $id);

        if (empty($contact)) {
            throw new ContactNotFoundException();
        }

        return $contact;
    }

    /**
     * @param array $params
     * @return array
     */
    private function formatParams(array $params)
    {
        $params['phone'] = StringHelper::formatNumbers($params['phone']);
        $params['zip'] = StringHelper::formatNumbers($params['zip']);

        return $params;
    }
}
