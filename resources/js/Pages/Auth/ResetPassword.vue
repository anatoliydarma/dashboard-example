<template>
    <Head title="Reset Password" />

    <BreezeValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" value="Password" />
            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password_confirmation" value="Confirm Password" />
            <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Reset Password
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,
    props: {
        email: String,
        token: String,
    },
    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
    },
    data: function () {
        return {
            form: useForm({
                token: this.$props.token,
                email: this.$props.email,
                password: '',
                password_confirmation: '',
            })
        }
    },
    methods: {
        submit: function () {
            this.form.post(route('password.update'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            });
        }
    },
}
</script>
