<template>
  <header>
    <div style="width: 100%;" class="pos-relative">
      <div class="top-image" />

      <v-card class="news">
        <v-img src="/miyameshi-ticket.jpg" />
      </v-card>

      <div class="text-right pt-6 px-4 developer-name">
        <small class="developer-name-small">運営: みやメシ応援隊 開発: U-lab</small>
      </div>
    </div>

    <div>
      <SearchField />
    </div>
  </header>
</template>

<script>
export default {
  props: {
    value: {
      type: Boolean,
      default: false
    }
  },

  computed: {
    drawer: {
      get () {
        return this.value
      },
      set (newVal) {
        return this.$emit('input', newVal)
      }
    },

    getTitle: () => 'みやメシ応援隊'
  }
}
</script>

<style lang="scss" scoped>
.top-image {
  background-color: grey;
  width: 100%;
  height: 160px;
}

.news {
  position: absolute;
  bottom: 15%;
  left: 50%;
  transform: translateX(-50%);
  background-color: darkgray;
  max-width: 200px;
  max-height: 120px;
}

.developer-name {
  color: #a7a7a7;
}

.developer-name-small {
  font-size: 0.75rem;
}
</style>
