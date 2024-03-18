<?php

namespace App\Charts;

use App\Models\Menu;
use App\Models\Review;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AdminMenuReviewChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $reviews = Review::select('menu_id', 'rating')->get();

        $totalRatings = [];
        $reviewCounts = [];

        foreach ($reviews as $review) {
            if (!isset($totalRatings[$review->menu_id])) {
                $totalRatings[$review->menu_id] = 0;
                $reviewCounts[$review->menu_id] = 0;
            }
            $totalRatings[$review->menu_id] += $review->rating;
            $reviewCounts[$review->menu_id]++;
        }

        $menuNames = [];
        $averageRatings = [];

        foreach ($totalRatings as $menuId => $totalRating) {
            $menu = Menu::find($menuId);
            if ($menu) {
                $menuNames[] = $menu->menu_name;
                $averageRatings[] = $totalRating / $reviewCounts[$menuId];
            }
        }

        return $this->chart->barChart()
            ->setTitle('Rata Rata Rating Menu')
            ->setSubtitle('Tampilan Total Rating pada Setiap Menu')
            ->addData('Rata-rata Rating', $averageRatings)
            ->setXAxis($menuNames);
    }
}
