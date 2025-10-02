<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Doctrine\Common\State\PersistProcessor;
use App\Entity\Users;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserProcessor implements ProcessorInterface
{
    private PersistProcessor $persistProcessor;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(PersistProcessor $persistProcessor, UserPasswordHasherInterface $passwordHasher)
    {
        $this->persistProcessor = $persistProcessor;
        $this->passwordHasher = $passwordHasher;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        if ($data instanceof Users && $data->getPassword()) {
            // Hasher le mot de passe uniquement si on en a un en clair
            $hashedPassword = $this->passwordHasher->hashPassword($data, $data->getPassword());
            $data->setPassword($hashedPassword);
        }

        // Laisser API Platform faire la persistance classique
        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }
}
