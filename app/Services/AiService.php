<?php

namespace App\Services;

use App\Models\ChatLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    /** @var array<int, array{q: string, a: string}> */
    protected array $faq = [
        [
            'q' => 'cost price estimate square foot final sweep broom clean',
            'a' => 'Most DFW final construction sweeps run about $0.35–$0.90 per sq ft depending on finish level, floor count, and debris volume. Rough cleans and hauling are quoted by load or crew-day. Request a free site walk for an exact scope.',
        ],
        [
            'q' => 'dumpster haul debris roll-off scrap metal cardboard',
            'a' => 'SweepForge stages roll-offs, sorts scrap metal and cardboard when required, and hauls C&D debris on your schedule. Nightly and same-day hauls are available for mid-rise and tenant improvement sites.',
        ],
        [
            'q' => 'slurry concrete mud track-out sidewalk stormwater',
            'a' => 'We scrape and recover concrete slurry before it hardens, rinse track-out where allowed, and keep drains clear to support stormwater compliance. Do not let pour-day residue bake onto sidewalks overnight.',
        ],
        [
            'q' => 'demolition lot clearing rubble rebar post teardown',
            'a' => 'After demolition we clear rubble piles, rebar nests, and perimeter trash so surveyors and excavators can mobilize. Loads are documented for your GC closeout packet.',
        ],
        [
            'q' => 'daily progressive clean nail droppings safety trade',
            'a' => 'Progressive cleans keep active floors walkable every shift — nail droppings, cut ends, and packaging cleared from corridors and stairs so the next trade walks into a safer deck.',
        ],
        [
            'q' => 'schedule appointment quote contact dallas fort worth',
            'a' => 'Call or text (214) 555-0187, use the contact form, or WhatsApp us. Site walks across Dallas, Fort Worth, Plano, Arlington, and nearby cities are usually available within 1–2 business days.',
        ],
        [
            'q' => 'recycle diversion leed sustainability bin sort',
            'a' => 'We stage labeled bins for metal, cardboard, and clean wood, train site stewards, and provide haul tickets so diversion rates for LEED or ESG reporting are documented.',
        ],
        [
            'q' => 'warranty insurance bonded licensed crew',
            'a' => 'SweepForge crews are insured for construction-site work. Ask for a current COI with your GC named as additional insured when you book a progressive or final clean package.',
        ],
    ];

    public function chat(string $message, ?string $sessionId = null): array
    {
        $reply = null;
        $source = 'demo';

        if ($key = config('services.openai.key')) {
            try {
                $reply = $this->callOpenAi($message, $key);
                $source = 'openai';
            } catch (\Throwable) {
                $reply = null;
            }
        }

        if (! $reply && ($gemini = config('services.gemini.key'))) {
            try {
                $reply = $this->callGemini($message, $gemini);
                $source = 'gemini';
            } catch (\Throwable) {
                $reply = null;
            }
        }

        if (! $reply) {
            $reply = $this->demoReply($message);
            $source = 'demo';
        }

        ChatLog::query()->create([
            'session_id' => $sessionId,
            'message' => $message,
            'reply' => $reply,
            'source' => $source,
        ]);

        return ['reply' => $reply, 'source' => $source];
    }

    public function generate(string $type, string $prompt): string
    {
        $message = match ($type) {
            'blog' => "Write a concise SEO blog post outline and intro for a construction site cleanup company about: {$prompt}",
            'description' => "Write a compelling service/product description for construction site cleanup: {$prompt}",
            'automation' => "Suggest 5 practical AI automations for a site cleanup SME ERP related to: {$prompt}",
            'troubleshoot' => "Troubleshoot this site cleanup operations issue with clear steps: {$prompt}",
            default => $prompt,
        };

        $result = $this->chat($message);

        return $result['reply'];
    }

    protected function demoReply(string $message): string
    {
        $hay = Str::lower($message);
        $best = null;
        $bestScore = 0;

        foreach ($this->faq as $item) {
            $score = 0;
            foreach (explode(' ', $item['q']) as $word) {
                if ($word !== '' && str_contains($hay, $word)) {
                    $score++;
                }
            }
            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $item['a'];
            }
        }

        if ($best && $bestScore > 0) {
            return $best;
        }

        return 'Thanks for reaching SweepForge Site Cleanup. We handle final sweeps, rough debris hauling, slurry cleanup, and progressive cleans across Dallas–Fort Worth. Ask about pricing, dumpsters, demotion lot clearing, or scheduling—or call (214) 555-0187 for a free site walk.';
    }

    protected function callOpenAi(string $message, string $key): string
    {
        $response = Http::withToken($key)
            ->timeout(30)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => config('services.openai.model', 'gpt-4o-mini'),
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are the SweepForge Site Cleanup assistant for a Dallas–Fort Worth construction site cleanup company. Be concise and practical about final sweeps, debris hauling, slurry removal, progressive cleans, and recycle sorting. Never invent illegal claims.',
                    ],
                    ['role' => 'user', 'content' => $message],
                ],
                'temperature' => 0.4,
            ]);

        $response->throw();

        return (string) data_get($response->json(), 'choices.0.message.content', 'Unable to generate a response.');
    }

    protected function callGemini(string $message, string $key): string
    {
        $model = config('services.gemini.model', 'gemini-1.5-flash');
        $response = Http::timeout(30)
            ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$key}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "You are SweepForge Site Cleanup assistant (Dallas–Fort Worth construction cleanup). Answer briefly:\n{$message}"],
                        ],
                    ],
                ],
            ]);

        $response->throw();

        return (string) data_get($response->json(), 'candidates.0.content.parts.0.text', 'Unable to generate a response.');
    }
}
