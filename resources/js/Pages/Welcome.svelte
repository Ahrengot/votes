<script>
    import { Link, page } from '@inertiajs/svelte';
    export let can;
</script>

<svelte:head>
    <title>Welcome</title>
</svelte:head>

<div
    class="items-top relative flex min-h-screen justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
>
    {#if can['login']}
        <div class="fixed top-0 right-0 hidden px-6 py-4 sm:block">
            {#if $page.props.auth.user}
                <Link
                    href="/dashboard"
                    class="text-sm text-gray-700 underline dark:text-white"
                >
                    Dashboard
                </Link>
            {:else}
                <Link
                    href="/login"
                    class="text-sm text-gray-700 underline dark:text-white"
                >
                    Log in
                </Link>

                {#if can['register']}
                    <Link
                        href="/register"
                        class="ml-4 text-sm text-gray-700 underline dark:text-white"
                    >
                        Register
                    </Link>
                {/if}
            {/if}
        </div>
    {/if}

    <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
        <div
            class="mt-8 overflow-hidden bg-white p-6 shadow dark:bg-gray-800 sm:rounded-lg"
        >
            <h2
                class="text-lg font-semibold leading-7 text-gray-900 dark:text-white"
            >
                Votes app
            </h2>

            <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa
                eveniet impedit ipsam nihil soluta. Animi at consequatur culpa
                eaque et iure laborum nam numquam, officiis porro provident
                quidem reprehenderit velit.
            </div>
        </div>
    </div>
</div>
