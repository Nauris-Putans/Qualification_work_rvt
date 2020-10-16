# Tīmekļa vietnes uzraudzības pakalpojums “WEBcheck”
*Lasīt šo informāciju citās valodās: [🇬🇧](README.eng.md)* 

## Projekta apraksts
PIKC “Rīgas Valsts tehnikums” Kvalifikācijas darba repozitorijs. Uzraudzības pakalpojums, kas ļauj pārbaudīt
jūsu tīmekļa vietnes statistiku - pingu, portu, atbildes laiku, SSL sertifikācijas pārbaudi un daudz ko citu. 
Lietotāja/administratora/viesa autentifikācija un pārvaldības sistēma. Ir 2 veidu konti - bezmaksas un pro.

## Ko esmu paveicis šaja projektā
 - ...
 - ...
 - ...

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
 - Php: **7.2.5**
 - Apache
 - Phpmyadmin 
 - Mysql
 - Zabbix: **5**
 - Laravel **7.24**
 - Adminlte **^3.5**
 - npm **6.14.8**
 - CentOS **8**

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

Citi:
- [Apache](https://en.wikipedia.org/wiki/Apache_HTTP_Server)
- [Phpmyadmin](https://en.wikipedia.org/wiki/PhpMyAdmin)
- [Mysql](https://en.wikipedia.org/wiki/MySQL)
- [Adminlte](https://adminlte.io/)
- [npm](https://en.wikipedia.org/wiki/Npm_(software))
- [Chart.js](https://www.chartjs.org/)

## Prasības

Lai palaistu šo kvalifikācijas darbu, ir jābūt:

1. WampServer var lejupielādēt [šeit](https://www.wampserver.com/en/#download-wrapper)
2. Composer var lejupielādēt [šeit](https://getcomposer.org/download/)
3. npm var lejupielādēt [šeit](https://www.npmjs.com/get-npm)
3. Git Bash var lejupielādēt [šeit](https://git-scm.com/downloads)

## Instalācija

### Klonešana

> Klonēt šo repozitoriju uz vietējo datoru, izmantojot `https://git01.obvius.lv:10143/mon/monitoring_project.git`

```bash
git clone https://git01.obvius.lv:10143/mon/monitoring_project.git
cd monitoring-project
```

### Uzstādīšana

> Instalēt composer priekš projekta
```bash
composer install 
```

> Ja rodas problēma, lejupielādējot composer, izmantojiet šīs komandas
```bash
composer dump-autoload
```

Vai

```bash
COMPOSER_MEMORY_LIMIT=-1 composer install
```

> Instalēt npm priekš projekta
```bash
npm install
```

> Kompilēt failus
```bash
npm run dev
```

Vai

> Kompilēt failus automātiski
```bash
npm run watch
```

> Kopē .env.example failu un ievieto ar jaunu nosaukumu - .env un ielieciet savā vidē mainīgos.
```bash
cp .env.example .env
```

> Pievienot datu bāzi ar nosaukumu - monitoring_project un izmantojiet šo komandu
```bash
php artisan migrate
```

> Komentēt arā 288,289,290 rindas no vendor/becker/laravel-zabbix-api/src/ZabbixApiAbstract.php faila
```bash
284             // validate response
285             if (!is_object($this->responseDecoded) && !is_array($this->responseDecoded)) {
286                 throw new Exception('Could not decode JSON response.');
287             }
288     //        if (array_key_exists('error', $this->responseDecoded)) {
289     //            throw new Exception('API error '.$this->responseDecoded->error->code.': '.$this->responseDecoded->error->data);
290     //        }
```

> Palaist projektu lokālajā datorā
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

## Mani izmantotie avoti
...
...
...
