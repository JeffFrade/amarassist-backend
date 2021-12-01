<?php

namespace App\Exceptions;

use App\Core\Support\BaseException;
use App\Interfaces\ContactExceptionInterface;

class ContactNotFoundException extends BaseException implements ContactExceptionInterface
{
    /**
     * ContactNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct("Não Há Contato(s) Com o(s) Critério(s) Desejado(s)", 0, null);
    }
}
