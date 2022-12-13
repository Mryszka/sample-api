<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Exceptions\NoUserException;
use App\Repositories\CacheRepository;

class UserController extends Controller{
    
    protected UserRepository $userRepository;
    protected CacheRepository $cacheRepository;

    public function __construct(UserRepository $userRepository, CacheRepository $cacheRepository) 
    {
        $this->userRepository = $userRepository;
        $this->cacheRepository = $cacheRepository;
    }
    
    public function index(Request $request): JsonResponse
    {
        $users = $this->userRepository->getAllUsers();
        $resource = new UserCollection($users);
        
        return response()->json($resource->toArray($request), 200);
    }
    
    public function getOne(Request $request, int $id): JsonResponse
    {
        try {
            $user = $this->cacheRepository->getCachedUser($id);
            if($user === NULL)
            {
                $user = $this->userRepository->getUserById($id);
                $this->cacheRepository->setUserToCache($user);
            }
            
            $resource = new UserResource($user);

            return response()->json($resource->toArray($request));
        } catch (NoUserException $e)
        {
            return response()->json(
                ['message' => 'There is no user with id: '.$id], 
                404
            );
        }
    }
    
    public function store(StoreUser $request): JsonResponse
    {
        $data = $request->validated();
        $this->userRepository->createUser($data);
        
        return response()->json(['message' => 'User sucessfully created'], 200);
    }
    
    public function update(UpdateUser $request, int $id): JsonResponse
    {
        try {
            $this->userRepository->updateUser($id, $request->all());
            $this->cacheRepository->delUserFromCache($id);
            
            return response()->json(
                ['message' => 'Successfully updated user with id: '.$id], 
                200
            );
        } catch (NoUserException $e){
            
            return response()->json(
                ['message' => 'There is no user with id: '.$id], 
                404
            );
        }
    }
    
    public function delete(int $id):JsonResponse
    {
        try {
            $this->userRepository->deleteUser($id);
            $this->cacheRepository->delUserFromCache($id);
            
            return response()->json(
                ['message' => 'Successfully deleted user with id: '.$id],
                200
            );
        } catch (NoUserException $e){
            return response()->json(
                ['message' => 'There is no user with id: '.$id], 
                404
            );
        }
    }
}
