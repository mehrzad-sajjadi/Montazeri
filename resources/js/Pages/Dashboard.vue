<template>
    <Head title="ثبت کارآموزی" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold dark:text-white text-xl text-gray-800 leading-tight"
            >
                ثبت اطلاعات محل کارآموزی
            </h2>
        </template>

        <div
            class="flex flex-col w-5/6 mx-auto my-16 border border-gray-500 rounded-lg"
        >
            <div class="flex flex-col justify-between">
                <div>
                    <div class="mb-5 py-2 px-2 w-full">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-4 sm:gap-x-2"
                        >
                            <div>
                                <label
                                    class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                                >
                                    نام شرکت
                                </label>
                                <input
                                    class="block w-[100%] p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    autofocus
                                    v-model="form.company"
                                />
                                <p class="text-red-600">
                                    {{ $page.props.errors.company }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                                >
                                    تلفن
                                </label>
                                <input
                                    class="block w-[100%] p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.phone"
                                />
                                <p class="text-red-600">
                                    {{ $page.props.errors.phone }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                                >
                                    نام سرپرست شرکت
                                </label>
                                <input
                                    class="block w-[100%] p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.boss_name"
                                />
                                <p class="text-red-600">
                                    {{ $page.props.errors.boss_name }}
                                </p>
                            </div>
                        </div>
                        <label
                            class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            آدرس
                        </label>
                        <input
                            class="block w-[100%] p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            v-model="form.address"
                        />
                        <p class="text-red-600">
                            {{ $page.props.errors.address }}
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-4">
                            <div class="flex flex-col space-y-2">
                                <label
                                    class="text-lg font-medium text-gray-700 dark:text-gray-300"
                                >
                                    سمت
                                </label>
                                <input
                                    placeholder="مثلاً فرانت اند دولوپر"
                                    class="block w-[100%] p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.position"
                                />

                                <p
                                    v-if="$page.props.errors.position"
                                    class="text-red-500 text-sm"
                                >
                                    {{ $page.props.errors.position }}
                                </p>
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label
                                    class="text-lg font-medium text-gray-700 dark:text-gray-300"
                                >
                                    استاد
                                </label>
                                <select
                                    v-model="form.teacher_id"
                                    class="w-full p-3 text-gray-800 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                                >
                                    <option
                                        v-for="(teacher, index) in teachers"
                                        :key="index"
                                        :value="teacher.id"
                                    >
                                        {{ teacher.name }}
                                        {{ teacher.last_name }}
                                    </option>
                                </select>
                                <p
                                    v-if="$page.props.errors.teacher_id"
                                    class="text-red-500 text-sm"
                                >
                                    {{ $page.props.errors.teacher_id }}
                                </p>
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label
                                    class="text-lg font-medium text-gray-700 dark:text-gray-300"
                                >
                                    تاریخ شروع
                                </label>
                                <date-picker
                                    v-model="form.start_date"
                                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500"
                                ></date-picker>
                                <p
                                    v-if="$page.props.errors.start_date"
                                    class="text-red-500 text-sm"
                                >
                                    {{ $page.props.errors.start_date }}
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label
                                class="text-lg font-medium text-gray-700 dark:text-gray-300"
                            >
                                روزهای حضور
                            </label>

                            <div
                                class="grid grid-cols-3 gap-4 justify-around px-5"
                            >
                                <div>
                                    <label class="flex items-center space-x-2">
                                        <input
                                            type="checkbox"
                                            v-model="form.saturday"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                        />
                                        <span
                                            class="text-sm font-medium mx-1 text-gray-700 dark:text-gray-300"
                                        >
                                            شنبه
                                        </span>
                                    </label>
                                </div>
                                <div>
                                    <label class="flex items-center space-x-2">
                                        <input
                                            type="checkbox"
                                            v-model="form.sunday"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                        />
                                        <span
                                            class="text-sm font-medium mx-1 text-gray-700 dark:text-gray-300"
                                        >
                                            یکشنبه
                                        </span>
                                    </label>
                                </div>
                                <div>
                                    <label class="flex items-center space-x-2">
                                        <input
                                            type="checkbox"
                                            v-model="form.monday"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                        />
                                        <span
                                            class="text-sm font-medium mx-1 text-gray-700 dark:text-gray-300"
                                        >
                                            دوشنبه
                                        </span>
                                    </label>
                                </div>

                                <div>
                                    <label class="flex items-center space-x-2">
                                        <input
                                            type="checkbox"
                                            v-model="form.tuesday"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                        />
                                        <span
                                            class="text-sm font-medium mx-1 text-gray-700 dark:text-gray-300"
                                        >
                                            سه شنبه
                                        </span>
                                    </label>
                                </div>

                                <div>
                                    <label class="flex items-center space-x-2">
                                        <input
                                            type="checkbox"
                                            v-model="form.wednesday"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                        />
                                        <span
                                            class="text-sm font-medium mx-1 text-gray-700 dark:text-gray-300"
                                        >
                                            چهار شنبه
                                        </span>
                                    </label>
                                </div>

                                <div>
                                    <label class="flex items-center space-x-2">
                                        <input
                                            type="checkbox"
                                            v-model="form.thursday"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                        />
                                        <span
                                            class="text-sm font-medium mx-1 text-gray-700 dark:text-gray-300"
                                        >
                                            پنج شنبه
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row justify-between mb-4">
                    <button
                        class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-white text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white hover:border-transparent dark:bg-gray-800 dark:text-blue-400 dark:border-blue-400 dark:hover:bg-blue-500 dark:hover:text-white dark:hover:border-transparent"
                        as="button"
                        type="button"
                        @click="submit"
                    >
                        تایید
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import Vue3PersianDatetimePicker from "vue3-persian-datetime-picker";
import DatePicker from "vue3-persian-datetime-picker";

const props = defineProps({
    teachers: Object,
});

const form = useForm({
    user_id: usePage().props.auth.user.id,

    company: "",
    start_date: "",
    address: "",
    position: "",
    boss_name: "",
    phone: "",
    teacher_id: "",

    saturday: false,
    sunday: false,
    monday: false,
    tuesday: false,
    wednesday: false,
    thursday: false,
});
function submit() {
    form.post(route("student.store"), {
        preserveState: true,
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>
