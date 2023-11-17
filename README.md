# Passaggi Iniziali
- Creazione progetto
```bash
laravel new nomeprogetto

cd nomeprogetto
```
- Installazione pacchetto breeze
```bash
composer require laravel/breeze --dev

php artisan breeze:install
```

- Installazione Bootstrap e Sass
```bash
composer require pacificdev/laravel_9_preset

php artisan preset:ui bootstrap --auth

npm i

npm run dev

php artisan serve
```

- Rinomina File vite.config.js oppure eliminate "type": "module", da package.json


# Connessione al database

- Modifica in .env 
```php
FILESYSTEM_DISK=public
```


- Modifica in config/filsystems 
```php
'default' => env('FILESYSTEM_DISK', 'public'),
```

- 
```bash
php artisan storage:link
```


# 

- Cancello guest.blade.php & edit.blade.php

- Effettuo migrazione

- Creo DashboardController
```bash
php artisan make:controller Admin/DashboardController
```

- Faccio il return della view della dashboard

```php
class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}
```

- In web.php 
```php
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
```

- Modifica in RouteServiceProvider.php riga 20
```php
public const HOME = '/admin';
```

- Per andare in dashboard
```php
{{ route('admin.dashboard') }}
```

- Creazione Modello
```bash
php artisan make:model Project -a
```

- Sposto ProjectController in cartella Admin e aggiungo
```php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
```

# Migrazione e Seeder

- Aggiungo colonne alla tabella
```php
public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->unique();
            $table->text('description', 300);
            $table->string('slug');
            $table->string('thumb')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }
```

- Effettuo Migrazione 
```bash
php artisan migrate
```

- Definisco il seeder
```php
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->title = $faker->realText(50);
            $project->description = $faker->realText(100);
            $project->slug = Str::slug($project->title, '-');
            $project->thumb = 'placeholders/' . $faker->image('public/storage/placeholders', fullPath: false);
            $project->content = $faker->realText(150);
            $project->save();
        }
    }
}
```

- Modifica in DatabaseSeeder,importare ProjectSeeder
```php
$this->call([
            ProjectSeeder::class
        ]);
```

- Effettuo Seeding 
```bash
php artisan db:seed
```

# Operazioni crud