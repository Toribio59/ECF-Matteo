<?php

namespace App\Controller;

use App\Entity\Testimonial;
use App\Repository\TestimonialRepository;

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

class TestimonialController extends AbstractController
{
    /** @var TestimonialRepository */
    private $testimonialRepository;

    /** @var ValidatorInterface */
    private $validator;

    /** @var DenormalizeInterface */
    private $denormlizer;

    /** @var TranslatorInterface */
    private $translator;

    private const POSTS_PER_PAGE = 10;

    public function __construct(
        TestimonialRepository $testimonialRepository,
        ValidatorInterface $validator,
        DenormalizerInterface $denormlizer,
        TranslatorInterface $translator
    ) {
        $this->testimonialRepository = $testimonialRepository;
        $this->validator = $validator;
        $this->denormlizer = $denormlizer;
        $this->translator = $translator;
    }

    public function getTestimonialsPaginated(Request $request,int $page = 1): JsonResponse
    {
        $params = $request->query->all();

        try {
            $data = $this->testimonialRepository->searchTestimonal($params, $page, self::POSTS_PER_PAGE);
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
                'message' => 'Testimonials fetched successfully',
                'data' => $data
            ],
            Response::HTTP_OK
        );
    }
}
