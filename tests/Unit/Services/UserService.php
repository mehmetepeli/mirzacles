<?php

namespace User\Services;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    /**
     * The model instance.
     *
     * @var App\User
     */
    protected $model;

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Constructor to bind model to a repository.
     *
     * @param \App\User                $model
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(User $model, Request $request){
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * Define the validation rules for the model.
     *
     * @param  int $id
     * @return array
     */
    public function rules($id = null){
        return [
            /**
             * Rule syntax:
             *  'column' => 'validation1|validation2'
             *
             *  or
             *
             *  'column' => ['validation1', function1()]
             */

            'prefixname' => ['string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'suffixname' => ['string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'text', 'min:8', 'confirmed'],
            'photo' => ['text', 'text'],
            'type' => ['string', 'max:255'],
        ];
    }

    /**
     * Retrieve all resources and paginate.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function list(){
        $users = User::orderBy('created_at', 'DESC')->get();
        return $users;
    }

    /**
     * Create model resource.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $attributes){
        $user = User::create($attributes);
        return $user;
    }

    /**
     * Retrieve model resource details.
     * Abort to 404 if not found.
     *
     * @param  integer $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id) {
        $user = User::findOrFail($id);
        return $user;
    }

    /**
     * Update model resource.
     *
     * @param  integer $id
     * @param  array   $attributes
     * @return boolean
     */
    public function update(int $id, array $attributes): bool{
        $user = User::findOrFail($id);
        $update = $user->update($attributes);
        return $update;
    }

    /**
     * Soft delete model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function destroy($id){
        $user = User::findOrFail($id);
        $delete = $user->delete();
        return $delete;
    }

    /**
     * Include only soft deleted records in the results.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listTrashed(){
        $users = User::whereNotNull('deleted_at')->get();
        return $users;
    }

    /**
     * Restore model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function restore($id){
        $user = User::findOrFail($id);
        $user->updated_at = date('Y-m-d h:s:i');
        $user->deleted_at = NULL;
        $user->save();

        return $user;
    }

    /**
     * Permanently delete model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function delete($id){
        $user = User::findOrFail($id);
        $user->updated_at = date('Y-m-d h:s:i');
        $user->deleted_at = date('Y-m-d h:s:i');
        $user->save();

        return $user;
    }

    /**
     * Generate random hash key.
     *
     * @param  string $key
     * @return string
     */
    public function hash(string $key): string{
        return Hash::make($key);
    }

    /**
     * Upload the given file.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return string|null
     */
    public function upload(UploadedFile $file){
        $randomStr = Str::random(30);
        $fileName = $randomStr.'.'.$file->getClientOriginalExtension();
        $file->move('upload/',$fileName);

        return $fileName;
    }

    public function saveUserDetails(User $user)
    {
        $fullName = "{$user->firstname} {$user->middlename} {$user->lastname}";
        $middleInitial = strtoupper(substr($user->middlename, 0, 1));
        $avatar = $this->uploadAvatar($user->photo);

        $user->details()->create([
            'full_name' => $fullName,
            'middle_initial' => $middleInitial,
            'avatar' => $avatar,
        ]);
    }

    public function uploadAvatar(UploadedFile $file)
    {

    }

}