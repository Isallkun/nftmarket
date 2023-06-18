<template>
  <AppLayout title="Users">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        User Configuration
        <Link
          class="float-right"
          :href="route('users.create')"
          v-if="$page.props.permission.users.create"
        >
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
                  Name
                </th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                  State
                </th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                  Role
                </th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">
                  Address Wallet
                </th>
                <th
                  scope="col"
                  class="px-6 py-4 font-medium text-gray-900"
                ></th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
              <tr class="hover:bg-gray-50" v-for="user in users" :key="user.id">
                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                  <div class="relative h-10 w-10">
                    <img
                      class="h-full w-full rounded-full object-cover object-center"
                      :src="user.profile_photo_url"
                      alt=""
                    />
                    <span
                      class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"
                    ></span>
                  </div>
                  <div class="text-sm">
                    <div class="font-medium text-gray-700">{{ user.name }}</div>
                    <div class="text-gray-400">{{ user.email }}</div>
                  </div>
                </th>
                <td class="px-6 py-4">
                  <span
                    class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"
                  >
                    <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                    Active
                  </span>
                </td>
                <td class="px-6 py-4">{{ user.role }}</td>
                <td class="px-6 py-4">{{ user.eth_address }}</td>
                <td class="px-6 py-4">
                  <div class="flex justify-end gap-4">
                    <button
                      @click="deleteUser(user.id)"
                      x-data="{ tooltip: 'Delete' }"
                      x-tooltip="tooltip"
                      v-if="user.can.delete"
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
                      :href="route('users.show', user.id)"
                      target="_blank"
                      x-data="{ tooltip: 'Show' }"
                      x-tooltip="tooltip"
                      v-if="user.can.view"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        class="h-6 w-6"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.5"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.5"
                          d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.5"
                          d="M21 12a9 9 0 01-9 9m0-18a9 9 0 019 9h0-9"
                        />
                      </svg>
                    </Link>
                    <Link
                      :href="route('users.edit', user.id)"
                      target="_blank"
                      x-data="{ tooltip: 'Edit' }"
                      x-tooltip="tooltip"
                      v-if="user.can.update"
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

  props: ["users"],

  methods: {
    deleteUser(userId) {
      const result = confirm("Apakah anda yakin?");
      if (result) {
        Inertia.delete(route("users.destroy", userId), {
          preserveScroll: true,
        }).then(() => {
          // Reload the current page
          location.reload();
        });
      }
    },
  },
};
</script>
