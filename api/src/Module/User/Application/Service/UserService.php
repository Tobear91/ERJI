<?php

namespace App\Module\User\Application\Service;

use App\Module\User\Application\DTO\UserDTO;
use App\Module\User\Domain\Entity\User;
use App\Module\User\Application\Service\UserMapper;
use App\Module\User\Infrastructure\Doctrine\UserRepository;
use App\Module\User\Validation\Service\UserValidator;

class UserService
{

    public function __construct(private UserRepository $userRepository) {}

    public function createUser(array $userData): UserDTO
    {
        UserValidator::validate($userData);

        $user = new User(
            firstname: $userData['firstname'],
            lastname: $userData['lastname'],
            email: $userData['email']
        );

        $record = UserMapper::toRecord($user);

        $this->userRepository->save($record);

        return UserMapper::toDTO(UserMapper::toDomain($record));
    }
}
