<template>
    <Head title="Users" />

      <h1 class="text-3xl">
        Users
      </h1>

      <div style="margin-top: 400px">
        <p>The current time is {{ time }}.</p>

        <Link
          href="/users"
          class="text-blue-500"
          preserve-scroll
        >
          Refresh
        </Link>
      </div>
  </template>

  <script>
  export default {
    props: { time: String }
  };
  </script>
