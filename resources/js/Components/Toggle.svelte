<script>
    import { createEventDispatcher } from 'svelte';

    export let value,
        label,
        disabled = false;

    let button;

    const dispatch = createEventDispatcher();

    const onChange = () => {
        value = !value;
        dispatch('change', value);
    };
</script>

<div class="flex items-center justify-center" class:opacity-50={disabled}>
    <label class="font-medium text-gray-900" on:click={button.click()}>{label}</label>

    <!-- Button -->
    <button
        bind:this={button}
        on:click={onChange}
        {disabled}
        type="button"
        role="switch"
        class="relative ml-4 inline-flex w-14 rounded-full py-1 transition {value ? 'bg-green-400' : 'bg-slate-300'}"
    >
        <span
            class="h-5 w-5 rounded-full bg-white shadow-md transition {value ? 'translate-x-8' : 'translate-x-1'}"
            aria-hidden="true"
        />
    </button>
</div>
