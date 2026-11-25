<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\KnowledgeArticle;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'manager', 'staff'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '(214) 555-0100',
            ]
        );
        $admin->syncRoles(['admin']);

        User::query()->updateOrCreate(
            ['email' => 'manager@sweepforgesite.com'],
            [
                'name' => 'Jordan Hale',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => '(214) 555-0101',
            ]
        )->syncRoles(['manager']);

        User::query()->updateOrCreate(
            ['email' => 'crew@sweepforgesite.com'],
            [
                'name' => 'Marcus Reed',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => '(214) 555-0102',
            ]
        )->syncRoles(['staff']);

        $settings = [
            'company_name' => 'SweepForge Site Cleanup',
            'company_phone' => '(214) 555-0187',
            'company_email' => 'hello@sweepforgesite.com',
            'whatsapp' => '12145550187',
            'service_area' => 'Dallas, Fort Worth, Plano, Arlington, Frisco & DFW metro',
            'tax_rate' => '8.25',
        ];
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }

        $products = [
            ['name' => 'Contractor Trash Bags (50 ct)', 'sku' => 'SCS-BAG-50', 'category' => 'consumable', 'unit_cost' => 18, 'unit_price' => 36, 'stock_qty' => 140],
            ['name' => 'Industrial Broom / Dustpan Kit', 'sku' => 'SCS-BROOM-1', 'category' => 'equipment', 'unit_cost' => 22, 'unit_price' => 45, 'stock_qty' => 48],
            ['name' => 'HEPA Shop Vac Filters (pack)', 'sku' => 'SCS-HEPA-3', 'category' => 'equipment', 'unit_cost' => 28, 'unit_price' => 58, 'stock_qty' => 36],
            ['name' => 'Roll-Off Dumpster Day (20 yd)', 'sku' => 'SCS-RO-20', 'category' => 'haul', 'unit_cost' => 210, 'unit_price' => 420, 'stock_qty' => 12],
            ['name' => 'Scrap Metal Magnet Sort Kit', 'sku' => 'SCS-MAG-1', 'category' => 'recycle', 'unit_cost' => 65, 'unit_price' => 120, 'stock_qty' => 18],
            ['name' => 'Slurry Solidifier Bags (25 lb)', 'sku' => 'SCS-SLURRY-25', 'category' => 'slurry', 'unit_cost' => 32, 'unit_price' => 68, 'stock_qty' => 55],
            ['name' => 'Floor Protection Board (sheet)', 'sku' => 'SCS-PROT-1', 'category' => 'consumable', 'unit_cost' => 12, 'unit_price' => 26, 'stock_qty' => 200],
            ['name' => 'Crew Day Progressive Clean', 'sku' => 'SCS-CREW-DAY', 'category' => 'labor', 'unit_cost' => 480, 'unit_price' => 960, 'stock_qty' => 30],
        ];
        foreach ($products as $product) {
            Product::query()->updateOrCreate(['sku' => $product['sku']], $product + ['unit' => 'ea', 'is_active' => true]);
        }

        $customers = collect([
            ['name' => 'Elena Vasquez', 'email' => 'elena@summitbuildtx.com', 'phone' => '(214) 555-4401', 'company' => 'Summit Build TX', 'city' => 'Dallas', 'state' => 'TX', 'zip' => '75201', 'address' => '1401 Main St'],
            ['name' => 'Noah Briggs', 'email' => 'noah@briggsgc.com', 'phone' => '(817) 555-4410', 'company' => 'Briggs General Contracting', 'city' => 'Fort Worth', 'state' => 'TX', 'zip' => '76102', 'address' => '301 Commerce St'],
            ['name' => 'Aisha Rahman', 'email' => 'ops@northstar-ti.com', 'phone' => '(972) 555-4499', 'company' => 'Northstar TI', 'city' => 'Plano', 'state' => 'TX', 'zip' => '75024', 'address' => '5700 Granite Pkwy'],
            ['name' => 'Cole Whitaker', 'email' => 'cole.whitaker@example.com', 'phone' => '(469) 555-4188', 'company' => null, 'city' => 'Frisco', 'state' => 'TX', 'zip' => '75034', 'address' => '88 Cottonwood Ln'],
            ['name' => 'Priya Nair', 'email' => 'priya@arlingtonlofts.com', 'phone' => '(817) 555-4177', 'company' => 'Arlington Lofts', 'city' => 'Arlington', 'state' => 'TX', 'zip' => '76010', 'address' => '200 E Abram St'],
        ])->map(fn ($c) => Customer::query()->updateOrCreate(['email' => $c['email']], $c));

        $projects = [
            ['customer' => 0, 'title' => 'Downtown TI final construction sweep', 'service_type' => 'final_sweep', 'status' => 'scheduled', 'sq_ft' => 18000, 'quoted_amount' => 9200],
            ['customer' => 1, 'title' => 'Mid-rise progressive clean package', 'service_type' => 'progressive', 'status' => 'in_progress', 'sq_ft' => 42000, 'quoted_amount' => 28600],
            ['customer' => 2, 'title' => 'Office build-out debris haul + recycle', 'service_type' => 'haul', 'status' => 'quoted', 'sq_ft' => 9500, 'quoted_amount' => 6400],
            ['customer' => 3, 'title' => 'Garage pour slurry & track-out cleanup', 'service_type' => 'slurry', 'status' => 'completed', 'sq_ft' => 4200, 'quoted_amount' => 3800, 'final_amount' => 4100],
            ['customer' => 4, 'title' => 'Post-demo lot clearing for multifamily', 'service_type' => 'demo_clear', 'status' => 'invoiced', 'sq_ft' => 28000, 'quoted_amount' => 15400, 'final_amount' => 16150],
        ];

        $projectModels = [];
        foreach ($projects as $i => $p) {
            $customer = $customers[$p['customer']];
            $projectModels[] = Project::query()->updateOrCreate(
                ['job_number' => 'JOB-26'.str_pad((string) ($i + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $customer->id,
                    'title' => $p['title'],
                    'service_type' => $p['service_type'],
                    'status' => $p['status'],
                    'sq_ft' => $p['sq_ft'],
                    'quoted_amount' => $p['quoted_amount'],
                    'final_amount' => $p['final_amount'] ?? null,
                    'start_date' => now()->subDays(10 - $i)->toDateString(),
                    'site_address' => trim(($customer->address ?? '').', '.$customer->city.', '.$customer->state),
                    'notes' => 'Seeded demo job for SweepForge ERP.',
                ]
            );
        }

        foreach ([0, 1, 3, 4] as $idx) {
            $project = $projectModels[$idx];
            $invoice = Invoice::query()->updateOrCreate(
                ['invoice_number' => 'INV-26'.str_pad((string) ($idx + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $project->customer_id,
                    'project_id' => $project->id,
                    'issue_date' => now()->subDays(8 - $idx)->toDateString(),
                    'due_date' => now()->addDays(14)->toDateString(),
                    'subtotal' => $project->final_amount ?? $project->quoted_amount,
                    'tax' => round(($project->final_amount ?? $project->quoted_amount) * 0.0825, 2),
                    'total' => round(($project->final_amount ?? $project->quoted_amount) * 1.0825, 2),
                    'amount_paid' => in_array($project->status, ['completed', 'invoiced'], true) ? round(($project->final_amount ?? $project->quoted_amount) * 1.0825, 2) : 0,
                    'status' => in_array($project->status, ['completed', 'invoiced'], true) ? 'paid' : 'sent',
                ]
            );

            if ($invoice->status === 'paid') {
                Payment::query()->updateOrCreate(
                    ['reference' => 'PMT-'.$invoice->invoice_number],
                    [
                        'invoice_id' => $invoice->id,
                        'amount' => $invoice->total,
                        'paid_at' => now()->subDays(3)->toDateString(),
                        'method' => 'card',
                        'notes' => 'Demo payment',
                    ]
                );
            }
        }

        Appointment::query()->updateOrCreate(
            ['title' => 'Site walk — Summit TI final sweep'],
            [
                'customer_id' => $customers[0]->id,
                'project_id' => $projectModels[0]->id,
                'type' => 'site_visit',
                'starts_at' => now()->addDays(2)->setTime(9, 0),
                'ends_at' => now()->addDays(2)->setTime(10, 0),
                'status' => 'scheduled',
                'location' => $customers[0]->address,
            ]
        );
        Appointment::query()->updateOrCreate(
            ['title' => 'Progressive clean — Briggs mid-rise'],
            [
                'customer_id' => $customers[1]->id,
                'project_id' => $projectModels[1]->id,
                'type' => 'install',
                'starts_at' => now()->addDays(4)->setTime(6, 30),
                'ends_at' => now()->addDays(4)->setTime(15, 0),
                'status' => 'confirmed',
                'location' => $customers[1]->address,
            ]
        );

        $posts = [
            [
                'title' => 'Why Final Sweeps Fail When Trades Overlap',
                'excerpt' => 'Punch-list broom-clean only sticks when flooring, paint, and HVAC are sequenced — not when everyone re-trashes the floor.',
                'cover' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1400&q=80',
                'body' => "A final construction sweep is not magic. If painters return after the mop pass or MEP cuts open walls again, the owner walkthrough still looks unfinished.\n\nSweepForge locks a clean window with the GC, protects finished floors, and documents remaining trade punch so the broom-clean sticks. Book the final sweep after major dust-making trades — not before.",
            ],
            [
                'title' => 'Diversion Rates That Survive an Audit',
                'excerpt' => 'Haul tickets and labeled bins beat estimated percentages when LEED reviewers ask for proof.',
                'cover' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b4bd?auto=format&fit=crop&w=1400&q=80',
                'body' => "Guessing that fifty percent went to recycling is how projects fail audits. SweepForge stages metal, cardboard, and clean wood separately, trains site stewards, and files haul tickets against the job in the ERP.\n\nAsk for diversion reports when you award progressive clean packages — especially on municipal and corporate TI work.",
            ],
            [
                'title' => 'Slurry Cleanup Before It Becomes Concrete',
                'excerpt' => 'Pour-day residue hardens overnight. Sidewalks, drains, and neighbor relations pay the price.',
                'cover' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=1400&q=80',
                'body' => "Wet sawing and slab pours leave slurry that stains sidewalks and clogs storm drains. SweepForge scrapes, solidifies where required, and recovers solids for proper disposal the same day.\n\nIf track-out is already hard, stop pressure-washing into the gutter — call for a recovery plan that protects stormwater compliance.",
            ],
        ];
        foreach ($posts as $post) {
            Post::query()->updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'body' => $post['body'],
                    'cover_image' => $post['cover'],
                    'is_published' => true,
                    'published_at' => now()->subDays(random_int(2, 20)),
                ]
            );
        }

        $articles = [
            ['category' => 'issues', 'title' => 'Nail droppings after framing', 'body' => "1. Magnet-sweep corridors and stairs before the next trade arrives.\n2. Bag and label scrap for metal diversion.\n3. Check elevator landings and staging rooms.\n4. Log the progressive clean in the job notes so the GC can verify cadence."],
            ['category' => 'issues', 'title' => 'Owner walkthrough fails broom-clean', 'body' => "Confirm whether trades returned after the final sweep. Re-protect floors, re-dust millwork and HVAC returns, and haul leftover packaging. SweepForge documents the clean window so change-order re-cleans are billable."],
            ['category' => 'guides', 'title' => 'Final construction sweep day timeline', 'body' => "Morning: Stage bags, floor protection, and HEPA vacs; walk with GC punch list.\nMidday: Dust top-down, vacuum returns, scrub mud tracks, haul scrap.\nAfternoon: Detail glass, fixtures, and entries; photo handoff.\nCloseout: Care notes, diversion tickets, ERP status to completed."],
            ['category' => 'guides', 'title' => 'How to prepare for a free site walk', 'body' => "Share floor plans or SF estimates, access hours, dumpster location, and diversion requirements. Note slurry or demo debris if present. SweepForge measures scope, crew-days, and roll-off needs on site."],
            ['category' => 'admin', 'title' => 'Admin ERP quick start', 'body' => "Login at /admin with admin@example.com / password.\n1. Add customers in CRM.\n2. Create a Job/Project with cleanup type and quote.\n3. Schedule site walks and clean days.\n4. Convert completed jobs to invoices and record payments.\n5. Use AI Studio for blog drafts and troubleshooting.\n6. Update Settings for phone, WhatsApp, and tax rate."],
            ['category' => 'admin', 'title' => 'Roles: Admin, Manager, Staff', 'body' => "Admin: full ERP + settings + users.\nManager: jobs, inventory, invoices, scheduling.\nStaff: field-facing records and appointment updates.\nAssign roles on the Users resource."],
            ['category' => 'troubleshoot', 'title' => 'Job over dumpster estimate', 'body' => "Check actual debris volume vs quote, contaminated loads, and after-hours pulls. Log extra roll-offs on job notes, create a change-order invoice line, and update inventory stock."],
            ['category' => 'troubleshoot', 'title' => 'Chatbot giving demo answers only', 'body' => "Demo mode is expected without API keys. Add OPENAI_API_KEY or GEMINI_API_KEY to .env, then clear config cache. The public chatbot and AI Studio will prefer live models when keys are present."],
        ];
        foreach ($articles as $article) {
            KnowledgeArticle::query()->updateOrCreate(
                ['slug' => Str::slug($article['title'])],
                [
                    'title' => $article['title'],
                    'category' => $article['category'],
                    'body' => $article['body'],
                    'is_published' => true,
                ]
            );
        }
    }
}
