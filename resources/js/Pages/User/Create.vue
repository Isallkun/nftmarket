<template>
  <AppLayout title="User Create">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        User Create
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <FormSection @submitted="createUser">
          <template #title> Create User Profile </template>

          <template #description> Create User Profile. </template>

          <template #form>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="name" value="Name" />
              <TextInput
                id="name"
                v-model="form.name"
                type="text"
                class="mt-1 block w-full"
                autocomplete="name"
              />
              <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="email" value="Email" />
              <TextInput
                id="email"
                v-model="form.email"
                type="email"
                class="mt-1 block w-full"
                autocomplete="username"
              />
              <InputError :message="form.errors.email" class="mt-2" />
            </div>

            <!-- Role -->
            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="role" value="Role" />
              <SelectInput
                id="role"
                v-model="form.role"
                class="mt-1 block w-full"
              >
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </SelectInput>
              <InputError :message="form.errors.role" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="eth_address" value="Wallet Address" />
              <TextInput
                id="eth_address"
                v-model="form.eth_address"
                type="text"
                class="mt-1 block w-full"
                autocomplete="off"
              />
              <InputError :message="form.errors.eth_address" class="mt-2" />
            </div>
          </template>

          <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
              Saved.
            </ActionMessage>

            <PrimaryButton
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Save
            </PrimaryButton>
          </template>
        </FormSection>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { usePage } from "@inertiajs/inertia-vue3";

export default {
  components: {
    AppLayout,
    Link,
    FormSection,
    InputError,
    InputLabel,
    PrimaryButton,
    TextInput,
    ActionMessage,
    SelectInput,
  },

  setup() {
    const form = useForm({
      _method: "POST",
      name: "",
      email: "",
      role: "",
      eth_address: "",
    });

    const { $inertia } = usePage();

    const createUser = () => {
      form
        .post(route("users.store"))
        .then(() => {
          // Reload the current page after successful submission
          return this.$inertia.reload();
        })
        .catch((error) => {
          console.error(error);
        });
    };

    return { form, createUser };
  },
};
</script>
