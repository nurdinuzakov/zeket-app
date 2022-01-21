<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var User $user */
    protected $user;

    /** @var AccessToken */
    protected $accessToken;

    /**@var Contact */
    protected $contact;



    /**
     * AuthController constructor.
     * @param User $user
     * @param AccessToken $accessToken
     * @param Contact $contact
     */

    public function __construct(User $user, AccessToken $accessToken, Contact $contact)
    {
        $this->user = $user;
        $this->accessToken = $accessToken;
        $this->contact = $contact;
    }

    public function sendSuccess($message, $data): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public function sendError($message, $code): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => false,
            'code' => $code,
            'error_message' => $message,
        ],$code);
    }
}
