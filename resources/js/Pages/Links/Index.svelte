<script>
    export let links;
    import MainLayout from '@/Layouts/Layout.svelte';

    import { inertia, useForm } from '@inertiajs/svelte';

    let form = useForm({
        title: null,
        url: null,
    });

    let focusForm;

    function focus() {
        focusForm.focus();
    }

    function submit() {
        focus();
        $form.post('/links');
        $form.reset();
    }
</script>

<svelte:head>
    <title>Links List</title>
</svelte:head>
<MainLayout>
    <h2 class="text-xl font-semibold leading-tight text-gray-800" slot="header">Links</h2>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200 bg-white p-6">
                    {#if !links.length}
                        No links added. Why don't you add one below?
                    {:else}
                        {#each links as link (link.id)}
                            <li>
                                <a href={link.url} target="_blank">{link.title}</a>
                                <button
                                    class="mt-4 inline-flex items-center rounded-md border border-transparent bg-red-400 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2"
                                    use:inertia={{
                                        href: `/links/${link.id}`,
                                        method: 'delete',
                                    }}
                                    >Delete Link
                                </button>
                            </li>
                        {/each}
                    {/if}
                    <form on:submit|preventDefault={submit}>
                        <div class="mt-8">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <div class="mt-1">
                                <input
                                    bind:value={$form.title}
                                    bind:this={focusForm}
                                    type="text"
                                    name="title"
                                    id="title"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Twitter"
                                />
                            </div>
                            {#if $form.errors.title}
                                <div class="form-error">
                                    {$form.errors.title}
                                </div>
                            {/if}
                        </div>
                        <div class="mt-4">
                            <label for="url" class="block text-sm font-medium text-gray-700"> URL </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span
                                    class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm"
                                >
                                    http://
                                </span>
                                <input
                                    bind:value={$form.url}
                                    type="text"
                                    name="url"
                                    id="url"
                                    class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="www.twitter.com"
                                />
                            </div>
                            {#if $form.errors.url}
                                <div class="form-error">
                                    {$form.errors.url}
                                </div>
                            {/if}
                        </div>
                        <button
                            disabled={$form.processing}
                            type="submit"
                            class="mt-4 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</MainLayout>
