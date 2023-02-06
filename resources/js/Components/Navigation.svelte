<script>
    import BreezeApplicationLogo from '@/Components/ApplicationLogo.svelte';
    import BreezeDropdown from '@/Components/Dropdown.svelte';
    import BreezeDropdownLink from '@/Components/DropdownLink.svelte';
    import BreezeNavLink from '@/Components/NavLink.svelte';
    import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.svelte';
    import { page, Link } from '@inertiajs/svelte';

    let user = $page.props.auth.user;

    let showingNavigationDropdown = false;
</script>

<nav class="ml-3 border-b border-gray-100 bg-white">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <Link href="/dashboard">
                        <BreezeApplicationLogo class="block h-9 w-auto" />
                    </Link>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <BreezeNavLink href="/dashboard" active={$page.component === 'Dashboard'}>Dashboard</BreezeNavLink>
                </div>
            </div>

            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <!-- Settings Dropdown -->
                <div class="relative ml-3">
                    <BreezeDropdown class="right-0 w-48 origin-top-right">
                        <span class="inline-flex rounded-md" slot="trigger">
                            <button
                                type="button"
                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                            >
                                {user.name}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </span>

                        <BreezeDropdownLink slot="content" href="/logout" method="post" as="button" type="button">
                            Log Out
                        </BreezeDropdownLink>
                    </BreezeDropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button
                    on:click={() => (showingNavigationDropdown = !showingNavigationDropdown)}
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d={showingNavigationDropdown ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'}
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div class:block={showingNavigationDropdown} class:hidden={!showingNavigationDropdown} class="sm:hidden">
        <div class="space-y-1 pt-2 pb-3">
            <BreezeResponsiveNavLink href="/dashboard" active={$page.component === 'Dashboard'}>
                Dashboard
            </BreezeResponsiveNavLink>
        </div>

        <!-- Responsive Settings Options -->
        <div class="border-t border-gray-200 pt-4 pb-1">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{user.name}</div>
                <div class="text-sm font-medium text-gray-500">{user.email}</div>
            </div>

            <div class="mt-3 space-y-1">
                <BreezeResponsiveNavLink href="/logout" method="post" as="button">Log Out</BreezeResponsiveNavLink>
            </div>
        </div>
    </div>
</nav>
