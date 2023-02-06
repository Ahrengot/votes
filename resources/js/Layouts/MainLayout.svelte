<script>
    import { inertia } from '@inertiajs/svelte';
</script>

<main class="m-auto h-screen max-w-4xl p-14">
    <header>
        <a use:inertia href="/">Home</a>
        <a use:inertia href="/about">About</a>
        <a use:inertia href="/links">Links</a>
    </header>
    <article>
        <slot />
    </article>
</main>
