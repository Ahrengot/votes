<script>
    import { inertia, Link } from '@inertiajs/svelte';

    export let type = 'a';
    export let href;
    export let method = 'get';
</script>

{#if type !== 'button'}
    <Link
        {...$$restProps}
        class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
    >
        <slot />
    </Link>
{:else}
    <button
        use:inertia={{ href: href, method: method }}
        type="button"
        class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
        ><slot /></button
    >
{/if}
