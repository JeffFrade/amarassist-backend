<?php

namespace App\Http;

use App\Exceptions\ContactNotFoundException;
use App\Http\Controllers\Controller;
use App\Services\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

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

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        try {
            return $this->successJson([
                'contact' => $this->contact->store($this->toValidate($request))
            ]);
        } catch (\InvalidArgumentException $e) {
            $httpError = Response::HTTP_BAD_REQUEST;
            $message = $e->getMessage();
        }

        return $this->errorJson($message, $e, $httpError);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        try {
            return $this->successJson([
                'contact' => $this->contact->show($id)
            ]);
        } catch (ContactNotFoundException $e) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = $e->getMessage();
        }

        return $this->errorJson($message, $e, $status);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $id)
    {
        try {
            return $this->successJson([
                'contact' => $this->contact->update($id, $this->toValidate($request))
            ]);
        } catch (ContactNotFoundException | \InvalidArgumentException $e) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = $e->getMessage();
        }

        return $this->errorJson($message, $e, $status);
    }

    /**
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    private function toValidate(Request $request)
    {
        $toValidateArr = [
            'name' => 'required|max:70',
            'email' => 'required|email|max:100',
            'phone' => 'required|min:14|max:15',
            'zip' => 'required|size:9',
            'city' => 'required|max:70',
            'state' => 'required|size:2',
            'neighborhood' => 'required|max:70',
            'address' => 'required|max:170',
            'number' => 'nullable|max:15',
            'complement' => 'nullable|max:15'
        ];

        $validation = $this->validate($request, $toValidateArr);

        if (empty($validation) === true) {
            throw new \InvalidArgumentException('Parâmetros Vazios');
        }

        if (empty($validation['error']) === false) {
            throw new \InvalidArgumentException($validation['error']);
        }

        return $validation;
    }
}
