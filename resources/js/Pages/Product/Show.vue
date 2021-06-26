<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-8 lg:grid-cols-3 lg:gap-6"
                >
                    <ProductCard
                        v-for="product in products"
                        :key="product.product_id"
                        :product="product"
                    />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import ProductCard from './ProductCard';

export default {
    props: ['products'],

    components: {
        AppLayout,
        ProductCard,
    },
};
</script>
