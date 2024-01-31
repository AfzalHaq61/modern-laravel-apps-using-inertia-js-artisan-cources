Video 1 (What is Inertia.js)

----------------------------------------------------------------

Definition:

connection between server side and client side.
no need of api
glue between them
not a framework just a client side routing library
routing work like server web routing.
its fast. single page app no need to render css, js file again and again just take it one time and then pass ajax requ and get content in response and render it.

Inertia is a new approach to building classic server-driven web apps. We call it the modern monolith.

Inertia allows you to create fully client-side rendered, single-page apps, without the complexity that comes with modern SPAs. It does this by leveraging existing server-side patterns that you already love.

Inertia has no client-side routing, nor does it require an API. Simply build controllers and page views like you've always done! Inertia works great with any backend framework, but it's fine-tuned for Laravel.

Not a framework
Inertia isn't a framework, nor is it a replacement for your existing server-side or client-side frameworks. Rather, it's designed to work with them. Think of Inertia as glue that connects the two. Inertia does this via adapters. We currently have three official client-side adapters (React, Vue, and Svelte) and two server-side adapters (Laravel and Rails).

----------------------------------------------------------------

Video 3 (Pages)

// we were rendering views in server side like this in simple laravel.
return view('welcome');

// or

return View::make('welcome');

// but when we use inertia and we have to render client side page then we can render it like this.
// here we use inertia helper function
// the name of the file will be start from capital letter
return inertia('Welcome');

// or 

// like this
// here we have to import inetrtia.
Route::get('/', function () {
    return Inertia::render('Home', [
        'name' => 'Jeffrey Way',
        'frameworks' => [
            'Laravel', 'Vue', 'Inertia'
        ]
    ]);
});

----------------------------------------------------------------
