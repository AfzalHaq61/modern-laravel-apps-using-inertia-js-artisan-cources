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


Video 4 (Inertia Links)

Inertia Link: Inertia Link is used instead of html anchor tags whcih used ajax process to load page work like spas.

sleep(2);

In Laravel, the sleep function is not specific to Laravel but is a part of PHP itself. The sleep function in PHP is used to pause the execution of a script for a specified number of seconds.


----------------------------------------------------------------

Video 5 (Progress Indicators)

Progress indicators
Since Inertia requests are made via XHR, there would typically not be a browser loading indicator when navigating from one page to another. To solve this, Inertia displays a progress indicator at the top of the page whenever you make an Inertia visit.

Default
Inertia's default progress indicator is a light-weight wrapper around the NProgress library. You can customize it via the progress property of the createInertiaApp() function.

createInertiaApp({
  progress: {
    // The delay after which the progress bar will appear, in milliseconds...
    delay: 250,

    // The color of the progress bar...
    color: '#29d',

    // Whether to include the default NProgress styles...
    includeCSS: true,

    // Whether the NProgress spinner will be shown...
    showSpinner: false,
  },
  // ...
})
You can disable Inertia's default loading indicator by setting the progress property to false.

createInertiaApp({
  progress: false,
  // ...
})

----------------------------------------------------------------

Video 6 (Perform Non-GET Requests)

<Link href="/logout" method="post" :data="{ foo: 'bar' }" as="button" class="text-blue-500 hover:underline">Log Out</Link>

// we can use Links for post method to pass method="post"
// but it will be still link and we can use it in another page so add as="button" then thsi link will work as a buttton.
// we can pass data in this Link like :datta"{ foo: 'bar'}"

----------------------------------------------------------------

Video 7 (Preserve the Scroll Position)

<div style="margin-top: 800px">
    <p>The current time is {{ time }}.</p>

    <Link
        href="/users"
        class="text-blue-500"
        preserve-scroll
        >
        Refresh
    </Link>
</div>

// use preserve-scroll attribute to Link elements to aboid scrolling. when you click on link then it will go to the page and move the scroller to start so wen can avoid them by this way.

now()

// it give result in this format.
"2024-02-04T11:58:08.423637Z"

now()->toTimeString()

// it give result in this format
11:59:28

----------------------------------------------------------------
