<script>
    import BreezeButton from '@/Components/Button.svelte';
    import Layout from '@/Layouts/Layout.svelte';
    import BreezeInput from '@/Components/Input.svelte';
    import BreezeLabel from '@/Components/Label.svelte';
    import BreezeValidationErrors from '@/Components/ValidationErrors.svelte';
    import { inertia, useForm } from '@inertiajs/svelte';

    export let errors = {};

    let form = useForm({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
        terms: false,
    });

    let err = {};

    $: {
        err = errors;
    }

    const submit = () => {
        $form.post('/register', {
            onSuccess: () => $form.reset('password', 'password_confirmation'),
        });
    };
</script>

<svelte:head>
    <title>Register</title>
</svelte:head>

<Layout>
    <div class="mx-auto max-w-2xl py-[10vh] sm:px-6 lg:px-8">
        <BreezeValidationErrors class="mb-4" errors={err} />

        <form on:submit|preventDefault={submit}>
            <div>
                <BreezeLabel for="name" value="Name" />
                <BreezeInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    value={form.name}
                    required
                    autofocus
                    autocomplete="name"
                    on:input={evt => ($form.name = evt.detail)}
                />
            </div>

            <div class="mt-4">
                <BreezeLabel for="email" value="Email" />
                <BreezeInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    value={form.email}
                    required
                    autocomplete="username"
                    on:input={evt => ($form.email = evt.detail)}
                />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    value={form.password}
                    required
                    autocomplete="new-password"
                    on:input={evt => ($form.password = evt.detail)}
                />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password_confirmation" value="Confirm Password" />
                <BreezeInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    value={form.password_confirmation}
                    required
                    autocomplete="new-password"
                    on:input={evt => ($form.password_confirmation = evt.detail)}
                />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <a href="/login" use:inertia class="text-sm text-gray-600 underline hover:text-gray-900">
                    Already registered?
                </a>

                <BreezeButton type="submit" class="ml-4" xclass:opacity-25={form.processing} disabled={form.processing}>
                    Register
                </BreezeButton>
            </div>
        </form>
    </div>
</Layout>
