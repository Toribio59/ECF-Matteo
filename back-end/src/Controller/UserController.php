<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /** @var UserRepository */
    private $userRepository;

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    public function userCreate(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $email = $data['email'];
        $password = $data['password'];

        $checkUser = $this->userRepository->findOneBy(['email' => $email]);
        if ($checkUser) {
            return $this->json([
                'success' => false,
                'message' => 'User already exists',
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);

        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => sprintf('Unable to create user. %s', $e->getMessage()),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_CREATED);
    }
}
