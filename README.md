# Tīmekļa vietnes uzraudzības pakalpojums “WEBcheck”

## Projekta apraksts
PIKC “Rīgas Valsts tehnikums” Kvalifikācijas darba repozitorijs. Uzraudzības pakalpojums, kas ļauj pārbaudīt
jūsu tīmekļa vietnes statistiku, ka piemēram: pingu, atbildes laiku, SSL sertifikācijas pārbaudi un daudzas citas funkcionalitātes. 
Lietotāja/administratora/viesa autentifikācija un pārvaldības sistēma.

## Ko esmu paveicis šaja projektā
 - Projekta pamatus – noklusējuma kontrolierus, modeļus un migrācijas
 - Valodas (angļu, latviešu un krievu)
 - Kontaktu sadaļu (viesu pusē)
 - Navigācijas un kājenes joslas (viesu, lietotāja administratora un administratora pusē)
 - Visu administratora pusi
 - Iespēju apmaksāt/mainīt/atcelt abonementa plānus izmantojot "Stripe payment"
 - E-pasta izsutīšana pēc noteiktām darbībām

## Saturs
 - [Versijas](#versijas)
 - [Izmantotās tehnoloģijas](#izmantotās-tehnoloģijas)
 - [Prasības](#prasības)
 - [Instalācija](#instalācija)
   - [Klonešana](#klonešana)
   - [Uzstādīšana](#uzstādīšana)
 - [Kopējie izmantotie avoti](#kopējie-izmantotie-avoti)
 - [Mani izmantotie avoti](#mani-izmantotie-avoti)

## Versijas
 - Php: **^7.3.21**
 - Apache **2.4.46**
 - Phpmyadmin **5.0.2**
 - Mysql **5.7.31**
 - Zabbix: **5**
 - CentOS **8**
 - Laravel **7.24**
 - Adminlte **^3.5**
 - npm **^6.14.8**
 - Laratrust **^6.2**
 - Stripe **^7.75**
 - Cashier **^12.9**
 - Hashids **^4.0**
 - Phpunit **^8.5**
 - Faker **^1.9.1**

## Izmantotās tehnoloģijas
Valodas:
- [HTML](https://en.wikipedia.org/wiki/HTML)
- [PHP](https://en.wikipedia.org/wiki/PHP)
- [JavaScript](https://en.wikipedia.org/wiki/JavaScript)
- [CSS](https://en.wikipedia.org/wiki/CSS)
- [XML](https://en.wikipedia.org/wiki/XML)
- [Blade](https://laravel-guide.readthedocs.io/en/latest/blade/)
- [JSON](https://en.wikipedia.org/wiki/JSON)
- [SCSS](https://en.wikipedia.org/wiki/Sass_(stylesheet_language))
- [Markdown](https://en.wikipedia.org/wiki/Markdown)

Ietvari:
- [Laravel](https://en.wikipedia.org/wiki/Laravel)

Serveri:
- [Zabbix](https://en.wikipedia.org/wiki/Zabbix) ir uzstadīts uz [CentOS](https://en.wikipedia.org/wiki/CentOS) virtuālās kastes

Tīmekļa serveri:
- [Apache](https://en.wikipedia.org/wiki/Apache_HTTP_Server)

Tīmekļa pielikuma rīki:
- [Phpmyadmin](https://en.wikipedia.org/wiki/PhpMyAdmin)

Relāciju datubāzu pārvaldības sistēmas:
- [Mysql](https://en.wikipedia.org/wiki/MySQL)

Administratora informācijas panelis un vadības paneļi:
- [Adminlte](https://adminlte.io/)

Pakotņu pārvaldnieki:
- [npm](https://en.wikipedia.org/wiki/Npm_(software))

JavaScript bibliotēka datu vizualizēšanai:
- [Chart.js](https://www.chartjs.org/)

Finanšu pakalpojumi un programmatūras:
- [Stripe](https://stripe.com/en-lv)

Citi:
- [Laratrust](https://laratrust.santigarcor.me)
- [Cashier](https://laravel.com/docs/master/billing)
- [Hashids](https://hashids.org) 
- [Phpunit](https://phpunit.de)
- [Faker](https://github.com/fzaninotto/Faker)

## Prasības
Lai palaistu šo kvalifikācijas darbu, ir jābūt:

1. WampServer var lejupielādēt [šeit](https://www.wampserver.com/en/#download-wrapper)
2. Composer var lejupielādēt [šeit](https://getcomposer.org/download/)
3. npm var lejupielādēt [šeit](https://www.npmjs.com/get-npm)
3. Git Bash var lejupielādēt [šeit](https://git-scm.com/downloads)

## Instalācija

### Klonešana
Klonēt šo repozitoriju uz vietējo datoru, izmantojot `https://github.com/rvtprog-kval-21/...`

```bash
git clone https://github.com/rvtprog-kval-21/...
cd monitoring-project
```

### Uzstādīšana
Skripts, kas palaiž visas nepieciešāmās komandas
```bash
composer run-script start-project
```

Pievienot datubāzi ar nosaukumu - monitoring_project

Pēc datubāzes pievienošanas, izmantojiet šo komandu, kas izveidos tabulas ar pirmstam izveidotiem datiem
```bash
php artisan migrate:fresh --seed
```

Pievienot pie .env faila savus vidē mainīgos un palaist komandu
```bash
php run-script clear-project-cache
```

Palaist projektu lokālajā datorā
```bash
php artisan serve
```

Vajadzētu parādīt šo ziņojumu pēc darbības **'php artisan serve'** ja viss ir veiksmīgi izdarīts

```bash
Laravel development server started: http://127.0.0.1:8000
[Mon Oct  5 14:46:45 2020] PHP 7.4.3 Development Server (http://127.0.0.1:8000) started
```

## Kopējie izmantotie avoti
- HTML
    - https://www.w3schools.com/html/
    - https://html.com/
    - https://developer.mozilla.org/en-US/docs/Web/HTML
    - https://fontawesome.com/
- PHP
    - https://www.php.net/
    - https://www.w3schools.com/php/DEFAULT.asp
    - https://www.tutorialspoint.com/php/index.htm
    - https://phptherightway.com/
- JavaScript
    - https://www.javascript.com/
    - https://www.w3schools.com/js/DEFAULT.asp
    - https://developer.mozilla.org/en-US/docs/Web/JavaScript
- CSS
    - https://www.w3schools.com/css/
    - https://www.w3schools.com/css/css_intro.asp
    - https://css-tricks.com/
    - https://fonts.google.com/
    - https://getbootstrap.com/
- XML
    - https://www.w3schools.com/xml/
    - https://www.w3schools.com/xml/xml_whatis.asp
- Blade
    - https://laravel.com/docs/7.x/blade
    - https://www.tutorialspoint.com/laravel/laravel_blade_templates.htm
    - https://laravel-guide.readthedocs.io/en/latest/blade/
    - https://www.w3adda.com/laravel-tutorial/laravel-blade-template
- JSON
    - https://www.json.org/json-en.html
    - https://www.w3schools.com/js/js_json_intro.asp
    - https://www.w3schools.com/whatis/whatis_json.asp
- SCSS
    - https://sass-lang.com/
    - https://stackoverflow.com/questions/5654447/whats-the-difference-between-scss-and-sass
    - https://www.sassmeister.com/
- Markdown
    - https://daringfireball.net/projects/markdown/syntax
    - https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet
    - https://guides.github.com/features/mastering-markdown/
    - https://www.markdownguide.org/
- Laravel
    - https://laravel.com/
    - https://github.com/laravel/laravel
    - https://www.tutorialspoint.com/laravel/laravel_overview.htm
- Zabbix
    - https://www.zabbix.com/
    - https://github.com/becker/laravel-zabbix-api
- CentOS
    - https://www.centos.org/
    - https://www.zdnet.com/article/red-hats-centos-8-arrives-heres-what-you-get-with-it/
    - https://linux.web.cern.ch/centos8/
- Apache
    - https://httpd.apache.org/
    - https://www.apache.org/
    - https://www.wpbeginner.com/glossary/apache/
- Phpmyadmin
    - https://www.phpmyadmin.net/
    - https://locallhost.me/phpmyadmin
    - https://wiki.archlinux.org/index.php/phpMyAdmin
- Mysql
    - https://www.mysql.com/
    - https://www.w3schools.com/php/php_mysql_intro.asp
    - https://www.tutorialspoint.com/mysql/index.htm
- Adminlte
    - https://adminlte.io/
    - https://github.com/ColorlibHQ/AdminLTE
    - https://github.com/jeroennoten/Laravel-AdminLTE/#611-menu
- npm
    - https://www.npmjs.com/
    - https://www.w3schools.com/whatis/whatis_npm.asp
    - https://devdocs.io/npm/
- Chart.js
    - https://www.chartjs.org/
    - https://github.com/chartjs
    - https://medium.com/javascript-in-plain-english/exploring-chart-js-e3ba70b07aa4
    - https://tobiasahlin.com/blog/chartjs-charts-to-get-you-started/
- Laratrust
    - https://laratrust.santigarcor.me
    - https://github.com/santigarcor/laratrust
    - https://packagist.org/packages/santigarcor/laratrust
- Stripe
    - https://stripe.com
    - https://en.wikipedia.org/wiki/Stripe_(company)
    - https://twitter.com/stripe
- Cashier
    - https://laravel.com/docs/8.x/billing
    - https://github.com/laravel/cashier-stripe
- Hashids
    - https://hashids.org
    - https://github.com/vinkla/hashids
    - https://www.npmjs.com/package/hashids
- Phpunit
    - https://phpunit.de
    - https://github.com/sebastianbergmann/phpunit
    - https://laravel.com/docs/8.x/testing
- Faker
    - https://github.com/fzaninotto/Faker
    - https://laravel-news.com/changes-coming-to-php-faker
    
## Manus izmantotos avotus var redzēt dokumentācijas mapē
