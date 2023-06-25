<template>
  <AppLayout title="NFT Conf">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        NFT Configuration
        <Link class="float-right" :href="route('nfts.create')">
          <JetButton>Create</JetButton>
        </Link>
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5"
        >
          <table
            class="w-full border-collapse bg-white text-left text-sm text-gray-500"
          >
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                  NFT Image
                </th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                  Name
                </th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                  Collection
                </th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                  Price
                </th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                  Quantity
                </th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                  Description
                </th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                  External Link
                </th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                  Author
                </th>
                <th
                  scope="col"
                  class="px-6 py-4 font-medium text-gray-900"
                ></th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
              <tr
                class="hover:bg-gray-50 items-center"
                v-for="nft in nfts"
                :key="nft.id"
              >
                <th class="px-6 py-4 font-normal text-gray-900">
                  <div class="w-20 h-20">
                    <img
                      class="h-full w-full rounded-full object-cover object-center"
                      :src="getImageUrl(nft.image)"
                      alt=""
                    />
                  </div>
                </th>
                <td class="px-6 py-4">{{ nft.name }}</td>
                <td class="px-6 py-4">{{ nft.collection }}</td>
                <td class="px-6 py-4">{{ nft.price }}</td>
                <td class="px-6 py-4">{{ nft.quantity }}</td>
                <td class="px-6 py-4">{{ nft.description }}</td>
                <td class="px-6 py-4">{{ nft.external_url }}</td>
                <td class="px-6 py-4">{{ nft.author }}</td>
                <td class="px-6 py-4">
                  <div class="flex justify-end gap-4">
                    <button
                      @click="deleteNft(nft.id)"
                      x-data="{ tooltip: 'Delete' }"
                      x-tooltip="tooltip"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-6 w-6"
                        x-tooltip="tooltip"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                        />
                      </svg>
                    </button>
                    <Link
                      :href="route('nfts.edit', nft.id)"
                      target="_blank"
                      x-data="{ tooltip: 'Edit' }"
                      x-tooltip="tooltip"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-6 w-6"
                        x-tooltip="tooltip"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                        />
                      </svg>
                    </Link>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import JetButton from "@/components/PrimaryButton.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
  components: {
    AppLayout,
    Link,
    JetButton,
  },

  props: ["nfts"],

  methods: {
    deleteNFT(nftId) {
      const result = confirm("Apakah Anda yakin ingin menghapus NFT ini?");
      if (result) {
        Inertia.delete(route("nfts.destroy", nftId), {
          preserveScroll: true,
          onError: () => {
            // Handle error if deletion fails
            alert("Gagal menghapus NFT.");
          },
          onSuccess: () => {
            // Reload the current page
            location.reload();
          },
        });
      }
    },
    getImageUrl(image) {
      return image ? "/storage/" + image : "";
    },
  },
};
</script>
