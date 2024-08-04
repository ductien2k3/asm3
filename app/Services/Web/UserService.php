<?php
namespace App\Services\Web;

use App\Repositories\Contracts\UserRepository;
use App\Services\Contracts\UserServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserService implements UserServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        $orderBy['updated_at'] = 'desc';
        $filter = [];
        $users = $this->userRepository->paginateByFilters(
            $filter,
            PAGINATE_MAX_RECORD,
            ['role'],
            $orderBy
        )->withQueryString();

        return $users;
    }
    public function create($data)
    {
    }
    public function store($data)
    {
        $imagePath = null;
        if ($data->hasFile('image')) {
            $image = $data->file('image');
            $imagePath = $image->store(PATH_IMAGE_USERS, PATH_IMAGE);
        }
        $params = [
            'role_id' => 1,
            'user_name' => $data->user_name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'full_name' => $data->full_name,
            'gender' => $data->gender,
            'phone' => $data->phone,
            'image' => $imagePath,
            'address' => $data->address,
            'description' => $data->description,
        ];
        $user = $this->userRepository->create($params);

        return $user;
    }

    public function edit($id)
    {
        return $this->userRepository->find($id);
    }
    public function update($data, $id)
    {
        $user = $this->userRepository->find($id);
        $password = $user->password;

        $imagePath = $user->image;
        $newImagePath = $imagePath;
        if ($data->hasFile('image')) {
            $image = $data->file('image');
            $newImagePath = $image->store(PATH_IMAGE_USERS, PATH_IMAGE);
            if ($imagePath && Storage::exists(PATH_IMAGE . '/' . $imagePath)) {
                Storage::delete(PATH_IMAGE . '/' . $imagePath);
            }
        }
        if ($data->filled('password')) {
            $password = bcrypt($data->password);
        }

        $params = [
            'role_id' => $data->role_id,
            'user_name' => $data->user_name,
            'email' => $data->email,
            'password' => $password,
            'full_name' => $data->full_name,
            'gender' => $data->gender,
            'phone' => $data->phone,
            'image' => $newImagePath,
            'address' => $data->address,
            'description' => $data->description,
        ];

        $user = $this->userRepository->update($params, $id);

        return $user;
    }
    public function getDetailCategory($id)
    {
        return $this->userRepository->find($id);
    }

    public function register($data)
    {
        $params = [
            'role_id' => 1,
            'user_name' => $data->user_name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'full_name' => $data->full_name,
        ];
        $user = $this->userRepository->create($params);

        return $user;
    }

    public function login($data)
    {
        $params = [
            'email' => $data->email,
            'password' => $data->password,
        ];
        if (Auth::attempt($params)) {
            return Auth::user();
        }
        return null;
    }
}
