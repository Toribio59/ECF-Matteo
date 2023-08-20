<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Repository\ScheduleRepository;

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


class ScheduleController extends AbstractController
{
    /** @var ScheduleRepository */
    private $scheduleRepository;

    /** @var ValidatorInterface */
    private $validator;

    /** @var DenormalizeInterface */
    private $denormlizer;

    /** @var TranslatorInterface */
    private $translator;

    public function __construct(
        ScheduleRepository $scheduleRepository,
        ValidatorInterface $validator,
        DenormalizerInterface $denormlizer,
        TranslatorInterface $translator
    ) {
        $this->scheduleRepository = $scheduleRepository;
        $this->validator = $validator;
        $this->denormlizer = $denormlizer;
        $this->translator = $translator;
    }

    public function getSchedule(Request $request): JsonResponse
    {
        try {
            /** @var Schedule */
            $schedule = $this->scheduleRepository->findAll();
        } catch (\Exception $e) {
            return $this->json(
                [
                    'success' => false,
                    'message' => "Erreur lors de la récupération des horaires",
                    'error' => $e->getMessage(),
                    'data' => [],
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return $this->json(
            [
                'success' => true,
                'message' => "Horaires récupérés avec succès",
                'data' => $schedule,
            ],
            Response::HTTP_OK
        );
    }

    public function updateSchedule(Request $request): JsonResponse
    {
        $language = $request->getLocale() ?? 'en';

        try {
            /** @var Schedule */
            $schedule = $this->scheduleRepository->findAll();
        } catch (\Exception $e) {
            return $this->json(
                [
                    'success' => false,
                    'message' => sprintf("Erreur lors de la récupération des horaires:   "),
                    'error' => $e->getMessage(),
                    'data' => [],
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
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
            'fields' => [
                // can be string or null
                'mondayOTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'mondayOTM' doit être une chaîne de caractères"),
                ]),
                'mondayCTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'mondayCTM' doit être une chaîne de caractères"),
                ]),
                'mondayOTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'mondayOTA' doit être une chaîne de caractères"),
                ]),
                'mondayCTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'mondayCTA' doit être une chaîne de caractères"),
                ]),
                'tuesdayOTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'tuesdayOTM' doit être une chaîne de caractères"),
                ]),
                'tuesdayCTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'tuesdayCTM' doit être une chaîne de caractères"),
                ]),
                'tuesdayOTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'tuesdayOTA' doit être une chaîne de caractères"),
                ]),
                'tuesdayCTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'tuesdayCTA' doit être une chaîne de caractères"),
                ]),
                'wednesdayOTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'wednesdayOTM' doit être une chaîne de caractères"),
                ]),
                'wednesdayCTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'wednesdayCTM' doit être une chaîne de caractères"),
                ]),
                'wednesdayOTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'wednesdayOTA' doit être une chaîne de caractères"),
                ]),
                'wednesdayCTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'wednesdayCTA' doit être une chaîne de caractères"),
                ]),
                'thursdayOTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'thursdayOTM' doit être une chaîne de caractères"),
                ]),
                'thursdayCTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'thursdayCTM' doit être une chaîne de caractères"),
                ]),
                'thursdayOTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'thursdayOTA' doit être une chaîne de caractères"),
                ]),
                'thursdayCTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'thursdayCTA' doit être une chaîne de caractères"),
                ]),
                'fridayOTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'fridayOTM' doit être une chaîne de caractères"),
                ]),
                'fridayCTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'fridayCTM' doit être une chaîne de caractères"),
                ]),
                'fridayOTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'fridayOTA' doit être une chaîne de caractères"),
                ]),
                'fridayCTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'fridayCTA' doit être une chaîne de caractères"),
                ]),
                'saturdayOTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'saturdayOTM' doit être une chaîne de caractères"),
                ]),
                'saturdayCTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'saturdayCTM' doit être une chaîne de caractères"),
                ]),
                'saturdayOTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'saturdayOTA' doit être une chaîne de caractères"),
                ]),
                'saturdayCTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'saturdayCTA' doit être une chaîne de caractères"),
                ]),
                'sundayOTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'sundayOTM' doit être une chaîne de caractères"),
                ]),
                'sundayCTM' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'sundayCTM' doit être une chaîne de caractères"),
                ]),
                'sundayOTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'sundayOTA' doit être une chaîne de caractères"),
                ]),
                'sundayCTA' =>  new Assert\Optional([
                    new Assert\Type(['type' => 'string'], "Le champ 'sundayCTA' doit être une chaîne de caractères"),
                ]),
            ],
            'allowExtraFields' => true,
            'allowMissingFields' => true,
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

        try {
            /** @var Schedule */
            $schedule = $this->denormlizer->denormalize($jsonData, Schedule::class, null);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => sprintf('Erreur serveur: . %s', $e->getMessage()),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $errors = $this->validator->validate($schedule);

        if (count($errors) > 0) {
            $errorsResponse = $this->getErrorMessage($errors);

            return $this->json(
                [
                    'success' => false,
                    'message' => "Erreur de validation",
                    'error' => $errorsResponse,
                    'data' => [],
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $this->scheduleRepository->flush();
        } catch (\Exception $e) {
            return $this->json(
                [
                    'success' => false,
                    'message' => "Erreur lors de la mise à jour des horaires",
                    'error' => $e->getMessage(),
                    'data' => [],
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return $this->json(
            [
                'success' => true,
                'message' => "Horaires mis à jour avec succès",
                'data' => $schedule,
            ],
            Response::HTTP_OK
        );
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
