<script>
    import Layout from '@/Layouts/Authenticated.svelte';

    export let can;
</script>

<svelte:head>
    <title>Welcome</title>
</svelte:head>

<Layout>
    <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
        <div class="mt-8 overflow-hidden bg-white p-6 shadow sm:rounded-lg">
            <h2 class="text-lg font-semibold leading-7 text-gray-900">Votes app</h2>

            <div class="mt-2 text-sm text-gray-600">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eveniet impedit ipsam nihil soluta.
                Animi at consequatur culpa eaque et iure laborum nam numquam, officiis porro provident quidem
                reprehenderit velit.
            </div>
        </div>
    </div>
</Layout>
