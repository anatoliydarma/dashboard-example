<template>

    <Head title="Log in" />

    <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="block w-full mt-1" v-model="form.email" :error="errors.email"
                required autocomplete="username" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" value="Password" />
            <BreezeInput id="password" type="password" class="block w-full mt-1" v-model="form.password"
                :error="errors.password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                <span class="ml-2 text-sm text-slate-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link v-if="canResetPassword" :href="route('password.request')"
                class="text-sm text-slate-600 underline hover:text-slate-900">
            Forgot your password?
            </Link>

            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Log in
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeButton from "@/Components/Button.vue";
import BreezeCheckbox from "@/Components/Checkbox.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    props: {
        canResetPassword: Boolean,
        status: String,
        errors: Object,
    },
    data: function () {
        return {
            form: useForm({
                email: "",
                password: "",
                remember: false,
            }),
        };
    },
    layout: BreezeGuestLayout,
    components: {
        BreezeValidationErrors,
        BreezeLabel,
        BreezeInput,
        BreezeCheckbox,
        BreezeButton,
    },
    methods: {
        submit: function () {
            this.form.post(route("login"), {
                onFinish: () => this.form.reset("password"),
            });
        },
    },
};
</script>
