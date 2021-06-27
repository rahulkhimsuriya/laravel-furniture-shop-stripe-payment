<template>
    <div
        class="
            bg-white
            transition
            ease-in-out
            duration-300
            shadow
            hover:shadow-lg
            rounded-lg
        "
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

                <button
                    type="button"
                    class="
                        tracking-tighter
                        leading-none
                        uppercase
                        font-semibold
                        text-xs
                        opacity-75
                        hover:opacity-100
                        focus:outline-none focus:opacity-100
                        active:opacity-100
                    "
                    @click.stop="addToCard"
                    :disabled="isCartProcessing"
                >
                    Add to Cart
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import { computed } from "@vue/runtime-core";

export default {
    name: "ProductCard",

    props: {
        product: {
            type: Object,
            required: true,
        },
    },

    setup(props) {
        const form = useForm({ quantity: 1 });

        const isCartProcessing = computed(() => form.processing);

        function addToCard() {
            form.post(
                route("product.carts.store", {
                    product: props.product.product_id,
                })
            );
        }

        return { addToCard, isCartProcessing };
    },
};
</script>

<style lang="css" scoped></style>
