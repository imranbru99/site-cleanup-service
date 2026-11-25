@extends('layouts.app')
@section('title', 'Contact SweepForge')
@section('content')
<section class="section">
    <div class="wrap grid-2">
        <div>
            <h2>Contact</h2>
            <p class="lede">Tell us about your jobsite, square footage, and clean level. We’ll schedule a DFW site walk and send a written cleanup scope.</p>
            <div class="panel">
                <p><strong>Phone:</strong> (214) 555-0187</p>
                <p><strong>Email:</strong> hello@sweepforgesite.com</p>
                <p><strong>Service area:</strong> Dallas, Fort Worth, Plano, Arlington & Frisco</p>
                <p><strong>WhatsApp:</strong> <a href="https://wa.me/12145550187" target="_blank" rel="noopener">Chat now</a></p>
            </div>
        </div>
        <div class="panel">
            @if(session('success'))
                <div class="flash">{{ session('success') }}</div>
            @endif
            <form class="stack" method="post" action="{{ route('contact.store') }}">
                @csrf
                <div>
                    <label for="name">Name</label>
                    <input id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')<small style="color:#b91c1c">{{ $message }}</small>@enderror
                </div>
                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')<small style="color:#b91c1c">{{ $message }}</small>@enderror
                </div>
                <div>
                    <label for="phone">Phone</label>
                    <input id="phone" name="phone" value="{{ old('phone') }}">
                </div>
                <div>
                    <label for="subject">Subject</label>
                    <input id="subject" name="subject" value="{{ old('subject') }}">
                </div>
                <div>
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                    @error('message')<small style="color:#b91c1c">{{ $message }}</small>@enderror
                </div>
                <button class="btn btn-primary" type="submit">Send message</button>
            </form>
        </div>
    </div>
</section>
@endsection
