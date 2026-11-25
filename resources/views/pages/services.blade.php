@extends('layouts.app')
@section('title', 'Cleanup Services')
@section('content')
<section class="section">
    <div class="wrap">
        <h2>Services</h2>
        <p class="lede">SweepForge runs final construction sweeps, rough debris hauling, slurry recovery, post-demo lot clearing, progressive cleans, and recycle sorting across Dallas–Fort Worth.</p>
        <div class="grid-3">
            @foreach([
                ['final-construction-sweep','Final Construction Sweep','https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1200&q=80'],
                ['rough-debris-hauling','Rough Debris Hauling','https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1200&q=80'],
                ['concrete-slurry-mud-removal','Concrete Slurry & Mud Removal','https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=1200&q=80'],
                ['post-demolition-lot-clearing','Post-Demolition Lot Clearing','https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1600&q=80'],
                ['daily-progressive-clean','Daily Progressive Clean','https://images.unsplash.com/photo-1590642916438-c380ca4d3c0e?auto=format&fit=crop&w=1200&q=80'],
                ['recycle-scrap-sort','Recycle & Scrap Sort','https://images.unsplash.com/photo-1532996122724-e3c354a0b4bd?auto=format&fit=crop&w=1200&q=80'],
            ] as [$slug,$title,$img])
                <a class="service-tile" href="{{ route('services.show', $slug) }}">
                    <img src="{{ $img }}" alt="{{ $title }}">
                    <div class="pad"><h3>{{ $title }}</h3></div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
