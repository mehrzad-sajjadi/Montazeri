<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    last_name: "",
    code_id: "",
    email: "",
    password: "",
    password_confirmation: "",
    isFaculty: false,
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

                <div class="mt-4 block">
                    <label class="flex items-center">
                        <input
                            type="checkbox"
                            v-model="form.isFaculty"
                            class="w-5 h-5 rounded-md border-gray-400 text-blue-600 focus:ring-blue-500"
                        />
                        <span class="ms-2 text-sm text-gray-600">
                            عضو هیات علمی
                        </span>
                    </label>
                </div>
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
                <Link
                    :href="route('faculty.index')"
                    type="button"
                    as="button"
                    class="h-8 px-4 m-2 text-sm duration-150 rounded focus:shadow-outline bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent"
                >
                    بازگشت
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
