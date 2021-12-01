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
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        $data = $this->formatData($data);
        return $this->contactRepository->create($data);
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
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ContactNotFoundException
     */
    public function update(int $id, array $data)
    {
        $this->show($id);
        $data = $this->formatData($data);
        $this->contactRepository->update($data, $id);

        return $this->show($id);
    }

    /**
     * @param array $data
     * @return array
     */
    private function formatData(array $data)
    {
        $data['phone'] = StringHelper::formatNumbers($data['phone']);
        $data['zip'] = StringHelper::formatNumbers($data['zip']);

        return $data;
    }
}
