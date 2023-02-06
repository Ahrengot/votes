<script>
    import { fade, scale } from 'svelte/transition';
    import { focusTrap } from 'svelte-focus-trap';
    import { onDestroy, onMount } from 'svelte';
    import { Icon } from '@steeze-ui/svelte-icon';
    import { XMark } from '@steeze-ui/heroicons';
    import Button from '@/Components/Button.svelte';

    export let onConfirm,
        onCancel,
        show = false,
        title = '';

    const onKeyUp = e => {
        if (onCancel && e.key === 'Escape') {
            onCancel();
        }
    };

    onMount(() => {
        window.addEventListener('keyup', onKeyUp);
    });

    onDestroy(() => {
        window.removeEventListener('keyup', onKeyUp);
    });
</script>

<div class="fixed inset-0 z-10 overflow-y-auto {show ? '' : 'pointer-events-none'}">
    <!-- Overlay -->
    {#if show}
        <div transition:fade class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm" />

        <!-- Panel -->
        <div
            transition:scale={{ start: 0.9, duration: 150 }}
            use:focusTrap
            class="relative flex min-h-screen items-center justify-center p-4"
        >
            <div class="relative w-full max-w-2xl overflow-y-auto rounded-xl bg-white p-6 shadow-lg">
                {#if onCancel}
                    <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                        <button
                            type="button"
                            on:click={onCancel}
                            class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            <Icon src={XMark} class="h-6 w-6" />
                        </button>
                    </div>
                {/if}

                <h2 class="text-xl font-bold">{title}</h2>

                <div class="mt-8">
                    <slot />
                </div>

                {#if onConfirm || onCancel}
                    <div class="mt-8 flex justify-end gap-2">
                        {#if onConfirm}
                            <Button on:click={onConfirm}>Save</Button>
                        {/if}
                        {#if onCancel}
                            <Button on:click={onCancel} variant="outline">Cancel</Button>
                        {/if}
                    </div>
                {/if}
            </div>
        </div>
    {/if}
</div>
