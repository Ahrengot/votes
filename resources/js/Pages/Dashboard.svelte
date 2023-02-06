<script>
    // Remove linting warning coming from HandleInertiaRequests
    // https://inertiajs.com/shared-data
    /* svelte-ignore unused-export-let */
    export let errors = {};
    /* svelte-ignore unused-export-let */
    export let auth = {};
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.svelte';
</script>

<svelte:head>
    <title>Dashboard</title>
</svelte:head>

<BreezeAuthenticatedLayout>
    <h2 class="text-xl font-semibold leading-tight text-gray-800" slot="header">
        Dashboard
    </h2>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200 bg-white p-6">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</BreezeAuthenticatedLayout>
