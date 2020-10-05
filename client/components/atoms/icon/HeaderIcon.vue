<template>
  <div class="icon-box">
    <component
      :is="to ? 'nuxt-link' : 'a'"
      :to="to"
      :href="href"
      :target="href ? '_blank' : undefined"
      :rel="href ? 'noopener' : undefined"
      class="icon-box-link text-decoration-none"
    >
      <div class="d-flex justify-center">
        <div>
          <v-img
            :src="src"
            width="60px"
            height="45px"
            :alt="alt"
          />
        </div>
      </div>

      <p class="icon-text mb-0">
        {{ text }}
      </p>
    </component>
  </div>
</template>

<script>
export default {
  props: {
    alt: {
      type: String,
      default: undefined
    },

    src: {
      type: String,
      default: undefined
    },

    to: {
      type: [String, Object],
      default: undefined
    },

    text: {
      type: String,
      default: undefined
    },

    href: {
      type: String,
      default: undefined
    }
  }
}
</script>

<style lang="scss" scoped>
.icon-box {
  width: 120px;
  padding: 0 1rem;
  a {
    color: $u-black;
  }
}

.icon-text {
  background: $gray;
  border-radius: 0.5rem;
  font-size: 0.75rem;
  font-weight: bolder;
  padding: 0.125rem 0;
  text-align: center;
  bottom: 4px;
}
</style>
