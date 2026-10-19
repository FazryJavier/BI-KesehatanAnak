<?php

namespace App\Http\Controllers;

use App\Enums\NewsCategory;
use App\Models\LookerStudio;
use App\Models\NewsUpdate;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(): View
    {
        return view('User.index', [
            'latestNews' => NewsUpdate::latestPublished()->limit(3)->get(),
            'lookerStudio' => LookerStudio::latest('id')->first(),
        ]);
    }

    public function news(Request $request): View
    {
        $category = NewsCategory::tryFrom((string) $request->query('kategori'));

        return view('User.kabar', [
            'news' => NewsUpdate::latestPublished()
                ->when($category, fn ($query) => $query->where('category', $category->value))
                ->paginate(9)
                ->withQueryString(),
            'category' => $category,
        ]);
    }

    public function newsShow(string $slug): View
    {
        $news = NewsUpdate::published()->where('slug', $slug)->with('author')->firstOrFail();

        return view('User.kabar-detail', [
            'news' => $news,
            'related' => NewsUpdate::published()
                ->whereKeyNot($news->getKey())
                ->where('category', $news->category->value)
                ->latest('published_at')
                ->limit(3)
                ->get(),
        ]);
    }

    public function services(): View
    {
        return view('User.service');
    }

    public function looker(): View
    {
        return view('User.looker', [
            'lookerStudio' => LookerStudio::latest('id')->first(),
        ]);
    }
}
