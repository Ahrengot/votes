<script>
    import { createEventDispatcher } from 'svelte';

    let className = '';

    export let type = 'button',
        variant = 'base';

    export { className as class };

    const getVariantClasses = () => {
        switch (variant) {
            case 'outline':
                return 'border-gray-300 bg-white text-gray-700 shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2';
            default:
                return 'border-transparent bg-gray-800 text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2';
        }
    };

    const dispatch = createEventDispatcher();
</script>

<button
    {type}
    class="{className} {getVariantClasses()} inline-flex items-center rounded-md border px-4 py-2 text-xs font-semibold uppercase tracking-widest transition duration-150 ease-in-out"
    on:click={() => dispatch('click')}
    {...$$restProps}
>
    <slot />
</button>
