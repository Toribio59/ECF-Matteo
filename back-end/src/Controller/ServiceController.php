<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\ServiceRepository;

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


class ServiceController extends AbstractController
{
    /** @var ServiceRepository */
    private $serviceRepository;

    /** @var ValidatorInterface */
    private $validator;

    /** @var DenormalizeInterface */
    private $denormlizer;

    /** @var TranslatorInterface */
    private $translator;

    private const POSTS_PER_PAGE = 10;

    public function __construct(
        ServiceRepository $serviceRepository,
        ValidatorInterface $validator,
        DenormalizerInterface $denormlizer,
        TranslatorInterface $translator
    ) {
        $this->serviceRepository = $serviceRepository;
        $this->validator = $validator;
        $this->denormlizer = $denormlizer;
        $this->translator = $translator;
    }

    public function getServicesPaginated(Request $request,int $page = 1): JsonResponse
    {
        $params = $request->query->all();

        try {
            $data = $this->serviceRepository->searchService($params, $page, self::POSTS_PER_PAGE);
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
                'message' => 'Services fetched successfully',
                'data' => $data
            ],
            Response::HTTP_OK
        );
    }
}
