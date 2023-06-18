<template>
  <select
    :id="id"
    :value="value"
    @input="$emit('update:modelValue', $event.target.value)"
    :class="inputClass"
  >
    <slot></slot>
  </select>
</template>

<script>
export default {
  props: {
    id: {
      type: String,
      required: true,
    },
    modelValue: {
      type: String,
      required: true,
    },
    inputClass: {
      type: String,
      default: "",
    },
  },
};
</script>
