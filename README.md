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

Video 14 (Code Splitting and Dynamic Imports)

I am using vite and no webpack and files are already dynamically loaded in vite and very fast then webpack.


----------------------------------------------------------------

Video 15 (Dynamic Title and Meta Tags)

// import head from inertia. register as a component globally and can make it locally. and declared by default title forward .

import { Link, Head } from '@inertiajs/vue3';

setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Link", Link)
            .component("Head", Head)
            .mount(el);
    },
title: title => `My App - ${title}`,

// here is the title function we pass the title to it and the concat string 'My App' with page dynamic title.

// we can use our head section, title or meta tags in header in lay out.
<Head>
    <meta
    type="description"
    content="Information about my app"
    head-key="description"
    >
</Head>

// we already have this in layout but we can override it. by again writing it. but we have must include head-key in the meta tag.
<Head>
    <title>Home</title>
    <meta
    type="description"
    content="Home information"
    head-key="description"
    >
</Head>

// we can also define title as a prop.
<Head title="users"></Head>

----------------------------------------------------------------

# Video 16 (An Important SPA Security Concern)

In this episode, as we begin our review of how Eloquent data can be fetched and sent to the client-side, we'll need to take some time to discuss an incredibly important concern when building any SPA: data that is returned from an AJAX request is of course entirely visible to the end-user. With this in mind, you must pay special attention to ensure that you aren't accidentally exposing private information.


# it will pass all the data which is private or not.
Route::get('/users', function () {
    return Inertia::render('Users', [
        'users' => User::all();
    ]);
});

# by mapping you can select which data you have to pass or not so that only necessary data will be passed and data which is private will be secured.
Route::get('/users', function () {
    return Inertia::render('Users', [
        'users' => User::all()->map(fn($user) => [
            'name' => $user->name
        ])
    ]);
});

# Collection: In Laravel, when you retrieve data from the database using Eloquent or from other sources, it's often returned as a collection. A collection is essentially an object-oriented array that provides a variety of helpful methods for manipulating the data.
# Map Method: The map method iterates over each item in the collection and applies a callback function to it. This callback function defines how each item should be transformed.
# Callback Function: The callback function is a piece of code that you provide as an argument to the map method. It takes each item from the collection as input and returns the transformed version of that item. This function can be defined using traditional PHP anonymous functions or arrow functions (as in your example).

----------------------------------------------------------------

# Video 17 (Pagination)

# You'll be happy to hear that Laravel makes a pagination laughably simple to implement. In this episode, we'll add a list of pagination links to the bottom of our users table.

# Using Single Quotes and Concatenation:
<Link :href="'/users/'+user.id+'/edit'" class="text-indigo-600 hover:text-indigo-900">
    Edit
</Link>

# Using Template Literal:
<Link :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
    Edit
</Link>

# you can simply paginate like this.
Route::get('/users', function () {
    return Inertia::render('Users', [
        'users' => User::paginate(100)
    ]);
});

# you can paginate like this but then we map it so it make a new collection.
Route::get('/users', function () {
    return Inertia::render('Users', [
        'users' => User::paginate(10)->map(fn($user) => [
            'id' => $user->id,
            'name' => $user->name
        ])
    ]);
});

# you can paginate like this but then we use through which doesn't make a new collection.
Route::get('/users', function () {
    return Inertia::render('Users', [
        'users' => User::paginate(10)->through(fn($user) => [
            'id' => $user->id,
            'name' => $user->name
        ])
    ]);
});

# pagination component
# The element itself is component it helps when the link is not empty then it will work as a link but when its not then it will work as a span.
# v-html will render the link label if there is symbol it will convert it.
# :class="{ 'text-gray-500': ! link.url, 'font-bold' : link.active }" style object
# :class="link.url ? 'text-gray-500' : ''" style with ternary formatting
<template>
    <div>
        <Component
        :is="link.url ? 'Link' : 'span'"
        v-for="link in links"
        :href="link.url"
        v-html="link.label"
        class="px-1"
        :class="{ 'text-gray-500': ! link.url, 'font-bold' : link.active }"
        />
    </div>
</template>

<script>
    export default {
        props: {
            links: Array
        }
    };
</script>

# In Vue.js, <component> is a built-in component that allows you to dynamically render element based on a provided value. It's particularly useful when you need to switch between multiple elements based on certain conditions or user interactions.

<Component:is="link.url ? 'Link' : 'span'"/>

----------------------------------------------------------------

# Video 18 (Filtering, State, and Query Strings)

# Now that we have pagination working properly, let's next implement real-time search filtering. When we type into a search box, the table of users should automatically refresh to show only the users that match the given search query. Let's get to work!

# watch: Allows you to watch specific reactive data and trigger a callback function when it changes. Provides more control over the watch behavior.

watch(state, (newValue, oldValue) => {
    console.log(`State changed from ${oldValue} to ${newValue}`);
});

# watchEffect: Automatically tracks reactive dependencies used inside its callback function and re-runs the function whenever any of those dependencies change. Provides a more declarative way to reactively execute code without explicitly specifying dependencies.

watchEffect(() => {
    console.log(`State is ${state.value}`);
});

<script setup>
    import Pagination from "./../Shared/Pagination.vue";
    import { ref, watch } from "vue";
    import {Inertia} from "@inertiajs/inertia";

    let props = defineProps({
        users: Object,
        filters: Object
    });

    let search = ref(props.filters.search);

------------------------------------------------
# in compositin api vue 3
watch(search, value => {
    Inertia.get('/users', { search: value }, {
# preseve state will maintain current state and value when you search the value and focus will not be removed from the search input.
        preserveState: true,
# replace: true will directly remove the search and will move you to the previous page when click on back button because if it is false then it will remove one one word and not directly go to previous page when click on back button.
        replace: true
    });
});

# in option api vue 3
watch(search, value => {
    this.$inertia.get('/users', { search: value });
});
--------------------------------------------------
</script>

Route::get('/users', function () {
    return Inertia::render('Users', [
# query() is used when we want to initialize a new query;
        'users' => User::query()
# called oop conditinol searching query is like this.
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10)
# when page is changed by pagination then search will be removed this ->witQueryString() will keep the search with page.
            ->withQueryString()
            ->through(fn($user) => [
                'id' => $user->id,
                'name' => $user->name
            ]),
# if someone refresh the page then there will be search parameter in query but it will not apply as a filter because the filters will not be applied because the search variable will be reset and empty. so we will pass filters as a props and will put in search varaible then it will apply as a filter.
        'filters' => Request::only(['search'])
    ]);

});

----------------------------------------------------------------

# Video 19 (Inertia Forms 101)

# Processing forms With Vue, Inertia, and Laravel is a joy. It instantly feels familiar, while offering wild amounts of power and flexibility. Let's by asynchronously submitting a simple form for creating a user.

----------------------------------------------------------------

# Video 20 (Display Failed Validation Messages)

# In the previous episode, we got the "happy path" of our form to work properly. But what about situations where the validation checks failed? Let's conditionally render a red validation message below each input that failed the validator.

# if you define errors in props.
<div v-if="errors.name" v-text="errors.name" class="text-red-500 text-xs mt-1"></div>

<script>
    defineProps({
        errors: Object
    });
</script>

# if you dontt define props in script then you can directly use from $page.
<div v-if="$page.props.errors.name" v-text="errors.name" class="text-red-500 text-xs mt-1"></div>

----------------------------------------------------------------
