<template>
    <div
        class="h-screen w-[300px] flex flex-col text-white text-center bg-gray-500 z-10"
    >
        <template v-for="(item, index) in menu" :key="index">
            <div
                v-if="item.show"
                class="text-center flex justify-center items-center w-full h-[50px]"
                :class="[
                    item.active
                        ? 'font-bold text-gray-900 bg-gray-100'
                        : 'bg-gray-900 text-white',
                ]"
            >
                <Link
                    :href="route(item.route)"
                    :active="item.active"
                    class="w-full h-full flex justify-center items-center"
                >
                    {{ item.name }}
                </Link>
            </div>
        </template>

        <!-- <div
            :class="[
                'text-center flex justify-center items-center w-full h-[50px] text-white',
                route().current('room_index') ||
                route().current('room_edit') ||
                route().current('room_show') ||
                route().current('room_create') ||
                route().current('device_room_create')
                    ? 'font-bold text-gray-900 bg-gray-500'
                    : 'bg-gray-900 text-white',
            ]"
        >
            <NavLink
                :href="route('room_index')"
                :active="
                    route().current('room_index') ||
                    route().current('room_edit') ||
                    route().current('room_show') ||
                    route().current('room_create') ||
                    route().current('device_room_create')
                "
            >
                Room
            </NavLink>
        </div> -->
    </div>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";

const props = defineProps({
    menu: Object,
});
</script>
