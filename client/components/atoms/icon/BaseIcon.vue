<template>
  <div class="btn-container">
    <span class="btn-text">{{ text }}</span>
    <br>

    <v-btn :color="selected ? '#ffa26d' : '#eee'" fab :elevation="2" @click="onClick">
      <v-icon x-large color="#222">
        {{ icon }}
      </v-icon>
    </v-btn>
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
  text-align: center;
  width: 70px;
  //height: 60px;
}

.btn-text {
  font-size: 0.6rem;
}
</style>
