<template>
    <div
        class="bg-white transition ease-in-out duration-300 shadow hover:shadow-lg rounded-lg"
    >
        <img
            :src="product.image_url"
            :alt="product.name"
            class="h-64 w-full object-fit object-center rounded-lg"
        />

        <div class="px-4 pt-4 pb-2 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 truncate">
                {{ product.name }}
            </h3>
            <div class="flex items-center justify-between">
                <p class="font-semibold text-md text-gray-600">
                    <span class="mr-1">&#8377;</span>
                    {{ product.price }}
                </p>

                <jet-button>Add to Cart</jet-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductCard',

    props: {
        product: {
            type: Object,
            required: true,
        },
    },

    data() {
        return {};
    },
};
</script>

<style lang="css" scoped></style>
