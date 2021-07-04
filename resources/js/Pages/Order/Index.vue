<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Orders</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <template v-if="orders.total <= 0">
          <div
            class="
              container
              mx-auto
              flex
              px-5
              items-center
              justify-center
              flex-col
            "
          >
            <img
              class="
                lg:w-2/6
                md:w-3/6
                w-5/6
                mb-10
                object-cover object-center
                rounded
              "
              alt="checkout"
              src="/illustrations/undraw_order_delivered.svg"
            />
          </div>

          <h2 class="mt-4 text-3xl text-gray-500 text-center">
            You don't have order history.
          </h2>
        </template>

        <template v-else>
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
                          Amount
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
                          Status
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
                          Order Date
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Actions</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-for="order in orders.data" :key="order.order_id">
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div>
                              <div
                                v-for="orderDetail in order.order_details"
                                :key="orderDetail.id"
                                class="text-sm text-gray-500"
                              >
                                {{ orderDetail.product.name }}
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm font-semibold text-gray-900">
                            <span class="mr-0.5">&#8377;</span>
                            {{ order.amount }}
                            <span class="ml-1 text-gray-500 uppercase">
                              {{ order.currency }}
                            </span>
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <span
                            class="
                              px-2
                              inline-flex
                              text-xs
                              leading-5
                              font-semibold
                              rounded-full
                              bg-green-100
                              text-green-800
                            "
                          >
                            {{ order.status }}
                          </span>
                        </td>
                        <td
                          class="
                            px-6
                            py-4
                            whitespace-nowrap
                            text-sm text-gray-500
                          "
                        >
                          {{ order.created_at }}
                        </td>
                        <td
                          class="
                            px-6
                            py-4
                            whitespace-nowrap
                            text-right text-sm
                            font-medium
                          "
                        >
                          <a
                            :href="order.receipt_url"
                            class="text-indigo-600 hover:text-indigo-900"
                          >
                            View Receit
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <pagination class="mt-6" :links="orders.links" />
        </template>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";

export default {
  name: "OrderIndex",

  components: {
    AppLayout,
    Pagination,
  },

  props: ["orders"],

  setup(props) {
    return {};
  },
};
</script>

<style lang="scss" scoped></style>
