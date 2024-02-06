<template>
  <button
    :disabled="isDisabled"
    :type="btnType || 'button'"
    :class="['custom-btn', containerStyles]"
    @click="handleClick"
  >
    <span :class="['flex-1', textStyles]">{{ title }}</span>
    <template v-if="rightIcon">
      <div class="relative w-6 h-6">
        <img :src="rightIcon" alt="arrow_left" class="object-contain" />
      </div>
    </template>
  </button>
</template>

<script>
import { ref } from 'vue';

export default {
  props: {
    isDisabled: Boolean,
    btnType: {
      type: String,
      default: 'button',
    },
    containerStyles: String,
    textStyles: String,
    title: String,
    rightIcon: String,
    handleClick: Function,
  },
  setup(props, { refs }) {
    const buttonRef = ref(null);

    if (refs) {
      refs.buttonRef = buttonRef;
    }

    return {
      buttonRef,
    };
  },
};
</script>
