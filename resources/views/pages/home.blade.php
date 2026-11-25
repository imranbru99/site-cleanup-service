@extends('layouts.app')

@section('title', 'SweepForge Site Cleanup')
@section('meta_description', 'Final construction sweeps, rough debris hauling, slurry removal, and progressive cleans across Dallas–Fort Worth by SweepForge Site Cleanup.')

@section('content')
<section class="hero">
    <div class="wrap hero-inner">
        <h1>SweepForge<br>Site Cleanup</h1>
        <p>Jobsite cleanup crews who leave floors broom-clean, lots haul-ready, and walkthroughs free of yesterday’s scrap — so GCs, owners, and inspectors see finished work, not leftover grit.</p>
        <div class="hero-ctas">
            <a class="btn btn-primary" href="{{ route('contact') }}">Book a free site walk</a>
            <a class="btn btn-ghost" href="{{ route('services') }}">Explore cleanup services</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <h2>Cleanup services</h2>
        <p class="lede">Final sweeps, rough debris hauling, slurry recovery, post-demo lot clearing, and daily progressive cleans for DFW construction sites.</p>
        <div class="grid-3">
            @foreach([
                ['final-construction-sweep','Final Construction Sweep','Punch-list ready broom-clean before turnover and owner walkthroughs.','https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1200&q=80'],
                ['rough-debris-hauling','Rough Debris Hauling','Framing scraps, drywall, and packaging staged into roll-offs on schedule.','https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1200&q=80'],
                ['concrete-slurry-mud-removal','Concrete Slurry & Mud','Track-out and pour-day residue cleared before it hardens into damage.','https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=1200&q=80'],
            ] as [$slug,$title,$blurb,$img])
                <a class="service-tile" href="{{ route('services.show', $slug) }}">
                    <img src="{{ $img }}" alt="{{ $title }}">
                    <div class="pad">
                        <h3>{{ $title }}</h3>
                        <p>{{ $blurb }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Why SweepForge</h2>
        <p class="lede">DFW cleanup crews who treat safety, diversion rates, and schedule as non-negotiable — because messy sites slow every trade behind you.</p>
        <div class="grid-3">
            <div class="panel">
                <h3>Trade-aware sequencing</h3>
                <p>We time progressive and final cleans around drywall, flooring, and punch so your GC timeline stays intact.</p>
            </div>
            <div class="panel">
                <h3>Documented diversion</h3>
                <p>Metal, cardboard, and clean wood staged with haul tickets — so LEED and ESG paperwork is evidence, not guesswork.</p>
            </div>
            <div class="panel">
                <h3>ERP-run jobs</h3>
                <p>Quotes, crew days, dumpster pulls, and invoices live in one operations stack — fewer missed callbacks.</p>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Ops dashboard preview</h2>
        <p class="lede">A glimpse of the SweepForge ERP used to schedule cleans, track supplies, and close invoices.</p>
        <div class="dash-preview">
            <div>
                <div class="grid-3" style="grid-template-columns:repeat(3,1fr)">
                    <div class="metric"><strong>28</strong> Active jobs</div>
                    <div class="metric"><strong>$186k</strong> Pipeline</div>
                    <div class="metric"><strong>19</strong> Site walks</div>
                </div>
                <div class="bars">
                    <span style="height:45%"></span><span style="height:70%"></span><span style="height:55%"></span>
                    <span style="height:85%"></span><span style="height:60%"></span><span style="height:95%"></span>
                    <span style="height:75%"></span>
                </div>
            </div>
            <div>
                <h3 style="font-family:var(--font-display);margin-top:0">Live modules</h3>
                <ul style="line-height:1.9;padding-left:1.1rem;color:rgba(255,255,255,.86)">
                    <li>Jobs & scheduling</li>
                    <li>Cleanup supply inventory</li>
                    <li>Invoices & payments</li>
                    <li>AI content + troubleshooting</li>
                </ul>
                <a class="btn btn-primary" style="margin-top:1rem" href="/admin">Open admin ERP</a>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>From the jobsite</h2>
        <p class="lede">Guides for GCs and owners on final sweeps, diversion, and keeping active floors safe.</p>
        <div class="grid-3">
            @forelse($posts as $post)
                <a class="panel" href="{{ route('blog.show', $post->slug) }}">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->excerpt }}</p>
                </a>
            @empty
                <div class="panel"><p>Blog posts will appear after seeding.</p></div>
            @endforelse
        </div>
    </div>
</section>
@endsection
