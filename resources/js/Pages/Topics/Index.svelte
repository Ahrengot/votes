<script>
    import { inertia, useForm } from '@inertiajs/svelte';
    import EmptyState from '@/Components/EmptyState.svelte';
    import Layout from '@/Layouts/Layout.svelte';
    import Button from '@/Components/Button.svelte';
    import Modal from '@/Components/Modal.svelte';
    import Label from '@/Components/Label.svelte';
    import Input from '@/Components/Input.svelte';
    import route from 'ziggy';
    import Error from '@/Components/Error.svelte';
    import { Icon } from '@steeze-ui/svelte-icon';
    import { ChevronRight } from '@steeze-ui/heroicons';
    import { formatRelative } from 'date-fns';

    export let topics,
        errors = {};

    let showCreateModel = false;

    let form = useForm({
        name: null,
    });

    const saveNewTopic = () => {
        $form.post(route('topics.store'), {
            onSuccess: () => {
                $form.reset();
                showCreateModel = false;
            },
        });
    };
</script>

<svelte:head>
    <title>Topics</title>
</svelte:head>

<Layout>
    <div slot="header" class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Your topics</h2>
        <Button on:click={() => (showCreateModel = true)}>Create new</Button>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <ol class="divide-y divide-gray-200 rounded-lg bg-white shadow">
                {#each topics as topic (topic.id)}
                    <li>
                        <a
                            use:inertia
                            href={route('topics.show', topic.id)}
                            class="flex items-center justify-between gap-3 p-5 hover:bg-gray-50"
                        >
                            <div class="truncate">
                                <p class="font-medium leading-none text-gray-600">
                                    {topic.name}
                                </p>
                                <time
                                    class="mt-1.5 block flex-shrink-0 text-sm font-normal leading-none text-gray-500"
                                    datetime={topic.created_at}
                                >
                                    Created {formatRelative(new Date(topic.created_at), new Date())}
                                </time>
                            </div>
                            <div class="flex-shrink-0">
                                <Icon src={ChevronRight} class="h-6 w-6 text-gray-400" />
                            </div>
                        </a>
                    </li>
                {:else}
                    <li>
                        <EmptyState msg="You haven't created any topics yet ..." class="p-5" />
                    </li>
                {/each}
            </ol>
        </div>
    </div>

    <Modal
        bind:show={showCreateModel}
        title="New topic"
        onConfirm={saveNewTopic}
        onCancel={() => (showCreateModel = false)}
    >
        <form on:submit|preventDefault={saveNewTopic} class:opacity-50={form.processing}>
            <fieldset disabled={form.processing}>
                <Label for="new-topic-name" value="Name" />
                <Input
                    value={form.name}
                    on:input={e => ($form.name = e.detail)}
                    type="text"
                    id="new-topic-name"
                    class="mt-1"
                    placeholder="E.g. President for 2024, Best questions etc"
                    required
                    autofocus
                />
                <Error message={errors.name} />
            </fieldset>
        </form>
    </Modal>
</Layout>
