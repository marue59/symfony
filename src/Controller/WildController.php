<?php

// src/Controller/WildController.php
namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Category;
use App\Entity\Program;
use App\Entity\Season;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class WildController extends AbstractController
{
    /**
     * @return Response
     * @Route("/wild", name="wild_index")
     */

    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        if (!$programs) {
            throw $this->createNotFoundException(
                'No program found in program\'s table.'
            );
        }

        return $this->render(
            'wild/index.html.twig',
            ['programs' => $programs]
        );
    }

    /**
     * Getting a program with a formatted slug for title
     *
     * @param string $slug The slugger
     * @Route("/wild/show/{slug<^[a-z0-9-]+$>}", defaults={"slug" = null}, name="show")
     * @return Response
     */

    public function show(?string $slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find a program in program\'s table.');
        }
        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with ' . $slug . ' title, found in program\'s table.'
            );
        }

        return $this->render('wild/show.html.twig', [
            'program' => $program,
            'slug' => $slug,
        ]);
    }

    /**
     * @Route("/wild/category/{categoryName}", defaults={"categoryName" = null}, name="show_category").
     * @param string $categoryName
     * @return Response
     */
    public function showByCategory(?string $categoryName): Response
    {
        if (!$categoryName) {
            throw $this
                ->createNotFoundException('No category has been sent to find');
        }
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);


        $categoryId = $category->getId();

        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['category' => $categoryId],
                ['id' => 'DESC'],
                3
            );
        return $this->render('wild/category.html.twig', [
            'programs' => $program,
            'categoryName' => $categoryName,
        ]);
    }

    /**
     * @Route("/wild/showByProgram/{slug<^[a-z0-9-]+$>}", name="show_by_program").
     * @param string $slug
     * @return Response
     */
    public function showByProgram(?string $slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find a program in program\'s table.');
        }
        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with ' . $slug . ' found.'
            );
        }
        $id_program = $program->getId();
        $season = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findBy(["program" => $id_program]);

        $title = preg_replace(
            '/ /',
            '-', strtolower($slug)
        );

        return $this->render('wild/showByProgram.html.twig', [
            'program' => $program,
            'slug' => $title,
            'seasons' => $season,
        ]);
    }

    /**
     * @param int|null $id
     * @return Response
     * @Route("show/season/{id}", name="showAllSeason")
     */
    public function showBySeason(?int $id): Response
    {
        if (!$id) {
            throw $this
                ->createNotFoundException('No slug has been sent to find a season.');
        }
        $season = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findOneBy(['id' => $id]);
        if (!$season) {
            throw $this->createNotFoundException(
                'No season with id = ' . $id . ', found.'
            );
        }
        $episodes = $season->getEpisodes();
        $program = $season->getProgram();


        return $this->render('wild/showAllSeason.html.twig', [
            'season' => $season,
            'episodes' => $episodes,
            'program' => $program,
        ]);
    }
    /**
     *
     * @param string|null $id
     * @return Response
     * @Route("show/episode/{id}", name="show_episode")
     */
    public function showByEpisode(?string $id):Response
    {
        if (!$id) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an episode.');
        }
        $episode = $this->getDoctrine()
            ->getRepository(Episode::class)
            ->findBy(['season' => $id]);

        if (!$episode) {
            throw $this->createNotFoundException(
                'No episode with id = '.$id.', found.'
            );
        }
        return $this->render('wild/showAllSeason.html.twig', [
            'episode' => $episode,
        ]);
    }
}
