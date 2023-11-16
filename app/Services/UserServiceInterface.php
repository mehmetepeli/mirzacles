<?php

namespace App\Services;

interface UserServiceInterface{
    /**
     * Generate random hash key.
     *
     * @param  string $key
     * @return string
     */
    public function hash(string $key);

    /**
     * @return LengthAwarePaginator
     */
    public function list(): LengthAwarePaginator;

    /**
     * @param array $attributes
     * @return User
     */
    public function store(array $attributes): User;

    /**
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User;

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool;

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;

    /**
     * @return LengthAwarePaginator
     */
    public function listTrashed(): LengthAwarePaginator;

    /**
     * @param int $id
     * @return void
     */
    public function restore(int $id): void;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;

    /**
     * @return string|null
     */
    public function upload(UploadedFile $file): ?string;
}