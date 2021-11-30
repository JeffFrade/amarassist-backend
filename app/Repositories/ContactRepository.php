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
}
