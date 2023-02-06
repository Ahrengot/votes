<script>
    let className;

    export let type = 'submit';
    export { className as class };
</script>

<button
    {type}
    class="{className} focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:border-gray-900 focus:outline-none active:bg-gray-900"
    {...$$restProps}
>
    <slot />
</button>
