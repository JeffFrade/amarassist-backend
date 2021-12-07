<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Repositories\Models\Contact;

class ContactRepository extends AbstractRepository
{
    /**
     * ContactRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Contact();
    }

    /**
     * @param string $search
     * @return mixed
     */
    public function index(string $search = '')
    {
        return $this->model->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orWhere('phone', 'LIKE', '%' . $search . '%')
            ->get(['id', 'name', 'email', 'phone']);
    }
}
