<script>
    /* svelte-ignore unused-export-let */
    import EmptyState from '@/Components/EmptyState.svelte';
    import Layout from '@/Layouts/Authenticated.svelte';
    import Button from '@/Components/Button.svelte';
    import Modal from '@/Components/Modal.svelte';
    import Label from '@/Components/Label.svelte';
    import Input from '@/Components/Input.svelte';
    import { useForm } from '@inertiajs/svelte';
    import route from 'ziggy';
    import Error from '@/Components/Error.svelte';

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

    console.log({ topics });
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
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {#if !topics.length}
                <EmptyState msg="You haven't created any topics yet ..." class="min-h-[60vh]" />
            {:else}
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">We have some topics</div>
                </div>
            {/if}
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
