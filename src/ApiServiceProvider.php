<?php

namespace Streams\Api;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Streams\Core\Support\Facades\Assets;
use Streams\Api\Http\Controller\Entries\ShowEntry;
use Streams\Api\Http\Controller\EntriesController;
use Streams\Api\Http\Controller\StreamsController;
use Streams\Api\Http\Controller\Entries\GetEntries;
use Streams\Api\Http\Controller\Streams\CreateStream;
use Streams\Api\Http\Controller\Streams\DeleteStream;
use Streams\Api\Http\Controller\Streams\GetStreams;
use Streams\Api\Http\Controller\Streams\PatchStream;
use Streams\Api\Http\Controller\Streams\ShowStream;
use Streams\Api\Http\Controller\Streams\UpdateStream;

/**
 * Class ApiServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ApiServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Route::prefix('api')->middleware('api')->group(function () {

            Route::get('streams', GetStreams::class);
            Route::post('streams', CreateStream::class);

            Route::get('streams/{stream}', ShowStream::class);
            Route::put('streams/{stream}', UpdateStream::class);
            Route::patch('streams/{stream}', PatchStream::class);
            Route::delete('streams/{stream}', DeleteStream::class);

            Route::get('streams/{stream}/entries', GetEntries::class);
            Route::post('streams/{stream}/entries', EntriesController::class . '@post');

            Route::get('streams/{stream}/entries/{entry}', ShowEntry::class);
            Route::put('streams/{stream}/entries/{entry}', EntriesController::class . '@put');
            Route::patch('streams/{stream}/entries/{entry}', EntriesController::class . '@patch');
            Route::delete('streams/{stream}/entries/{entry}', EntriesController::class . '@delete');
        });
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->publishes([
            base_path('vendor/streams/api/resources/public')
            => public_path('vendor/streams/api')
        ], ['public']);

        Assets::addPath('api','vendor/streams/api');

        Assets::register('api::js/index.js');
    }
}
