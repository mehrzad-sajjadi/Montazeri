<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Checkbox from "@/Components/Checkbox.vue";

const form = useForm({
    name: "",
    last_name: "",
    code_id: "",
    email: "",
    password: "",
    password_confirmation: "",
    is_company: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
const props = defineProps({
    errors: Object,
});
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <p
                class="flex mb-5 justify-center rounded-md border border-transparent bg-black px-4 py-2 text-xl font-semibold uppercase text-white"
            >
                ثبت نام کاربر
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
                <InputLabel for="last_name" value="نام خانوادگی" />

                <TextInput
                    id="last_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.last_name"
                />

                <InputError class="mt-2" :message="form.errors.last_name" />
            </div>

            <div class="mt-4">
                <InputLabel for="code_id" value="کد ملی" />

                <TextInput
                    id="last_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.code_id"
                />

                <InputError class="mt-2" :message="form.errors.code_id" />
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

            <div class="mt-4 block">
                <label class="flex items-center">
                    <input
                        type="checkbox"
                        v-model="form.is_company"
                        class="w-5 h-5 rounded-md border-gray-400 text-blue-600 focus:ring-blue-500"
                    />
                    <span class="ms-2 text-sm text-gray-600">
                        مدیر یک شرکت هستم
                    </span>
                </label>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    تا کنون ثبت نام کرده اید ؟
                </Link>

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
