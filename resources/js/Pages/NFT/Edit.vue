<template>
  <AppLayout title="NFT Edit">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        NFT Edit
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <FormSection @submitted="updateNFTInformation">
          <template #title> NFT Information </template>

          <template #description> Update your NFT's information. </template>

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

            <!-- Collection -->
            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="collection" value="Collection" />
              <TextInput
                id="collection"
                v-model="form.collection"
                type="text"
                class="mt-1 block w-full"
                autocomplete="off"
              />
              <InputError :message="form.errors.collection" class="mt-2" />
            </div>

            <!-- Price -->
            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="price" value="Price" />
              <TextInput
                id="price"
                v-model="form.price"
                type="number"
                class="mt-1 block w-full"
                autocomplete="off"
              />
              <InputError :message="form.errors.price" class="mt-2" />
            </div>

            <!-- Quantity -->
            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="quantity" value="Quantity" />
              <TextInput
                id="quantity"
                v-model="form.quantity"
                type="number"
                class="mt-1 block w-full"
                autocomplete="off"
              />
              <InputError :message="form.errors.quantity" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="description" value="Description" />
              <TextInput
                id="description"
                v-model="form.description"
                type="text"
                class="mt-1 block w-full"
                autocomplete="off"
              />
              <InputError :message="form.errors.description" class="mt-2" />
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

  props: ["nft"],

  setup(props) {
    const form = useForm({
      _method: "PUT",
      name: props.nft.name,
      collection: props.nft.collection,
      description: props.nft.description,
      price: props.nft.price,
      quantity: props.nft.quantity,
    });

    const updateNFTInformation = () => {
      form.post(route("nfts.update", props.nft.id), {
        preserveScroll: true,
      });
    };

    return { form, updateNFTInformation };
  },
};
</script>
