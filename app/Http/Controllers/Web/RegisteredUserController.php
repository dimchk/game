<?php

namespace App\Http\Controllers\Web;

use App\DTO\RegistrationDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Services\ProfilePageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    public function __construct(protected ProfilePageService $profilePageService)
    {
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegistrationRequest $request): RedirectResponse
    {
        try {
            $user = $this->profilePageService->create(RegistrationDto::fromRequest($request));
            $url = route('profile', ['token' => $user->token]);
            return redirect($url);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }
}
