<script>
    import { createEventDispatcher, onMount } from 'svelte';

    const dispatch = createEventDispatcher();

    let className;
    let inputElement;

    export let value = '';
    export { className as class };

    function onInput() {
        dispatch('input', value);
    }

    onMount(() => {
        if (inputElement.hasAttribute('autofocus')) {
            inputElement.focus();
        }
    });
</script>

<input
    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 {className}"
    bind:value
    on:input={onInput}
    bind:this={inputElement}
    {...$$restProps}
/>
