<template>
  <app-layout>
    <section class="pt-12 text-gray-600 body-font">
      <div
        class="container mx-auto flex px-5 items-center justify-center flex-col"
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
          alt="payment success"
          src="/illustrations/undraw_payment_success.svg"
        />

        <div class="text-center lg:w-2/3 w-full">
          <h1
            class="
              title-font
              sm:text-4xl
              text-3xl
              mb-4
              font-medium
              text-indigo-600
            "
          >
            Payment Successfull
          </h1>

          <div class="flex justify-center">
            <inertia-link :href="route('dashboard')">
              <jet-button class="uppercase">GO BACK TO HOME</jet-button>
            </inertia-link>
          </div>
        </div>
      </div>
    </section>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button.vue";

export default {
  name: "PaymentSuccess",

  components: { AppLayout, JetButton },

  setup() {
    return {};
  },
};
</script>

<style lang="scss" scoped>
</style>
