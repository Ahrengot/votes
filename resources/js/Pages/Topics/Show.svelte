<script>
    import EmptyState from '@/Components/EmptyState.svelte';
    import Layout from '@/Layouts/Authenticated.svelte';
    import { Icon } from '@steeze-ui/svelte-icon';
    import { ChevronRight } from '@steeze-ui/heroicons';
    import Toggle from '@/Components/Toggle.svelte';
    import { router } from '@inertiajs/svelte';
    import route from 'ziggy';

    export let topic,
        can,
        errors = {};

    let updatingAllowSuggestions = false;

    const submitAllowSuggestions = () => {
        updatingAllowSuggestions = true;
        router.post(
            route('topics.allow-suggestions', topic.id),
            {
                allow_suggestions: topic.allow_suggestions,
            },
            {
                onSuccess: () => (updatingAllowSuggestions = false),
            }
        );
    };

    const relativeTime = new Intl.DateTimeFormat(undefined, {
        dateStyle: 'short',
        timeStyle: 'short',
    });
</script>

<svelte:head>
    <title>Topics | {topic.name}</title>
</svelte:head>

<Layout>
    <div slot="header" class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">{topic.name}</h2>
        {#if can['update']}
            <Toggle
                label="Allow suggestions"
                bind:value={topic.allow_suggestions}
                on:change={submitAllowSuggestions}
                disabled={updatingAllowSuggestions}
            />
        {/if}
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <ol class="divide-y divide-gray-200 rounded-lg bg-white shadow">
                {#each [] as suggestion (suggestion.id)}
                    <li>
                        <div class="flex items-center justify-between gap-3 p-5 hover:bg-gray-50">
                            <div class="truncate">
                                <p class="font-medium leading-none text-gray-600">
                                    {topic.name}
                                </p>
                                <time
                                    class="mt-1.5 block flex-shrink-0 text-sm font-normal leading-none text-gray-500"
                                    datetime={topic.created_at}
                                >
                                    Posted {relativeTime.format(new Date(topic.created_at))}
                                </time>
                            </div>
                            <div class="flex-shrink-0">
                                <Icon src={ChevronRight} class="h-6 w-6 text-gray-400" />
                            </div>
                        </div>
                    </li>
                {:else}
                    <li>
                        <EmptyState msg="There are no suggestions yet ..." class="p-5" />
                    </li>
                {/each}
            </ol>
        </div>
    </div>
</Layout>
