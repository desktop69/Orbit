<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use App\Repository\ClientRepository;
/**
 * @Route("/", name="dashboard_")
 * @package App\Controller
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dash")
     */
    public function index(ClientRepository $clientRepository,ChartBuilderInterface $chartBuilder): Response
    {
        $dailyResults = $clientRepository->findAll();

        $labels = [];
        $data = [];

        foreach ($dailyResults as $dailyResult) {
            $labels[] = $dailyResult->getCreatedAt()->format('d/m/Y');
            $data[] = $dailyResult->getRevenuSalary();
        }

        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $data,
                ],
            ],
        ]);

        $chart->setOptions([]);

        return $this->render('dashboard/indextest.html.twig', [
            'controller_name' => 'DashboardController',
            'Chart' => $chart,
        ]);
    }
}
