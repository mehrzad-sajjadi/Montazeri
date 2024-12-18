<template>
    <div
        class="w-full md:w-[90%] lg:w-[70%] mx-auto p-4 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md overflow-x-auto"
    >
        <table
            class="min-w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden"
        >
            <thead class="bg-blue-600 dark:bg-gray-700 text-white">
                <tr>
                    <th
                        class="text-center py-3 px-4 text-base font-semibold uppercase tracking-wider"
                        v-for="(header, index) in headers"
                        :key="index"
                    >
                        {{ header }}
                    </th>
                </tr>
            </thead>

            <tbody
                class="bg-white dark:bg-gray-900 text-center divide-y divide-gray-200 dark:divide-gray-700"
            >
                <tr
                    v-for="(array, index) in arrays"
                    :key="index"
                    class="hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 transition-all duration-300 ease-in-out"
                >
                    <td
                        v-for="(item, index) in array"
                        :key="index"
                        class="py-3 px-4"
                    >
                        <span v-if="item.type == 'text'" :class="item.class">
                            {{ item.data }}
                        </span>

                        <span
                            v-else-if="item.type == 'button'"
                            class="flex flex-wrap justify-center gap-2"
                        >
                            <span
                                v-for="(btn, index) in item.items"
                                :key="index"
                            >
                                <Link
                                    v-if="btn.type == 'delete'"
                                    class="h-8 px-4 m-2 flex items-center text-sm text-white duration-150 rounded-lg bg-red-600 dark:bg-red-700 border-red-600 dark:border-red-700 border hover:border-black dark:hover:border-white"
                                    :href="btn.data"
                                    as="button"
                                >
                                    {{ btn.value }}
                                    <TrashIcon class="size-4"></TrashIcon>
                                </Link>

                                <Link
                                    v-if="btn.type == 'edit'"
                                    class="h-8 px-4 m-2 flex items-center text-sm transition-colors duration-150 rounded-lg focus:shadow-outline bg-white dark:bg-gray-700 hover:bg-black dark:hover:bg-gray-600 text-black dark:text-white hover:text-white border border-black dark:border-gray-300 hover:border-transparent"
                                    :href="btn.data"
                                    as="button"
                                >
                                    {{ btn.value }}
                                    <PencilSquareIcon
                                        class="size-4"
                                    ></PencilSquareIcon>
                                </Link>

                                <Link
                                    v-if="btn.type == 'show'"
                                    class="h-8 px-4 m-2 flex items-center text-sm text-indigo-100 transition-colors duration-150 bg-blue-500 dark:bg-blue-700 hover:bg-blue-950 dark:hover:bg-blue-900 rounded-lg focus:shadow-outline"
                                    :href="btn.data"
                                    as="button"
                                >
                                    {{ btn.value }}
                                    <EyeIcon class="size-4"></EyeIcon>
                                </Link>

                                <button
                                    v-if="btn.type == 'axios'"
                                    class="h-8 px-4 m-2 flex items-center text-sm text-indigo-100 transition-colors duration-150 bg-blue-500 dark:bg-blue-700 hover:bg-blue-950 dark:hover:bg-blue-900 rounded-lg focus:shadow-outline"
                                    @click="runModal(btn.data, array.id.data)"
                                >
                                    {{ btn.value }}
                                    <EyeIcon class="size-4"></EyeIcon>
                                </button>

                                <Link
                                    v-if="btn.type == 'add'"
                                    class="h-8 px-4 m-2 flex items-center text-sm transition-colors duration-150 bg-[#9dff00] dark:bg-[#7fbf00] hover:bg-[#fbff00] dark:hover:bg-[#a3ff00] rounded-lg focus:shadow-outline border dark:border-gray-600 hover:border-black"
                                    :href="btn.data"
                                    as="button"
                                >
                                    {{ btn.value }}
                                    <PlusIcon class="size-4"></PlusIcon>
                                </Link>
                            </span>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import { reactive, useSlots, ref } from "vue";

const props = defineProps({
    arrays: Object,
    headers: Object,
    id: String,
});

const showModal = ref(false);
const axiosContent = ref(null);
const axiosTableHeader = ref(null);
const axiosTitle = ref(null);
const emit = defineEmits(["id", "response"]);
function sendDate(id) {
    emit("id", id);
}

const data = ref(null);
function runModal(p1, p2) {
    showModal.value = true;
    let routeName = p1;
    axios
        .post(routeName, {
            id: p2,
        })
        .then((response) => {
            axiosContent.value = response.data["content"];
            axiosTableHeader.value = response.data["tableHeader"];
            axiosTitle.value = response.data["title"];
        });
}

const slots = useSlots();
function hasSlots(name) {
    return slots[name] && !isEmptySlot(slots[name]()).length;
}
function isEmptySlot(items) {
    if (!items.length) return true;
    return !items.some(hasSlotContent);
}
function hasSlotContent(item) {
    const type = item.type.toString();
    if (type === "Symbol(Comment)") return false;
    if (type === "Symbol(Text)" && !item.children.trim()) return false;
    return true;
}

import {
    TrashIcon,
    EyeIcon,
    PencilSquareIcon,
    PlusCircleIcon,
    PlusIcon,
} from "@heroicons/vue/24/solid";
</script>
