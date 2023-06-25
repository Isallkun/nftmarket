<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-3 m-3">
            <b>Total User: {{ users_count ? users_count : 0 }} </b> <br />
            <b>Total NFT: {{ nfts_count ? nfts_count : 0 }} </b>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
  components: {
    ApplicationLogo,
    AppLayout,
  },

  props: {
    users_count: {
      type: Number,
      default: 0,
    },
    nfts_count: {
      type: Number,
      default: 0,
    },
  },
};
</script>
