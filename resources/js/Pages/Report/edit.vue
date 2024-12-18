<template>
    <Head title="ُstudents" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2
                    class="font-medium text-xl text-gray-800 leading-tight dark:text-white"
                >
                    ویرایش گزارش تاریخ
                    <span class="underline">
                        {{ props.date }}
                    </span>
                </h2>
            </div>
        </template>

        <div
            class="flex flex-col w-5/6 mx-auto my-16 border border-gray-500 rounded-lg"
        >
            <div class="flex flex-col justify-between">
                <div>
                    <div class="mb-5 py-2 px-2 w-full">
                        <label
                            class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            متن گزارش
                        </label>
                        <input
                            v-model="form.text"
                            type="text"
                            class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            autofocus
                        />
                        <p v-if="$page.props.errors.text" class="text-red-600">
                            {{ $page.props.errors.text }}
                        </p>
                        <label
                            class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            تاریخ گزارش
                        </label>
                        <date-picker
                            v-model="form.date"
                            :max="$page.props.now"
                        ></date-picker>
                        <p class="text-red-600">
                            {{ $page.props.errors.date }}
                        </p>
                        <div>
                            <label
                                class="mt-8 block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                            >
                                ساعت ورود
                            </label>
                            <date-picker
                                type="time"
                                v-model="form.start_time"
                            ></date-picker>
                            <p
                                v-if="$page.props.errors.start_time"
                                class="text-red-600"
                            >
                                {{ $page.props.errors.start_time }}
                            </p>

                            <label
                                class="mt-8 block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                            >
                                ساعت خروج
                            </label>
                            <date-picker
                                type="time"
                                v-model="form.end_time"
                            ></date-picker>
                            <p
                                v-if="$page.props.errors.end_time"
                                class="text-red-600"
                            >
                                {{ $page.props.errors.end_time }}
                            </p>
                        </div>

                        <label
                            class="mt-8 block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            فایل پیوست
                            <span class="text-sm"> (اختیاری) </span>
                        </label>
                        <input
                            class="bg-[#00fbff] rounded-lg px-5 py-3 cursor-pointer"
                            type="file"
                            name="image"
                            @change="sentImage"
                        />
                        <!-- پیش نمایش تصویر جدید -->
                        <div v-if="previewImageUrl" class="mt-4">
                            <img
                                :src="previewImageUrl"
                                alt="Selected Image"
                                class="max-w-xs rounded-md shadow-sm border border-gray-300 dark:border-gray-600"
                            />
                        </div>
                        <div
                            v-if="image_url && !previewImageUrl"
                            class="mt-4 flex justify-between items-center"
                        >
                            <img
                                :src="image_url"
                                alt="گزارش تصویری"
                                class="max-w-xs rounded-lg shadow-md border border-gray-300 dark:border-gray-700"
                            />
                        </div>
                    </div>
                    <p
                        class="flex flex-row justify-center text-xl text-center pt-5 text-red-600"
                        v-if="$page.props.errors"
                    >
                        <span v-for="(error, index) in errors" :key="index">{{
                            error
                        }}</span>
                    </p>
                </div>

                <div class="flex flex-row justify-between mb-4">
                    <button
                        class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-white text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white hover:border-transparent dark:bg-gray-800 dark:text-blue-400 dark:border-blue-400 dark:hover:bg-blue-500 dark:hover:text-white dark:hover:border-transparent"
                        @click="update"
                    >
                        ویرایش گزارش
                    </button>
                    <Link
                        :href="route('report.index')"
                        type="button"
                        as="button"
                        class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent"
                    >
                        انصراف
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Link, router, usePage, Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Vue3PersianDatetimePicker from "vue3-persian-datetime-picker";
import DatePicker from "vue3-persian-datetime-picker";
const props = defineProps({
    now: String,
    errors: Object,
    studentId: Number,
    report: Object,
    date: String,
    image_url: String,
    image_name: String,
});
const previewImageUrl = ref(null);

const form = useForm({
    text: props.report.text,
    date: props.date,
    student_id: props.studentId,
    image: null,
});
// function update() {
//     form.put(route("report.update", props.report.id));
// }

// function sentImage(event) {
//     const file = event.target.files[0];
//     form.image = file;

//     if (file) {
//         previewImageUrl.value = URL.createObjectURL(file);
//     } else {
//         previewImageUrl.value = null;
//     }
// }
function update() {
    form.put(route("report.update", props.report.id), {
        forceFormData: true,
    });
}
import {
    TrashIcon,
    EyeIcon,
    PencilSquareIcon,
    PlusCircleIcon,
    ClipboardDocumentListIcon,
    HandThumbDownIcon,
    CheckBadgeIcon,
    UserPlusIcon,
    FolderPlusIcon,
    NewspaperIcon,
    ArrowUturnLeftIcon,
} from "@heroicons/vue/24/solid";
</script>
