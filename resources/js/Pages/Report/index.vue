<template>
    <Head title="ُstudent Reports" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <div class="flex flex-col">
                    <h2
                        class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
                    >
                        لیست گزارشات شما
                    </h2>

                    <p>
                        مجموع ساعت های گزرانده شما از کارآموزی :
                        {{ totalTime }}
                        <br />
                        میزان ساعت باقی مانده
                        {{ reminder }}
                    </p>
                </div>
                <Link
                    :href="route('report.create')"
                    as="button"
                    type="button"
                    class="h-8 px-4 flex items-center m-2 text-sm transition-colors duration-150 bg-[#6c757d] hover:bg-[#757b80] rounded-lg text-white border border-[#6c757d] hover:border-transparent"
                >
                    افزودن گزارش
                    <NewspaperIcon class="size-5"></NewspaperIcon>
                </Link>
            </div>
        </template>

        <div class="flex justify-center py-4">
            <Table :headers="props.header" :arrays="reports"></Table>
        </div>
        <p
            class="flex mb-15 flex-row justify-center dark:text-white text-xl text-center"
            v-if="$page.props.crud.success"
        >
            {{ $page.props.crud.success }}
        </p>
    </AuthenticatedLayout>
</template>

<script setup>
import { Link, router, usePage, Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    totalTime: String,
    reports: Object,
    header: Object,
    reminder: String,
});
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
} from "@heroicons/vue/24/solid";
</script>
