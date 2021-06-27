<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cart</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="" v-if="carts.length <= 0">
          <div>
            <img
              src="/illustrations/checkout.svg"
              alt="checkout"
              class="max-h-64 w-auto"
            />
          </div>

          <h2 class="mt-4 text-3xl text-gray-500 text-center">
            There no item in your cart yet.
          </h2>
        </div>

        <div class="flex flex-col md:flex-row md:space-x-6" v-else>
          <div class="w-full md:w-4/6 overflow-hidden rounded-lg shadow">
            <div class="flex flex-col">
              <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                  class="
                    py-2
                    align-middle
                    inline-block
                    min-w-full
                    sm:px-6
                    lg:px-8
                  "
                >
                  <div
                    class="
                      shadow
                      overflow-hidden
                      border-b border-gray-200
                      sm:rounded-lg
                    "
                  >
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-gray-50">
                        <tr>
                          <th
                            scope="col"
                            class="
                              px-6
                              py-3
                              text-left text-xs
                              font-medium
                              text-gray-500
                              uppercase
                              tracking-wider
                            "
                          >
                            Item
                          </th>
                          <th
                            scope="col"
                            class="
                              px-6
                              py-3
                              text-left text-xs
                              font-medium
                              text-gray-500
                              uppercase
                              tracking-wider
                            "
                          >
                            Price
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="cart in carts" :key="cart.cart_id">
                          <td class="px-6 py-4 whitespace-nowrap max-w-md">
                            <div class="flex items-center">
                              <div class="">
                                <button
                                  class="
                                    text-gray-500
                                    opacity-50
                                    hover:opacity-100
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-gray-300
                                    focus:ring-opacity-75
                                    active:ring-2
                                    active:ring-gray-300
                                    active:ring-opacity-75
                                    rounded-full
                                  "
                                  @click.once="removeFromCart(cart)"
                                >
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                  >
                                    <path
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                  </svg>
                                </button>
                              </div>

                              <div class="flex-shrink-0 ml-4 h-32 w-32">
                                <img
                                  class="
                                    h-32
                                    w-32
                                    object-contain object-center
                                    rounded-lg
                                  "
                                  :src="cart.product.image_url"
                                  :alt="cart.product.name"
                                />
                              </div>
                              <div class="ml-4 truncate">
                                <div
                                  class="
                                    text-lg
                                    font-medium
                                    text-gray-900
                                    truncate
                                  "
                                >
                                  {{ cart.product.name }}
                                </div>

                                <div
                                  class="
                                    mt-2
                                    text-sm
                                    uppercase
                                    leading-none
                                    tracking-wider
                                    text-gray-600
                                  "
                                >
                                  <span class="mr-1">&#8377;</span>
                                  {{ cart.product.price }}
                                </div>

                                <div
                                  class="
                                    mt-1
                                    text-sm
                                    font-bold
                                    uppercase
                                    leading-none
                                    tracking-wider
                                    text-gray-600
                                  "
                                >
                                  <strong class="mr-1">
                                    {{ cart.quantity }}
                                  </strong>
                                  Qty
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="text-md text-gray-900">
                              <span class="mr-1">&#8377;</span>
                              {{ cart.total_amount }}
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div
            class="
              w-full
              max-h-36
              md:w-2/6
              mt-6
              md:mt-0
              px-4
              py-6
              text-center
              bg-white
              overflow-hidden
              rounded-lg
              shadow
            "
          >
            <div class="flex items-baseline justify-center space-x-2">
              <div
                class="
                  text-sm
                  font-medium
                  uppercase
                  leading-none
                  tracking-wider
                  text-gray-600
                "
              >
                Total Amount :
              </div>

              <h3 class="text-xl font-semibold text-indigo-500">
                {{ totalAmount }}
              </h3>
            </div>

            <div class="w-full mt-4">
              <jet-button type="button" class="rounded-none">
                Process Payment
              </jet-button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";

export default {
  name: "CartIndex",

  props: ["carts", "totalAmount"],

  components: {
    AppLayout,
    JetButton,
  },

  setup() {
    function removeFromCart(cart) {
      Inertia.delete(route("carts.destroy", { cart: cart.cart_id }));
    }

    return { removeFromCart };
  },
};
</script>

<style lang="scss" scoped></style>
