<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\KnowledgeArticle;
use App\Models\Post;
use App\Services\AiService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->take(3)->get();

        return view('pages.home', compact('posts'));
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function serviceShow(string $slug): View
    {
        $services = $this->serviceCatalog();
        abort_unless(isset($services[$slug]), 404);

        return view('services.show', [
            'slug' => $slug,
            'service' => $services[$slug],
            'services' => $services,
        ]);
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::query()->create($data);

        return back()->with('success', 'Thanks! SweepForge will follow up within one business day.');
    }

    public function blog(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->paginate(9);

        return view('blog.index', compact('posts'));
    }

    public function blogShow(string $slug): View
    {
        $post = Post::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('blog.show', compact('post'));
    }

    public function knowledge(): View
    {
        $articles = KnowledgeArticle::query()->where('is_published', true)->orderBy('category')->orderBy('title')->get()->groupBy('category');

        return view('kb.index', compact('articles'));
    }

    public function knowledgeShow(string $slug): View
    {
        $article = KnowledgeArticle::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('kb.show', compact('article'));
    }

    public function chat(Request $request, AiService $ai)
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
            'session_id' => ['nullable', 'string', 'max:80'],
        ]);

        $result = $ai->chat($data['message'], $data['session_id'] ?? null);

        return response()->json($result);
    }

    /** @return array<string, array<string, string>> */
    protected function serviceCatalog(): array
    {
        return [
            'final-construction-sweep' => [
                'title' => 'Final Construction Sweep',
                'summary' => 'Punch-list ready broom-clean so GC walkthroughs and owners see finished space, not leftover grit.',
                'body' => 'SweepForge runs a sequenced final sweep: dust walls and millwork, vacuum HVAC returns, scrub mud tracks, haul scrap, and stage recyclables. Ideal before turnover, realtor photos, or municipal inspections across Dallas–Fort Worth jobsites.',
                'image' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1600&q=80',
            ],
            'rough-debris-hauling' => [
                'title' => 'Rough Debris Hauling',
                'summary' => 'Framing scraps, drywall, packaging, and pallet break-downs staged into dumpsters or roll-offs on your schedule.',
                'body' => 'We clear active floors and lots so trades keep moving. Crews sort wood, metal, and general C&D where required, load roll-offs safely, and leave corridors open for deliveries. Same-day and nightly hauls available for mid-rise and TI work.',
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1600&q=80',
            ],
            'concrete-slurry-mud-removal' => [
                'title' => 'Concrete Slurry & Mud Removal',
                'summary' => 'Track-out, slurry cake, and poured-floor residue cleared before it hardens into permanent damage.',
                'body' => 'Wet sawing and pour days leave slurry that stains sidewalks and clogs drains. SweepForge scrapes, pressure-rinses where allowed, and recovers solids for proper disposal — protecting neighboring properties and your stormwater compliance.',
                'image' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=1600&q=80',
            ],
            'post-demolition-lot-clearing' => [
                'title' => 'Post-Demolition Lot Clearing',
                'summary' => 'After teardown, we clear rubble piles, rebar nests, and perimeter trash so the lot is shovel-ready.',
                'body' => 'Demolition leaves mixed debris that blocks surveyors and excavators. We segregate scrap metal, load heavy debris, sweep perimeter fences, and document loads for your GC closeout packet.',
                'image' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1600&q=80',
            ],
            'daily-progressive-clean' => [
                'title' => 'Daily Progressive Clean',
                'summary' => 'Standing crews that keep active floors walkable every shift — fewer injuries, faster inspections.',
                'body' => 'Progressive cleans happen while trades are still on site. We clear nail droppings, cut ends, cardboard, and lunch trash from corridors and stairwells so the next trade walks into a safer deck — not yesterday’s mess.',
                'image' => 'https://images.unsplash.com/photo-1590642916438-c380ca4d3c0e?auto=format&fit=crop&w=1600&q=80',
            ],
            'recycle-scrap-sort' => [
                'title' => 'Recycle & Scrap Sort',
                'summary' => 'Metal, cardboard, and clean wood diverted from landfill with tagged loads for your sustainability report.',
                'body' => 'Owners and municipalities increasingly require diversion rates. SweepForge stages labeled bins, trains site stewards, and provides haul tickets so your LEED or corporate ESG paperwork is defensible — not guessed.',
                'image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b4bd?auto=format&fit=crop&w=1600&q=80',
            ],
        ];
    }
}
