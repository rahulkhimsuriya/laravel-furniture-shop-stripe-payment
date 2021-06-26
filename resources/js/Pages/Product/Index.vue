<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="px-8 md:px-0">
                    <div
                        class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-8 lg:grid-cols-3 lg:gap-6"
                    >
                        <div
                            v-for="product in products"
                            :key="product.product_id"
                        >
                            {{ product }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import JetButton from '@/Jetstream/Button';
import ProductCard from './ProductCard';

export default {
    name: 'ProductIndex',

    props: {
        products: {
            type: Array,
            required: true,
        },
    },

    components: [AppLayout, JetButton, ProductCard],

    data() {
        return {};
    },
};
</script>

<style lang="css" scoped></style>
