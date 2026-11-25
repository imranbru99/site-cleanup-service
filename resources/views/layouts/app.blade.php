<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SweepForge Site Cleanup') — Dallas–Fort Worth Construction Cleanup</title>
    <meta name="description" content="@yield('meta_description', 'SweepForge Site Cleanup delivers final construction sweeps, debris hauling, slurry removal, and progressive cleans across Dallas–Fort Worth.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0f1c24;
            --accent: #b8e62e;
            --accent-deep: #8fb814;
            --teal: #1a6b6b;
            --mist: #6b7c85;
            --surface: #e8eef0;
            --panel: #f1f5f6;
            --white: #ffffff;
            --font-display: "Space Grotesk", sans-serif;
            --font-body: "Source Sans 3", sans-serif;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: var(--font-body);
            color: var(--ink);
            background:
                radial-gradient(900px 420px at 95% -10%, rgba(184,230,46,.18), transparent 55%),
                radial-gradient(700px 380px at -10% 20%, rgba(26,107,107,.14), transparent 50%),
                linear-gradient(180deg, #f4f8f9 0%, var(--surface) 48%, #d5e0e4 100%);
            min-height: 100vh;
        }
        a { color: inherit; text-decoration: none; }
        .wrap { width: min(1120px, calc(100% - 2rem)); margin-inline: auto; }
        .site-header {
            position: sticky; top: 0; z-index: 40;
            backdrop-filter: blur(12px);
            background: rgba(15,28,36,.95);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: .9rem 0; gap: 1rem;
        }
        .brand {
            font-family: var(--font-display);
            letter-spacing: -.02em;
            font-size: 1.35rem;
            color: #fff;
            font-weight: 700;
        }
        .brand span { color: var(--accent); }
        .nav-links { display: flex; flex-wrap: wrap; gap: .9rem 1.1rem; align-items: center; }
        .nav-links a { color: rgba(255,255,255,.82); font-size: .92rem; font-weight: 500; }
        .nav-links a:hover { color: #fff; }
        .btn {
            display: inline-flex; align-items: center; justify-content: center;
            gap: .4rem; padding: .75rem 1.2rem; border-radius: .2rem;
            font-weight: 700; border: 0; cursor: pointer;
            transition: transform .2s ease, background .2s ease, box-shadow .2s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: var(--accent); color: var(--ink); box-shadow: 0 10px 24px rgba(184,230,46,.28); }
        .btn-primary:hover { background: var(--accent-deep); color: #fff; }
        .btn-ghost { background: transparent; color: #fff; border: 1px solid rgba(255,255,255,.28); }
        .btn-dark { background: var(--ink); color: #fff; }
        .hero {
            min-height: calc(100vh - 64px);
            display: grid;
            align-items: end;
            position: relative;
            overflow: hidden;
            color: #fff;
            background:
                linear-gradient(105deg, rgba(15,28,36,.94) 0%, rgba(15,28,36,.62) 48%, rgba(15,28,36,.3) 100%),
                url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=2000&q=80') center/cover no-repeat;
        }
        .hero-inner { padding: 5.5rem 0 4rem; max-width: 640px; animation: rise .8s ease both; }
        .hero h1 {
            font-family: var(--font-display);
            font-size: clamp(2.6rem, 7vw, 4.2rem);
            line-height: .98;
            margin: 0 0 1rem;
            letter-spacing: -.03em;
        }
        .hero p { font-size: 1.08rem; line-height: 1.6; color: rgba(255,255,255,.88); margin: 0 0 1.5rem; max-width: 34rem; }
        .hero-ctas { display: flex; flex-wrap: wrap; gap: .75rem; }
        .section { padding: 4.5rem 0; }
        .section h2 {
            font-family: var(--font-display);
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            letter-spacing: -.02em;
            margin: 0 0 .75rem;
        }
        .lede { color: var(--mist); max-width: 40rem; line-height: 1.6; margin: 0 0 2rem; }
        .grid-3 { display: grid; gap: 1.25rem; grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .grid-2 { display: grid; gap: 1.5rem; grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .service-tile {
            position: relative; overflow: hidden; min-height: 260px; color: #fff;
            isolation: isolate; border-radius: .2rem;
        }
        .service-tile img {
            position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: -2;
            transition: transform .6s ease;
        }
        .service-tile:hover img { transform: scale(1.06); }
        .service-tile::after {
            content: ""; position: absolute; inset: 0; z-index: -1;
            background: linear-gradient(180deg, rgba(15,28,36,.1), rgba(15,28,36,.9));
        }
        .service-tile .pad { position: absolute; left: 0; right: 0; bottom: 0; padding: 1.25rem; }
        .service-tile h3 { margin: 0 0 .35rem; font-family: var(--font-display); letter-spacing: -.02em; }
        .service-tile p { margin: 0; color: rgba(255,255,255,.85); font-size: .92rem; }
        .panel {
            background: rgba(255,255,255,.78);
            border: 1px solid rgba(15,28,36,.06);
            padding: 1.4rem;
            border-radius: .2rem;
        }
        .panel h3 { margin: 0 0 .5rem; font-family: var(--font-display); letter-spacing: -.02em; }
        .dash-preview {
            display: grid; gap: 1rem; grid-template-columns: 1.2fr .8fr;
            background: var(--ink); color: #fff; padding: 1.5rem; overflow: hidden; border-radius: .25rem;
        }
        .metric { padding: 1rem; background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.08); border-radius: .2rem; }
        .metric strong { display: block; font-size: 1.6rem; color: var(--accent); font-family: var(--font-display); }
        .bars { display: flex; align-items: end; gap: .45rem; height: 140px; margin-top: 1rem; }
        .bars span {
            flex: 1; border-radius: 2px 2px 0 0;
            background: linear-gradient(180deg, var(--accent), var(--teal));
            animation: grow .9s ease both;
        }
        form.stack { display: grid; gap: .85rem; }
        label { font-weight: 600; font-size: .9rem; }
        input, textarea, select {
            width: 100%; padding: .8rem .9rem; border: 1px solid rgba(15,28,36,.14);
            background: #fff; font: inherit; border-radius: .2rem;
        }
        .flash {
            background: rgba(184,230,46,.18); border: 1px solid rgba(184,230,46,.45);
            color: #3d5208; padding: .9rem 1rem; margin-bottom: 1rem; border-radius: .2rem;
        }
        .site-footer {
            background: var(--ink); color: rgba(255,255,255,.78); padding: 2.5rem 0;
            margin-top: 2rem;
        }
        .site-footer .brand { margin-bottom: .5rem; }
        .wa-float {
            position: fixed; right: 1.1rem; bottom: 1.1rem; z-index: 50;
            width: 56px; height: 56px; border-radius: 999px;
            display: grid; place-items: center;
            background: #25d366; color: #fff; font-weight: 800;
            box-shadow: 0 12px 28px rgba(0,0,0,.25);
            animation: pulse 2.4s ease infinite;
        }
        .chat-widget {
            position: fixed; left: 1.1rem; bottom: 1.1rem; z-index: 50; width: min(360px, calc(100vw - 2rem));
        }
        .chat-toggle {
            background: var(--ink); color: #fff; border: 0; padding: .8rem 1rem;
            font-weight: 700; cursor: pointer; width: 100%; border-radius: .2rem;
        }
        .chat-panel {
            display: none; background: #fff; border: 1px solid rgba(15,28,36,.1);
            box-shadow: 0 18px 40px rgba(15,28,36,.18); overflow: hidden; border-radius: .25rem .25rem 0 0;
        }
        .chat-panel.open { display: block; animation: rise .25s ease; }
        .chat-log { height: 240px; overflow: auto; padding: .9rem; background: var(--panel); }
        .bubble { margin: .4rem 0; padding: .65rem .75rem; border-radius: .35rem; max-width: 90%; font-size: .9rem; line-height: 1.4; }
        .bubble.bot { background: #fff; border: 1px solid rgba(15,28,36,.08); }
        .bubble.user { background: var(--ink); color: #fff; margin-left: auto; }
        .chat-form { display: flex; gap: .4rem; padding: .65rem; }
        .chat-form input { flex: 1; }
        @keyframes rise { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: none; } }
        @keyframes grow { from { transform: scaleY(.2); transform-origin: bottom; } to { transform: scaleY(1); } }
        @keyframes pulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.05); } }
        @media (max-width: 900px) {
            .grid-3, .grid-2, .dash-preview { grid-template-columns: 1fr; }
            .nav-links { display: none; }
            .hero { min-height: 78vh; }
        }
    </style>
    @stack('head')
</head>
<body>
<header class="site-header">
    <div class="wrap nav">
        <a class="brand" href="{{ route('home') }}">Sweep<span>Forge</span></a>
        <nav class="nav-links">
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('blog') }}">Blog</a>
            <a href="{{ route('knowledge') }}">Knowledge</a>
            <a href="{{ route('contact') }}">Contact</a>
            <a class="btn btn-primary" href="{{ route('contact') }}">Free Site Walk</a>
        </nav>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer class="site-footer">
    <div class="wrap">
        <div class="brand">Sweep<span>Forge</span> Site Cleanup</div>
        <p>Dallas · Fort Worth · Plano · Arlington · Frisco — construction site cleanup & debris hauling.</p>
        <p style="margin-top:1rem;font-size:.9rem;">(214) 555-0187 · hello@sweepforgesite.com · <a href="/admin" style="color:var(--accent)">Admin ERP</a></p>
    </div>
</footer>

<a class="wa-float" href="https://wa.me/12145550187" target="_blank" rel="noopener" aria-label="WhatsApp">WA</a>

<div class="chat-widget" id="sf-chat">
    <div class="chat-panel" id="chat-panel">
        <div class="chat-log" id="chat-log">
            <div class="bubble bot">Hi — ask SweepForge about final sweeps, debris hauling, slurry cleanup, progressive cleans, or scheduling a DFW site walk.</div>
        </div>
        <form class="chat-form" id="chat-form">
            <input type="text" id="chat-input" placeholder="Ask about site cleanup…" required maxlength="2000">
            <button class="btn btn-primary" type="submit">Send</button>
        </form>
    </div>
    <button class="chat-toggle" type="button" id="chat-toggle">AI Cleanup Assistant</button>
</div>

<script>
(() => {
    const panel = document.getElementById('chat-panel');
    const toggle = document.getElementById('chat-toggle');
    const form = document.getElementById('chat-form');
    const input = document.getElementById('chat-input');
    const log = document.getElementById('chat-log');
    const sessionId = 'sf-' + Math.random().toString(36).slice(2);
    toggle.addEventListener('click', () => panel.classList.toggle('open'));
    const add = (text, who) => {
        const el = document.createElement('div');
        el.className = 'bubble ' + who;
        el.textContent = text;
        log.appendChild(el);
        log.scrollTop = log.scrollHeight;
    };
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = input.value.trim();
        if (!message) return;
        add(message, 'user');
        input.value = '';
        try {
            const res = await fetch(@json(route('ai.chat')), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ message, session_id: sessionId }),
            });
            const data = await res.json();
            add(data.reply || 'Something went wrong.', 'bot');
        } catch (err) {
            add('Network error — please try again or call (214) 555-0187.', 'bot');
        }
    });
})();
</script>
@stack('scripts')
</body>
</html>
