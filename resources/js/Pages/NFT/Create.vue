<template>
  <AppLayout title="NFT Create">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        NFT Create
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <FormSection @submitted="createNFT">
          <template #title> Create NFT </template>

          <template #description> Create NFT. </template>

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
                type="text"
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
                type="text"
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

            <!-- External URL -->
            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="external_url" value="External Link" />
              <TextInput
                id="external_url"
                v-model="form.external_url"
                type="text"
                class="mt-1 block w-full"
                autocomplete="off"
              />
              <InputError :message="form.errors.external_url" class="mt-2" />
            </div>

            <!-- Author -->
            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="author" value="Author" />
              <TextInput
                id="author"
                v-model="form.author"
                type="text"
                class="mt-1 block w-full"
                autocomplete="off"
              />
              <InputError :message="form.errors.author" class="mt-2" />
            </div>

            <!-- Image -->
            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="image" value="Image" />
              <input
                id="image"
                type="file"
                @input="handleImageUpload"
                class="mt-1 block w-full"
              />
              <!--<TextInput
                id="image"
                v-model="form.image"
                type="text"
                class="mt-1 block w-full"
                autocomplete="off"
              />-->
              <InputError :message="form.errors.image" class="mt-2" />
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
import { Link, useForm, usePage, router } from "@inertiajs/inertia-vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

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
  },

  setup() {
    const form = useForm({
      name: "",
      collection: "",
      price: "",
      quantity: "",
      description: "",
      external_url: "",
      author: "",
      image: null,
    });

    const { $inertia } = usePage();

    const createNFT = () => {
      form.post(route("nfts.store"));
    };

    const handleImageUpload = (event) => {
      const file = event.target.files[0];
      form.image = file;
    };

    return { form, createNFT, handleImageUpload };
  },
};
</script>
