<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Lesson\Question; // Ganti dengan model Anda

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))
            ->add(Url::create('/login')->setPriority(0.8))
            ->add(Url::create('/register')->setPriority(0.8));

        // Tambahkan link dinamis dari Database (Contoh: Soal/Questions)
        $questions = Question::all();
        foreach ($questions as $question) {
            $sitemap->add(
                Url::create("/questions/{$question->slug}")
                    ->setPriority(0.6)
                    ->setLastModificationDate($question->updated_at)
            );
        }

        return $sitemap->toResponse(request());
    }
}