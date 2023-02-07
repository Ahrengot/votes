<script>
    import Layout from '@/Layouts/Layout.svelte';

    export let can;
</script>

<svelte:head>
    <title>Welcome</title>
</svelte:head>

<Layout>
    <div class="mx-auto grid min-h-[70vh] max-w-2xl place-content-center sm:px-6 lg:px-8">
        <div class="rounded-lg bg-white p-6 shadow">
            <h2 class="text-lg font-semibold leading-7 text-gray-900">Votes app</h2>

            <div class="mt-2 space-y-6 text-gray-600">
                <p>
                    This application lets you create topics that anyone can vote on. As the topic author, you control
                    whether you want anonymous suggestions.
                </p>
                <p>Create an account to get started.</p>
            </div>
        </div>
    </div>
</Layout>
