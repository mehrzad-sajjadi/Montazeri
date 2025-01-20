<template>
    <Head title="ُstudents" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2
                    class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
                >
                    افزودن گزارش
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

                        <div class="flex flex-wrap gap-4 mt-4">
                            <div class="flex-1">
                                <label
                                    class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                                >
                                    تاریخ گزارش
                                </label>
                                <date-picker
                                    v-model="form.date"
                                    :min="$page.props.now"
                                    :max="$page.props.now"
                                    class="w-full"
                                ></date-picker>
                                <p
                                    v-if="$page.props.errors.date"
                                    class="text-red-600"
                                >
                                    {{ $page.props.errors.date }}
                                </p>
                            </div>
                            <div class="flex-1">
                                <label
                                    class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                                >
                                    ساعت ورود
                                </label>
                                <date-picker
                                    type="time"
                                    v-model="form.start_time"
                                    class="w-full"
                                ></date-picker>
                                <p
                                    v-if="$page.props.errors.start_time"
                                    class="text-red-600"
                                >
                                    {{ $page.props.errors.start_time }}
                                </p>
                            </div>
                            <div class="flex-1">
                                <label
                                    class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                                >
                                    ساعت خروج
                                </label>
                                <date-picker
                                    type="time"
                                    v-model="form.end_time"
                                    class="w-full"
                                ></date-picker>
                                <p
                                    v-if="$page.props.errors.end_time"
                                    class="text-red-600"
                                >
                                    {{ $page.props.errors.end_time }}
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-around">
                            <div class="flex flex-col">
                                <!-- ورودی آپلود تصویر -->
                                <label
                                    class="mt-8 block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                                >
                                    تصویر پیوست
                                    <span class="text-sm"> (اختیاری) </span>
                                </label>
                                <input
                                    class="bg-[#00fbff] rounded-lg px-5 py-3 cursor-pointer"
                                    type="file"
                                    accept="image/*"
                                    @change="handleImageUpload"
                                />
                                <!-- پیش‌نمایش تصویر -->
                                <div v-if="previewImageUrl" class="mt-4">
                                    <img
                                        :src="previewImageUrl"
                                        alt="Selected Image"
                                        class="max-w-xs rounded-md shadow-sm border border-gray-300 dark:border-gray-600"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <!-- ورودی آپلود ویدیو -->
                                <label
                                    class="mt-8 block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                                >
                                    ویدیو پیوست
                                    <span class="text-sm"> (اختیاری) </span>
                                </label>
                                <input
                                    class="bg-[#00fbff] rounded-lg px-5 py-3 cursor-pointer"
                                    type="file"
                                    accept="video/*"
                                    @change="handleVideoUpload"
                                />
                                <!-- پیش‌نمایش ویدیو -->
                                <div v-if="previewVideoUrl" class="mt-4">
                                    <video
                                        :src="previewVideoUrl"
                                        controls
                                        class="max-w-xs rounded-md shadow-sm border border-gray-300 dark:border-gray-600"
                                    ></video>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p
                        class="flex mb-15 flex-row justify-center text-red-500 text-xl text-center"
                        v-if="$page.props.crud.errors"
                    >
                        {{ $page.props.crud.errors }}
                    </p>
                </div>

                <!-- دکمه‌ها -->
                <div class="flex flex-row justify-between mb-4">
                    <button
                        class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-white text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white hover:border-transparent dark:bg-gray-800 dark:text-blue-400 dark:border-blue-400 dark:hover:bg-blue-500 dark:hover:text-white dark:hover:border-transparent"
                        @click="submit"
                    >
                        ثبت گزارش
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
import { Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DatePicker from "vue3-persian-datetime-picker";

// تعریف props
const props = defineProps({
    now: String,
    errors: Object,
    studentId: Number,
});

// متغیرها برای پیش‌نمایش تصویر و ویدیو
const previewImageUrl = ref(null);
const previewVideoUrl = ref(null);

// فرم برای ارسال اطلاعات
const form = useForm({
    text: "",
    date: "",
    start_time: "",
    end_time: "",
    student_id: props.studentId,
    image: null, // برای ذخیره فایل تصویر
    video: null, // برای ذخیره فایل ویدیو
});

// مدیریت آپلود تصویر
function handleImageUpload(event) {
    const file = event.target.files[0];
    form.image = file; // ذخیره فایل در فرم
    if (file) {
        previewImageUrl.value = URL.createObjectURL(file); // تنظیم پیش‌نمایش تصویر
    } else {
        previewImageUrl.value = null; // پاک کردن پیش‌نمایش تصویر
    }
}

// مدیریت آپلود ویدیو
function handleVideoUpload(event) {
    const file = event.target.files[0];
    form.video = file; // ذخیره فایل در فرم
    if (file) {
        previewVideoUrl.value = URL.createObjectURL(file); // تنظیم پیش‌نمایش ویدیو
    } else {
        previewVideoUrl.value = null; // پاک کردن پیش‌نمایش ویدیو
    }
}

// ارسال فرم به سرور
function submit() {
    form.post(route("report.store"), {
        forceFormData: true, // استفاده از FormData برای ارسال فایل
        onSuccess: () => {
            previewImageUrl.value = null; // پاک کردن پیش‌نمایش تصویر
            previewVideoUrl.value = null; // پاک کردن پیش‌نمایش ویدیو
        },
    });
}
</script>
