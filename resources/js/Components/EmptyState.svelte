<script>
    import { Icon } from '@steeze-ui/svelte-icon';
    import { Inbox } from '@steeze-ui/heroicons';

    export let title,
        msg = '';

    // God, this is lame
    let className;
    export { className as class };
</script>

<div class="grid place-content-center text-center {className}">
    <div>
        <Icon src={Inbox} theme="outline" class="mx-auto h-12 w-12 text-gray-400" />

        {#if title}
            <h3 class="mt-2 text-xl font-medium text-gray-100">{title}</h3>
        {/if}
        <p class="mt-1 text-gray-500">{msg}</p>
    </div>
</div>
