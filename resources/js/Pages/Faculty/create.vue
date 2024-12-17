<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    level: 1,
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("faculty.teacher.store"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
const props = defineProps({
    errors: Object,
});
</script>

<template>
    <p v-for="(error, index) in errors" :key="index">{{ error }}</p>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <p
                class="flex mb-5 justify-center rounded-md border border-transparent bg-black px-4 py-2 text-xl font-semibold uppercase text-white"
            >
                ثبت نام استاد
            </p>

            <div>
                <InputLabel for="name" value="نام" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="ایمیل" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="رمز عبور" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="تایید رمز عبور"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-4 flex items-center justify-between">
                <!-- <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    تا کنون ثبت نام کرده اید ؟
                </Link> -->

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    ثبت نام
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
