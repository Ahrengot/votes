<script>
    import Layout from '@/Layouts/Authenticated.svelte';
    import { slide } from 'svelte/transition';
    import { flip } from 'svelte/animate';
    import { Icon } from '@steeze-ui/svelte-icon';
    import { HandThumbUp } from '@steeze-ui/heroicons';
    import Toggle from '@/Components/Toggle.svelte';
    import { router, useForm } from '@inertiajs/svelte';
    import route from 'ziggy';
    import Input from '@/Components/Input.svelte';
    import Button from '@/Components/Button.svelte';
    import getBrowserFingerprint from 'get-browser-fingerprint';
    import { formatRelative } from 'date-fns';

    export let topic,
        suggestions,
        can,
        errors = {};

    const fingerprint = getBrowserFingerprint();

    const topicForm = useForm(topic);

    const suggestion = useForm({
        name: '',
        fingerprint,
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

        router.delete(route('suggestions.destroy', { suggestion: id, fingerprint }));
    };

    const voteFor = suggestion => {
        console.log(suggestion.votes);
        return suggestion.votes.find(v => v.fingerprint == fingerprint);
    };

    let voteRequestProcessing = false;
    const toggleVote = async suggestion => {
        voteRequestProcessing = true;

        const vote = voteFor(suggestion);

        if (vote) {
            await router.delete(route('votes.destroy', { vote: vote.id, fingerprint }));
        } else {
            await router.post(route('suggestions.votes.store', { suggestion: suggestion.id, fingerprint }));
        }

        voteRequestProcessing = false;
    };
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
                bind:value={$topicForm.allow_suggestions}
                on:change={() => $topicForm.post(route('topics.allow-suggestions', topic.id))}
                disabled={$topicForm.processing}
            />
        {/if}
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <ol class="divide-y divide-gray-200 rounded-lg bg-white shadow">
                {#each suggestions as suggestion (suggestion.id)}
                    <li animate:flip={{ duration: 350 }} transition:slide={{ duration: 350 }}>
                        <div class="flex items-center justify-between gap-3 p-5">
                            <div class="truncate">
                                <p class="font-medium leading-none text-gray-600">
                                    {suggestion.name}
                                </p>
                                <div class="mt-1.5 flex items-center gap-1 text-sm leading-none text-gray-500">
                                    <time datetime={suggestion.created_at}>
                                        {formatRelative(new Date(suggestion.created_at), new Date())}
                                    </time>
                                    {#if can['update'] || fingerprint == suggestion.fingerprint}
                                        <span>&bull;</span>
                                        <button
                                            type="button"
                                            class="hover:text-gray-800"
                                            on:click={() => deleteSuggestion(suggestion.id)}
                                        >
                                            Delete
                                        </button>
                                    {/if}
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <button
                                    type="button"
                                    class="group flex flex-col items-center gap-1 rounded border px-3 py-1.5 transition focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 {voteFor(
                                        suggestion
                                    )
                                        ? 'border-transparent bg-emerald-500 text-white hover:bg-emerald-600'
                                        : 'border-gray-300 text-gray-400 hover:bg-gray-50'}"
                                    on:click={() => toggleVote(suggestion)}
                                    disabled={voteRequestProcessing}
                                >
                                    <Icon
                                        src={HandThumbUp}
                                        theme="solid"
                                        class="h-5 w-5 transition group-hover:-rotate-12"
                                    />
                                    <div class="text-xs">{suggestion.votes_count}</div>
                                </button>
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
