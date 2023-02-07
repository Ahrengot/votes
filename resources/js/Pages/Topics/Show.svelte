<script>
    import Layout from '@/Layouts/Authenticated.svelte';
    import { Icon } from '@steeze-ui/svelte-icon';
    import { Trash } from '@steeze-ui/heroicons';
    import Toggle from '@/Components/Toggle.svelte';
    import { router, useForm } from '@inertiajs/svelte';
    import route from 'ziggy';
    import Input from '@/Components/Input.svelte';
    import Button from '@/Components/Button.svelte';

    export let topic,
        suggestions,
        iphash,
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

    const suggestion = useForm({
        name: '',
    });

    const submitNewSuggestion = () => {
        $suggestion.post(route('topics.suggestions.store', topic.id), {
            onSuccess: () => {
                $suggestion.reset();
            },
        });
    };

    const deleteSuggestion = id => {
        if (!confirm('Are you suge your want to delete this suggestion?')) {
            return;
        }
        router.delete(route('suggestions.destroy', id));
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
                label="Suggestions"
                bind:value={topic.allow_suggestions}
                on:change={submitAllowSuggestions}
                disabled={updatingAllowSuggestions}
            />
        {/if}
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <ol class="divide-y divide-gray-200 rounded-lg bg-white shadow">
                {#each suggestions as suggestion (suggestion.id)}
                    <li>
                        <div class="flex items-center justify-between gap-3 p-5">
                            <div class="truncate">
                                <p class="font-medium leading-none text-gray-600">
                                    {suggestion.name}
                                </p>
                                <time
                                    class="mt-1.5 block flex-shrink-0 text-sm font-normal leading-none text-gray-500"
                                    datetime={suggestion.created_at}
                                >
                                    Posted {relativeTime.format(new Date(suggestion.created_at))}
                                </time>
                            </div>
                            <div class="flex-shrink-0">
                                {#if can['update'] || iphash === suggestion.iphash}
                                    <button
                                        type="button"
                                        class="inline-flex items-center rounded-full border border-gray-300 p-2 text-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                        on:click={() => deleteSuggestion(suggestion.id)}
                                    >
                                        <Icon src={Trash} class="h-6 w-6" />
                                    </button>
                                {/if}
                            </div>
                        </div>
                    </li>
                {/each}
            </ol>

            {#if can['update'] || topic.allow_suggestions}
                <div class="mt-10">
                    <form on:submit|preventDefault={submitNewSuggestion}>
                        <fieldset disabled={suggestion.processing}>
                            <div class="flex items-center gap-3">
                                <Input
                                    type="text"
                                    id="suggestion"
                                    class="mt-1"
                                    value={$suggestion.name}
                                    on:input={e => ($suggestion.name = e.detail)}
                                    placeholder="Add your suggestion..."
                                    required
                                />
                                <Button type="submit">Send</Button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            {/if}
        </div>
    </div>
</Layout>
