@extends('layouts.app')
@section('title', 'Knowledge Base')
@section('content')
<section class="section">
    <div class="wrap">
        <h2>Knowledge base</h2>
        <p class="lede">Common issues, cleanup guides, admin manual notes, and troubleshooting for SweepForge site cleanup operations.</p>
        @foreach($articles as $category => $items)
            <h3 style="font-family:var(--font-display);margin:2rem 0 .75rem;text-transform:capitalize">{{ str_replace('_', ' ', $category) }}</h3>
            <div class="grid-2">
                @foreach($items as $article)
                    <a class="panel" href="{{ route('knowledge.show', $article->slug) }}">
                        <h3>{{ $article->title }}</h3>
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
</section>
@endsection
