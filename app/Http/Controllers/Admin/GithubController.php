<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GithubController extends Controller
{
    function fetchRepos()
    {
        $username = 'danilosalerno';

        $response = Http::withoutVerifying()->get("https://api.github.com/users/{$username}/repos?per_page=100&sort=created");

        if ($response->successful()) {

            $repositories  = $response->json();

            //dd($response->json());

            foreach ($repositories as $repository) {

                $slug = Str::slug($repository['name']);

                $project = Project::updateOrCreate(
                    [
                        'title' => $repository['name']
                    ],
                    [
                        'slug' => $slug,
                        'description' => $repository['description'] ? $repository['description'] : 'lorem',
                        'thumb' => 'https://picsum.photos/400/600',
                        'git_url' => $repository['html_url']
                    ]
                );

                $languagesResponse = Http::withoutVerifying()->get("https://api.github.com/repos/{$username}/{$repository['name']}/languages");

                if ($languagesResponse->successful()) {

                    $languages  = $languagesResponse->json();

                    $totalSize = array_sum($languages);

                    foreach ($languages as $language => $size) {

                        $percentage = ($size / $totalSize) * 100;
                        $formattedPercentage = number_format($percentage, 2);

                        $technology = Technology::firstOrCreate(
                            ['name' => $language],
                            [
                                'slug' => Str::slug($language, '-')
                            ]
                        );

                        $project->technologies()->syncWithoutDetaching([$technology->id => ['percentage' =>  $formattedPercentage]]);
                    }

                    $project->save();
                }
            }

            return to_route('admin.projects.index')->with('message', 'Fetch Data From GitHub Successfully');
        } else {

            return response()->json(['error' => 'Errore nella richiesta API'], $response->status());
        }
    }
}
