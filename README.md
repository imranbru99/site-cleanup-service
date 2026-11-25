# SweepForge Site Cleanup — Laravel 13 + Filament 3 Website, ERP & AI

Production-ready SME platform for a Dallas–Fort Worth **site cleanup service**: public marketing site, Filament admin ERP, knowledge base, and AI assistants for chat, content, automation ideas, and troubleshooting. Brand: **SweepForge Site Cleanup**.

## ✨ Features
- 🏠 Premium public site (hero, services, about, dashboard preview, contact)
- 🧹 Service detail pages for final sweeps, debris hauling, slurry removal, demo lot clearing, progressive cleans & recycle sorting
- 📰 Blog / knowledge content with seeded posts
- 📬 Contact form that stores leads in the database
- 💬 Floating WhatsApp button + public AI chatbot widget
- 🗂️ Filament ERP at `/admin` (customers, jobs, inventory, invoices, payments, appointments)
- 👥 Roles: Admin, Manager, Staff
- 📊 Reports dashboard with stats + charts
- ⚙️ Settings page for company phone, WhatsApp, tax rate, and more
- 🤖 Admin AI Studio (blog/descriptions, automation suggestions, troubleshooting)
- 📚 Knowledge base: common issues, guides, admin manual, troubleshooting
- 🌱 Realistic demo seeders for a full walkthrough

## 🛠️ Tech Stack
- Laravel 13
- Filament 3
- Livewire + Alpine.js
- Tailwind-friendly public CSS (custom SweepForge theme)
- MySQL or SQLite
- Spatie Laravel Permission
- OpenAI API with Gemini fallback keys (demo FAQ mode when keys are empty)

## 🚀 Installation
```bash
git clone https://github.com/imranbru99/site-cleanup-service.git
cd site-cleanup-service
composer install
copy .env.example .env   # Windows
php artisan key:generate
# Ensure database/database.sqlite exists for SQLite demo
php artisan migrate --seed
php artisan serve
```

Admin ERP: `http://localhost:8000/admin`  
Public site: `http://localhost:8000`

### Admin login
- Email: `admin@example.com`
- Password: `password`

Optional AI keys in `.env`:
```
OPENAI_API_KEY=
GEMINI_API_KEY=
```

For MySQL, set `DB_CONNECTION=mysql` and related credentials in `.env`, then migrate again.

## 🖼️ Screenshots / Visual Dashboard
![Construction site cleanup](https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1200&q=80)

![Interior build-out ready for final sweep](https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1200&q=80)

![Jobsite debris and heavy construction](https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1200&q=80)

![Recycling and diversion staging](https://images.unsplash.com/photo-1532996122724-e3c354a0b4bd?auto=format&fit=crop&w=1200&q=80)

## 🌐 Live Demo
Placeholder — deploy to your host and share the public URL + `/admin` demo credentials.

## 🔍 SEO-Optimized Repo Description Suggestion
`SweepForge Site Cleanup — Laravel 13 + Filament 3 website, ERP, and AI chatbot for US construction site cleanup (final sweeps, debris hauling, slurry removal, progressive cleans).`

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
