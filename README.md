# Himalaya Trails (Laravel 12)

A trekking website where **everything is dynamic**: treks, photos, departures, banner slides, reviews,
updates and articles, FAQ, numbers, categories and contact details all come from the database and are
edited in the **admin panel**. It has login, sign up, saved treks and an enquiry form that saves to the database.

## 1. Run it (5 steps)

You need **PHP 8.2+** and **Composer**. Open a terminal inside this folder:

```bash
composer install
copy .env.example .env          # Mac/Linux: cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Open http://127.0.0.1:8000

* `composer install` may print "lock file is not up to date". That is only a warning, you can ignore it.
* `migrate:fresh --seed` creates all tables and fills the site with sample content.
  It **deletes** any older data in `database/database.sqlite`. This is what you want when moving from the earlier zip.
* The database is SQLite (the file `database/database.sqlite`). To use MySQL, edit the `DB_*` lines in `.env`.
* The page style uses the Tailwind CDN script, so the browser needs internet.

## 2. Admin panel

Open http://127.0.0.1:8000/login and sign in with

```
admin@example.com
password
```

You are taken to **/admin**. Change this password first (account page, or make a new admin in Users).

| Admin menu | What it controls on the website |
| --- | --- |
| Treks | Trek cards, trek pages, photos (many at once), itinerary, inclusions, price, badge, rating, themes, interest, experiences, and fixed departures (dates) |
| Regions | Region filter buttons, their photo, and the Country filter |
| Home banner | The big sale-style slider: background photo, sale text (for example Winter Treks / Sale / 2026), button, price line and small note |
| Reviews | "What Trekkers Say" carousel and the average rating |
| Updates and articles | "Stay informed" cards. Each one opens its own page with the full text |
| FAQ tabs / FAQ questions | The FAQ section |
| Numbers / Why us points | "Why Trek With Us" cards |
| Enquiries | Everything people send from the contact form, with a "reply by email" button |
| Users | Members, and who is an admin |
| Site settings | Phone, email, address, hours, WhatsApp number, footer text |

Text lists (highlights, itinerary, inclusions...) use **one item per line**. "Best months" uses the form
`Mar to May, Oct to Nov` and is used for the month filter, the month category pages, the fixed departure
months and the moving text at the top.

## 3. What is on the website

* **Header.** Search box, a red **Choose Trek** dropdown (trek by name with live search, months, region, country, season,
  grade) and Login / Sign up. On phones the search box sits on its own row.
* **Sale banner.** Every slide is a winter sale slide: a photo with text written on top of it. The sale text, button, "Starts from" price and
  note are all edited in Admin > Home banner. The price line stays hidden until you type a real price.
* **Menu hover effect.** Red lines slide in and the menu link fills with red (see `.nav-fx` in `public/css/style.css`).
* **Moving text strip at the top.** It changes with the season (Winter, Spring, Summer, Monsoon, Autumn) and lists the treks
  that are open in the current month, with a link to that season's page.
* **Plan your next adventure.** A carousel of filter buttons (seasons, regions with photos, months) and a filter icon that opens a
  big panel: Upcoming Treks, Country, Season, Region, Month, Difficulty, Interests, Theme.
* **Trek cards.** Region badge on the photo (left), heart (right) to save a trek (login needed), and "View Trek Details".
* **Trek page** (`/treks/kedarkantha`) has two sections: on the left the photo gallery banner, quick facts, tab strip, overview,
  itinerary, Fixed Departures (all months), gallery, inclusions, essentials and cancellation; on the right a booking box (price, Enquire,
  Call, WhatsApp, next batches) that stays in view. "Similar Trek" comes at the bottom. The "Treks by Categories" block is not shown on detail pages.
* **Category pages and update pages** also have two sections (list on the left, categories or related reads on the right).
* **Search page** `/search?q=...` shows the results of the header search box.
* **Admin panel** shows the website header and footer too.
* **Stay informed.** Click a card to open the update or article.
* **Treks by Categories** (above the footer). Month, Difficulty, Experience, Season, Duration and Region.
  Every item has its own page, for example `/category/season/winter`, `/category/month/may`,
  `/category/difficulty/easy`, `/category/region/uttarakhand`, `/category/duration/5-days`.
  All categories on one page: `/categories`.
* **Login / Sign up / My account.** Saved treks, my enquiries, change name, email and password.

## 4. Sample content

The photos are yours. The numbers, reviews, update and article texts, FAQ answers, phone, email, fixed departure dates,
themes and experiences are **sample** values made to show how the site works. Replace them in the admin panel.
Rating and badge on a trek are empty on purpose: fill them only when they are real.

## 5. Folder guide

```
app/Http/Controllers        public pages (Home, Trek, Category, Post, Auth, Account, Enquiry)
app/Http/Controllers/Admin  admin panel
app/Models                  Trek, Region, Review, Post, Faq...
app/Support/Categories.php  category lists, category pages, season text
database/migrations         tables
database/seeders           sample content (data.json holds the text)
resources/views             pages (Blade)
public/js home.js trek.js site.js   browser behaviour
public/images               seeded photos, public/uploads has photos you upload in admin
routes/web.php              all addresses
```
