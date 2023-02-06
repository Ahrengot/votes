<script>
    import Navigation from "@/Components/Navigation.svelte";
</script>

<div>
    <div class="min-h-screen bg-gray-100">

        <Navigation />

        <!-- Page Heading -->
        {#if $$slots.header}
            <!-- content here -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>
        {/if}

        <!-- Page Content -->
        <main>
            <slot />
        </main>
    </div>
</div>
