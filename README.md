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

Video 8 (Active Links)

// we can active links by this methods

// if component from $page is equal to component
$page.component === 'Home'

// if component start name from $page is equal to component start name.
$page.component.startWith('Home')

// if url from $page is equal to url
$page.url === 'Home'

// if url start name from $page is equal to url start name.
$page.url.startWith('/home');

<NavLink href="/" :active="$page.component === 'Home'">
    Home
</NavLink>

<template>
    <Link
        class="text-blue-500 hover:underline"
        :class="{'font-bold underline': active }"
    >
        <slot />
    </Link>
</template>

<script>
    import { Link } from '@inertiajs/vue3';
    export default {
        components: { Link },
        props: {
            active: Boolean
        }
    };
</script>

----------------------------------------------------------------

Video 9 (Layout Files)

We can finally move on to layout files. At the moment, every page must manually import and render the navigation section. But, clearly, this isn't ideal. Instead, let's extract a Layout file that can be responsible for all portions of the UI that should remain consistent as we browse from page to page.

In Tailwind CSS, the list utility class is used to style HTML lists. It provides a set of predefined styles for different types of lists, such as unordered lists (<ul>) and ordered lists (<ol>). Here's an overview of how the list utility works in Tailwind:

List Style Types:

list-none: Removes the default list-style (bullets or numbers) from the list.
list-disc: Adds filled circles as bullets for unordered lists (<ul>).
list-decimal: Adds decimal numbers as bullets for ordered lists (<ol>).
List Style Position:

list-inside: Positions the list item markers (bullets or numbers) inside the list item's box.
list-outside: Positions the list item markers outside the list item's box.

------------------------------------------------

Video 10 (Shared Data "Handle Inertia Request $page props")

Now that we've successfully extracted a Layout component, the next thing we need to sort out is how to share data across components. Luckily, Inertia provides a nice and friendly solution that we'll review in this episode.

public function share(Request $request): array
{
    return [
        ...parent::share($request),
        'auth' => [
            'user' => [
                'username' => 'afzal'
            ],
        ],
    ];
}

// we can define date here and use it all over project

// two ways to use it in page
// 1.template
// 2.script

// template
<p class="text-sm ml-4">
    Welcome Back, {{ $page.props.auth.user.username }}!
</p>

//script
// in vue 3
<script setup>
import { ref, computed } from 'vue'
import { usePage } from '@inertiajs/vue3';

const page = usePage();

const username = computed(() => {
  return page.props.auth.user.username;
});
</script>

// in vue 2
<script>
import Nav from "./Nav.vue";

const username = computed(() => {
  return this.$page.props.auth.user.username;
});
</script>

----------------------------------------------------------------

Video 11 (Global Component Registration)

_ component are not automatically registered globally because when pages changes all the components will be imported so unnecessary components will be imported.
_ when imported locally then it is easy to know which component is used here and imported.

_ import in app .js and register as a component.

// importing here.
import { Link } from '@inertiajs/vue3';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Link", Link) //register is here.
            .mount(el);
    },
});

----------------------------------------------------------------

Video 12 (Persistent Layouts)

Currently, layout state is reset each time we click from page to page. This is because every page component includes the Layout as part of its template. As such, when you visit a new page, that component, including the layout, is destroyed. If you instead want state from your layouts to persist across pages - such as for a podcast that continues playing as your browse the site - we'll need to review persistent layouts.

// vue 3
<template>
    <h1 class="text-3xl">
    Home
    </h1>
</template>

<script setup>
import Layout from "./../Shared/Layout.vue";

defineOptions({ layout: Layout })
</script>

// vue 2
<template>
    <h1 class="text-3xl">
        Home
    </h1>
</template>

<script>
import Layout from "./../Shared/Layout.vue";
export default {
    layout: Layout,
};
</script>

----------------------------------------------------------------

Video 13 (Default Layouts)

Now that we have persistent layouts working, if you wish, we can next remove the need to manually import and set the Layout for every single page component.

import Layout from './Layout'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page = pages[`./Pages/${name}.vue`]
    page.default.layout = page.default.layout || Layout
    return page
  },
  // ...
})

This will automatically set the page layout to Layout if a layout has not already been set for that page.

You can even go a step further and conditionally set the default page layout based on the page name, which is available to the resolve() callback. For example, maybe you don't want the default layout to be applied to your public pages.

import Layout from './Layout'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page = pages[`./Pages/${name}.vue`]
    page.default.layout = name.startsWith('Public/') ? undefined : Layout
    return page
  },
  // ...
})

----------------------------------------------------------------
