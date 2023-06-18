<template>
  <AppLayout title="User Edit">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        User Edit
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <FormSection @submitted="updateProfileInformation">
          <template #title> Profile Information </template>

          <template #description>
            Update your account's profile information and email address.
          </template>

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
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

export default {
  components: {
    AppLayout,
    Link,
    FormSection,
    InputError,
    InputLabel,
    PrimaryButton,
    SecondaryButton,
    TextInput,
    ActionMessage,
  },

  props: ["user"],

  setup(props) {
    const form = useForm({
      _method: "PUT",
      name: props.user.name,
      email: props.user.email,
      eth_address: props.user.eth_address,
    });

    const updateProfileInformation = () => {
      form.post(route("users.update", props.user.id), {
        preserveScroll: true,
      });
    };

    return { form, updateProfileInformation };
  },
};
</script>
