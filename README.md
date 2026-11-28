# SweepForge Site Cleanup

Full-stack business platform for a site cleanup service company — public website, Filament admin ERP, knowledge base, and AI assistants in one Laravel app.

## Features

### Public website
- Marketing home with hero, services, about, and contact
- Dedicated service pages for the site cleanup service offer set
- Blog / journal with seeded posts
- Knowledge base (common issues, guides, admin notes, troubleshooting)
- Contact form that saves leads to the database
- Floating WhatsApp button
- Public AI chatbot (FAQ-trained; live API when keys are set)

### Admin ERP (`/admin`)
- Customers / clients
- Jobs / projects / orders
- Inventory & products
- Invoices & payments
- Appointments / scheduling
- Roles: Admin, Manager, Staff (Spatie Permission)
- Reports dashboard with stats and charts
- Company settings
- AI Studio: content drafts, automation ideas, troubleshooting help
- Seeded demo data for a complete walkthrough

### AI
- Public chatbot widget
- Admin content generator
- Automation suggestions panel
- Troubleshooting assistant
- OpenAI or Gemini via HTTP — FAQ demo mode when keys are empty

## Technology

| Layer | Stack |
|-------|--------|
| Backend | Laravel 13, PHP 8.3+ |
| Admin | Filament 3 |
| UI | Livewire, Alpine.js, Tailwind CSS |
| Auth / roles | Spatie Laravel Permission |
| Database | MySQL or SQLite (local demo) |
| AI | OpenAI / Gemini REST (`App\Services\AiService`) |
| Tooling | Composer, Vite, Artisan |

## Getting started

```bash
git clone https://github.com/imranbru99/site-cleanup-service.git
cd site-cleanup-service
composer install
cp .env.example .env
php artisan key:generate
# SQLite demo: create database/database.sqlite if needed
php artisan migrate --seed
php artisan serve
```

| Surface | URL |
|---------|-----|
| Public site | http://localhost:8000 |
| Admin | http://localhost:8000/admin |

**Demo login:** `admin@example.com` / `password`

Optional in `.env`:

```
OPENAI_API_KEY=
OPENAI_MODEL=gpt-4o-mini
GEMINI_API_KEY=
GEMINI_MODEL=gemini-1.5-flash
```

## Screenshots

![Construction site cleanup](https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1200&q=80)

![Interior build-out ready for final sweep](https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1200&q=80)

![Jobsite debris and heavy construction](https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1200&q=80)

![Recycling and diversion staging](https://images.unsplash.com/photo-1532996122724-e3c354a0b4bd?auto=format&fit=crop&w=1200&q=80)

## Live demo

Deploy to Forge, Vapor, or any PHP 8.3+ host, then replace this section with your public URL.

---

## 🤝 Let's Connect & Collaborate
I am open to Senior Remote Full-Stack Roles, AI Platform Architecture Contracts, and Enterprise Technical Advisory.
Timezone: UTC+6 (Dhaka / Rangpur, Bangladesh) — Flexible overlap with US, UK, and European business hours.
Delivery Mode: Async-ready, Slack, Discord, Jira, GitHub, and production-first accountability.

| Channel | Address / Handle | Quick Action |
|---------|------------------|--------------|
| 🌐 Primary Portfolio | imrandev.bd | Visit Site ↗ |
| 📦 Packagist Packages | packagist.org/packages/imrandevbd/ | View Packages ↗ |
| 💼 LinkedIn Profile | linkedin.com/in/imranbru99 | Connect ↗ |
| 🐙 GitHub Profile | github.com/imranbru99 | Follow ↗ |
| 💬 WhatsApp Direct | +880 1576-918420 | Chat Now ↗ |
| 📧 Direct Email | me@imrandev.bd | Send Email ↗ |
| 🐦 X (Twitter) | @imrandev_bd | Follow ↗ |
| 📺 YouTube Tech | @ImranDevBD | Subscribe ↗ |

