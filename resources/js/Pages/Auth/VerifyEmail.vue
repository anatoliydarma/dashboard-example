<template>

    <Head title="Email Verification" />

    <div class="mb-4 text-sm text-slate-600">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we
        just emailed to you? If you didn't receive the email, we will gladly send you another.
    </div>

    <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">
        A new verification link has been sent to the email address you provided during registration.
    </div>

    <form @submit.prevent="submit">
        <div class="mt-4 flex items-center justify-between">
            <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Resend Verification Email
            </BreezeButton>

            <Link :href="route('logout')" method="post" as="button"
                class="underline text-sm text-slate-600 hover:text-slate-900">Log Out</Link>
        </div>
    </form>
</template>


<script>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,
    props: {
        status: String,
    },
    components: {
        BreezeButton,
    },
    computed: {
        verificationLinkSent: function () {
            return this.$props.status === 'verification-link-sent'
        }
    },
    data: function () {
        return {
            form: useForm()
        }
    },
    methods: {
        submit: function () {
            this.form.post(route('verification.send'));
        }
    },
}
</script>
