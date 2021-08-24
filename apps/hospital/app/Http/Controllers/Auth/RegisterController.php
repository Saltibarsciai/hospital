<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Repository\UserRepository\UserRepositoryInterface;
use App\Services\AuthServices\RedirectService;
use App\Services\RegisterServices\PopulateAccordingTablesService;
use App\Services\RegisterServices\RegisterDatabaseService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var RedirectService
     */
    private $redirectService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        RedirectService $redirectService
    ) {
        $this->userRepository = $userRepository;
        $this->redirectService = $redirectService;
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'role' => 'required|in:1,2',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     */
    protected function create(array $data)
    {
        return $this->userRepository->store($data);
    }

    protected function registered(Request $request, $user): ?\Illuminate\Http\RedirectResponse
    {
        return $this->redirectService->toDashboard($user);
    }
}
