<template>

    <Head title="Check OTP" />

    <div class="flex flex-col items-center justify-between space-y-4">
        <div class="text-base text-center text-slate-600">
            <p>We sent you <b>verification code</b> to your email.</p>
            <p>Enter verification code here</p>
        </div>

        <v-otp-input ref="otpInput" input-classes="otp-input" separator="" :num-inputs="6" :should-auto-focus="true"
            :is-input-num="true" @on-complete="handleOnComplete" />
        <div class="flex justify-end w-full">
            <button @click="resend" class="hover:bg-slate-50 px-2 py-1 text-sm text-indigo-500 rounded-md">
                Resend
            </button>
        </div>
    </div>
</template>

<script>
import VOtpInput from "vue3-otp-input";
import { Inertia } from "@inertiajs/inertia";
import BreezeGuestLayout from "@/Layouts/Guest.vue";

export default {
    layout: BreezeGuestLayout,
    components: {
        VOtpInput,
    },
    setup() {
        const otpInput = ref(null);

        const handleOnComplete = (value) => {
            let params = {};
            params.otp = value;
            Inertia.post(route("otp.check"), params);
        };

        const resend = () => {
            otpInput.value.clearInput();
            Inertia.post(route("otp.resend"));
        };

        return { handleOnComplete, resend, otpInput };
    },
};
</script>
