<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserIdRequest;
use App\Services\ProfilePageService;
use Psr\Container\NotFoundExceptionInterface;

class ProfileController extends Controller
{
    public function __construct(protected ProfilePageService $profilePageService)
    {
    }

    public function profilePage($token)
    {
        try {
            $user = $this->profilePageService->getByToken($token);
            return view('profile', [
                'user' => $user,
            ]);
        } catch (NotFoundExceptionInterface $e) {
            abort(404, $e->getMessage());
        }
    }

    public function invalidate(UserIdRequest $userIdRequest)
    {
        try {
            $this->profilePageService->invalidate($userIdRequest->validated('user_id'));
            return redirect()->route('main');
        } catch (NotFoundExceptionInterface $exception) {
            abort(404, $exception->getMessage());
        }
    }

    public function renew(UserIdRequest $userIdRequest)
    {
        try {
            $user = $this->profilePageService->renew($userIdRequest->validated('user_id'));
            $url = route('profile', ['token' => $user->token]);
            return redirect($url);
        } catch (NotFoundExceptionInterface $exception) {
            abort(404, $exception->getMessage());
        }
    }
}
