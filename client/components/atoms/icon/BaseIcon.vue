<template>
  <div class="btn-container" :class="{ 'selected': selected }" @click="onClick">
    <v-icon style="line-height: 0; margin-top: 0.25rem;" size="30px">
      {{ icon }}
    </v-icon>

    <br>

    <span class="btn-text">{{ text }}</span>
  </div>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'

export default defineComponent({
  props: {
    icon: {
      type: String,
      default: undefined
    },

    text: {
      type: String,
      default: undefined
    },

    selected: {
      type: Boolean,
      default: false
    }
  },

  setup (_, context: SetupContext) {
    const onClick = () => context.emit('click')

    return {
      onClick
    }
  }
})
</script>

<style lang="scss" scoped>
.btn-container {
  background-color: #ddd;
  border-radius: 50%;
  text-align: center;
  width: 60px;
  height: 60px;
  padding: 0.25rem 0.25rem;
  cursor: pointer;

  &:hover {
    background-color: rgba(darken(#ddd, 10%), 0.8);
  }
}

.btn-text {
  font-size: 0.35rem;
  line-height: 0.5;
}

.selected {
  background-color: #ffa26d;

  &:hover {
    background-color: rgba(darken(#ffa26d, 10%), 0.8);
  }
}
</style>
