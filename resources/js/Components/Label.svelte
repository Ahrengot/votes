<script>
    let forName;

    export let value;
    export { forName as for };
</script>

<!-- svelte-ignore a11y-label-has-associated-control -->
<label class="block text-sm font-medium text-gray-700" for={forName}>
    {#if value}
        <span>{value}</span>
    {:else}
        <span><slot /></span>
    {/if}
</label>
