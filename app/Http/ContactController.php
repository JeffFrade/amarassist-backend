<?php

namespace App\Http;

use App\Exceptions\ContactNotFoundException;
use App\Http\Controllers\Controller;
use App\Services\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    /**
     * @var Contact
     */
    private $contact;

    /**
     * ContactController constructor.
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try {
            return $this->successJson([
                'contacts' => $this->contact->index($request->all())
            ]);
        } catch (ContactNotFoundException $e) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = $e->getMessage();
        }

        return $this->errorJson($message, $e, $status);
    }
}
