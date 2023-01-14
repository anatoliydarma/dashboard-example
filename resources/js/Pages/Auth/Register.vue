<template>

    <Head title="Register" />

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="first_name" value="First Name" />
            <BreezeInput id="first_name" type="text" class="block w-full mt-1" v-model="form.first_name"
                :error="errors.first_name" required autocomplete="first_name" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="last_name" value="Last Name" />
            <BreezeInput id="last_name" type="text" class="block w-full mt-1" v-model="form.last_name"
                :error="errors.last_name" required autocomplete="last_name" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="block w-full mt-1" v-model="form.email" :error="errors.email"
                required autocomplete="username" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" value="Password" />
            <BreezeInput id="password" type="password" class="block w-full mt-1" v-model="form.password"
                :error="errors.password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password_confirmation" value="Confirm Password" />
            <BreezeInput id="password_confirmation" type="password" class="block w-full mt-1"
                v-model="form.password_confirmation" :error="errors.password_confirmation" required
                autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link :href="route('login')" class="hover:text-slate-900 text-sm text-slate-600 underline">
            Already registered?
            </Link>

            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Register
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import BreezeCheckbox from "@/Components/Checkbox.vue";
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    props: {
        errors: Object
    },
    data: function () {
        return {
            form: useForm({
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
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
            this.form.post(route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            });
        }
    }
}

</script>
