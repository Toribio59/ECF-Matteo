<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CarController extends AbstractController
{
    /** @var CarRepository */
    private $carRepository;

    /** @var ValidatorInterface */
    private $validator;

    /** @var DenormalizeInterface */
    private $denormlizer;

    /** @var TranslatorInterface */
    private $translator;

    private const POST_PER_PAGE = 10;

    public function __construct(
        CarRepository $carRepository, 
        ValidatorInterface $validator, 
        DenormalizerInterface $denormlizer, 
        TranslatorInterface $translator
        )
    {
        $this->carRepository = $carRepository;
        $this->validator = $validator;
        $this->denormlizer = $denormlizer;
        $this->translator = $translator;
    }



    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CarController.php',
        ]);
    }

    public function getCarsPaginated(Request $request, int $page = 1): JsonResponse
    {
        $params = $request->query->all();

        try {
            $data = $this->carRepository->searchCar($params, $page, self::POST_PER_PAGE);
        } catch (\Exception $e) {
            return $this->json(
                [
                    'success' => false,
                    'message' => sprintf('Unable to get cars. %s', $e->getMessage()),
                    'data' => []
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return $this->json(
            [
                'success' => true,
                'message' => 'Cars fetched successfully',
                'data' => $data
            ],
            Response::HTTP_OK
        );
    }

    public function addCar(Request $request): JsonResponse
    {
        $language = $request->getLocale() ?? 'en';

        try {
            $jsonData = $request->getContent() ? json_decode($request->getContent(), true) : [];
        } catch (\Exception $e) {
            return $this->json([
                [
                    'success' => false,
                    'message' => sprintf('Unable to add car. %s', $e->getMessage()),
                    'data' => []
                ]
            ]);
        }

        $fieldsValidation = new Assert\Collection([
            "fields" => [
                'title' => [
                    new Assert\Type('string', "Le titre doit être une chaine de caractères"),
                ],
                'price' => [
                    new Assert\Type('integer', "Le prix doit être un nombre entier"),
                ],
                'manufactureYear' => [
                    new Assert\Type('integer', "L'année de fabrication doit être une chaine de caractères"),
                ],
                'mileage' => [
                    new Assert\Type('float', "Le kilométrage doit être un nombre"),
                ],
                'description' => [
                    new Assert\Type('string', "La description doit être une chaine de caractères"),
                ],
                'model' => [
                    new Assert\Type('string', "Le modèle doit être une chaine de caractères"),
                ],
                'brand' => [
                    new Assert\Type('string', "La marque doit être une chaine de caractères"),
                ],
            ],
            "allowMissingFields" => false,
            "missingFieldsMessage" => "Attention, un ou plusieurs champs sont manquants",
            "allowExtraFields" => true,
        ]);

        /* errorsType */
        $errorsType = $this->validator->validate($jsonData, $fieldsValidation);

        if (count($errorsType) > 0) {
            return $this->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $errorsType,
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
        }

        try{
            /** @var Car */
            $car = $this->denormlizer->denormalize($jsonData, Car::class);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => sprintf('Erreur serveur: . %s', $e->getMessage()),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $errors = $this->validator->validate($car);

        if (count($errors) > 0) {
            $errorsResponse = $this->getErrorMessage($errors);

            return $this->json([
                'success' => false,
                $this->translator->trans('errors.validation', [],"message", $language),
                'errors' => $errorsResponse,
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
        }
        try{
            $this->carRepository->add($car, true);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => sprintf('Erreur serveur: . %s', $e->getMessage()),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json([
            'success' => true,
            'message' => 'Voiture ajoutée avec succès',
            'data' => []
        ], Response::HTTP_CREATED);

    }

    public function updateCar(Request $request, int $carId): JsonResponse
    {
        $language = $request->getLocale() ?? 'en';

        try{
            $car = $this->carRepository->find($carId);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => sprintf('Erreur serveur: . %s', $e->getMessage()),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if(!$car instanceof Car){
            return $this->json([
                'success' => false,
                'message' => 'Voiture non trouvée',
                'data' => []
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $jsonData = $request->getContent() ? json_decode($request->getContent(), true) : [];
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => sprintf('Erreur serveur: . %s', $e->getMessage()),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $fieldsValidation = new Assert\Collection([
            "fields" => [
                'title' => [
                    new Assert\Type('string', "Le titre doit être une chaine de caractères"),
                ],
                'price' => [
                    new Assert\Type('integer', "Le prix doit être un nombre entier"),
                ],
                'manufactureYear' => [
                    new Assert\Type('string', "L'année de fabrication doit être une chaine de caractères"),
                ],
                'mileage' => [
                    new Assert\Type('float', "Le kilométrage doit être un nombre"),
                ],
                'description' => [
                    new Assert\Type('string', "La description doit être une chaine de caractères"),
                ],
                'listOfImages' => [
                    new Assert\Type('array', "La liste d'images doit être un tableau"),
                ],
                'model' => [
                    new Assert\Type('string', "Le modèle doit être une chaine de caractères"),
                ],
            ],
            "allowMissingFields" => true,
            "allowExtraFields" => true,
        ]);

        $errorsType = $this->validator->validate($jsonData, $fieldsValidation);

        if (count($errorsType) > 0) {
            return $this->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $errorsType,
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
        }

        try{
            /** @var Car */
            $car = $this->denormlizer->denormalize($jsonData, Car::class);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => sprintf('Erreur serveur: . %s', $e->getMessage()),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $errors = $this->validator->validate($car);

        if (count($errors) > 0){
            $errorsResponse = $this->getErrorMessage($errors);

            return $this->json(
                [
                    'success' => false,
                    'message' => 'Erreur de validation',
                    'errors' => $errorsResponse,
                    'data' => []
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        try{
            $this->carRepository->flush();
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => "Erreur lors de la modification de la voiture",
                'error' => $e->getMessage(),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json([
            'success' => true,
            'message' => 'Voiture modifiée avec succès',
            'data' => $car
        ], Response::HTTP_OK);
    }

    public function removeCar(Request $request, int $carId): JsonResponse
    {
        try{
            $player = $this->carRepository->find($carId);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => sprintf('Erreur serveur: . %s', $e->getMessage()),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        if(!$player instanceof Car){
            return $this->json([
                'success' => false,
                'message' => 'Voiture non trouvée',
                'data' => []
            ], Response::HTTP_NOT_FOUND);
        }

        try{
            $this->carRepository->remove($player, true);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => sprintf('Erreur serveur: . %s', $e->getMessage()),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json([
            'success' => true,
            'message' => 'Voiture supprimée avec succès',
            'data' => []
        ], Response::HTTP_OK);
    }


    /**
     * Get error message from validator response
     * 
     * @param ConstraintViolationListInterface $errors validator response
     * @return Array Readable error
     */
    private function getErrorMessage(ConstraintViolationListInterface $errors): array
    {
        $errorsResponse = [];

        foreach ($errors as $error) {
            $errorsResponse[] = [
                'name' => $error->getPropertyPath(),
                'message' => $error->getMessage(),
                'invalid_value' => $error->getInValidValue()
            ];
        }
        return $errorsResponse;
    }
}