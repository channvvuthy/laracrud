<?php

namespace App\Http\Controllers\api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends ApiController
{

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
        $this->form = [
            array('field' => 'name', 'title' => 'Name', 'type' => 'text', 'required' => true, 'validated' => 'required'),
            array('field' => 'email', 'title' => 'Email', 'type' => 'text', 'required' => true, 'validated' => 'required|email|unique:users'),
            array('field' => 'password', 'title' => 'Password', 'type' => 'password', 'required' => true, 'validated' => 'required'),
        ];
    }


    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     tags={"Auth"},
     *     description="Register user",
     *     @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="My Name"),
     *              @OA\Property(property="email", type="string", example="email@example.com"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *          )
     *      ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                      "name":"My Name",
     *                     "email":"email@example.com",
     *                     "password":"123456"
     *                }
     *             )
     *         )
     *      )
     *     )
     */
    public function postAdd(Request $request)
    {
        return parent::postAdd($request);
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken("access_token")->plainTextToken;
        $response = [
            'user' => $user,
            'access_token' => $token
        ];
        return response()->json($response);
    }
}
