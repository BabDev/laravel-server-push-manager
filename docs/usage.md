# Usage

## Primary Usage

The `BabDev\ServerPushManager\Contracts\PushManager::link()` method is the main method for adding a link with any set of relations and/or attributes which will be converted into an appropriate HTTP/2 `Link` response header value.

The method accepts three parameters:

- `$uri` - The URI for the resource
- `$rel` - The relations for this resource, this may be either a single string or an array of strings to specify multiple relations
- `$attributes` - An optional array of additional attributes for the resource, these are passed to the `Psr\Link\EvolvableLinkInterface::withAttribute()` method and the values should follow the specification's requirements

Note that this method returns the `$uri` passed into it, this allows you to wrap other function calls within calls to the manager (see below for an example).

## Helper Methods

The `BabDev\ServerPushManager\Contracts\PushManager` interface defines several helper methods for adding resources to a HTTP/2 `Link` response header with the appropriate relations, including:

- `preload()` - Adds the resource with the "preload" relation to the `Link` header
- `dnsPrefetch()` - Adds the resource with the "dns-prefetch" relation to the `Link` header
- `preconnect()` - Adds the resource with the "preconnect" relation to the `Link` header
- `prefetch()` - Adds the resource with the "prefetch" relation to the `Link` header
- `prerender()` - Adds the resource with the "prerender" relation to the `Link` header

Each of these methods accepts two parameters:

- `$uri` - The URI for the resource
- `$attributes` - An optional array of additional attributes for the resource, these are passed to the `Psr\Link\EvolvableLinkInterface::withAttribute()` method and the values should follow the specification's requirements

Note that each of these methods returns the `$uri` passed into the method, this allows you to wrap other function calls within calls to the manager (see below for an example).

## Within Blade Templates

You can specify which assets should have a server push directive directly within your Blade templates by calling the `PushManager` service. Because the `PushManager` returns the original URI, you can wrap calls to `asset()` or `mix()` with a call to the manager.

<div class="docs-note">The below example requires the <code>PushManager</code> facade has been registered in your application.</div>

```blade
<link href="{{ PushManager::preload(mix('css/app.css'), ['as' => 'stylesheet']) }}" rel="stylesheet">
<script src="{{ PushManager::preload(asset('js/app.js'), ['as' => 'script']) }}"></script>
```

## Within PHP classes

You can access the `PushManager` service by injecting it as a dependency to your class or controller action, through the `app()` helper using the service ID ('babdev.push_manager') or the class name, or using the facade.

```php
namespace App\Http\Controllers;

use BabDev\ServerPushManager\PushManager;
use Illuminate\Http\Request;

final class HomepageController
{
    private PushManager $pushManager;

    public function __construct(PushManager $pushManager)
    {
        $this->pushManager = $pushManager;
    }

    public function homepageWithConstructor()
    {
        $this->pushManager->preload('https://laravel.com/assets/css/laravel.css', ['as' => 'stylesheet']);

        return $this->renderHomepage();
    }

    public function homepageWithMethodInjection(Request $request, PushManager $pushManager)
    {
        $pushManager->preload('https://laravel.com/assets/css/laravel.css', ['as' => 'stylesheet']);

        return $this->renderHomepage();
    }

    public function homepageWithAppFunction()
    {
        /** @var PushManager $pushManager */
        $pushManager = app('babdev.push_manager');
        $pushManager->preload('https://laravel.com/assets/css/laravel.css', ['as' => 'stylesheet']);

        return $this->renderHomepage();
    }

    public function homepageWithFacade()
    {
        \PushManager::preload('https://laravel.com/assets/css/laravel.css', ['as' => 'stylesheet']);

        return $this->renderHomepage();
    }

    private function renderHomepage()
    {
        return view('homepage');
    }
}
```
