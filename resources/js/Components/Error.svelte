<script>
    export let message = '';

    let className;
    export { className as class };
</script>

{#if message}
    <div class="mt-2 text-sm text-red-600 {className}">
        {message}
    </div>
{/if}
