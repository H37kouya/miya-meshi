<template>
  <div class="recruitment d-flex align-center justify-center">
    <a
      href="https://forms.gle/gAknXAaCrfsr8UdA8"
      class="white--text text-decoration-none w-100 pos-relative"
      target="_blank"
      rel="noopener"
    >
      <span class="recruitment-text">このサイトに掲載希望の<br>飲食店さんはこちら！</span>
      <v-img src="/rock-background.png" width="100%" max-height="90px" />
    </a>
  </div>
</template>

<style lang="scss" scoped>
.recruitment {
  background-color: grey;
  text-align: center;
  height: 90px;
  font-size: 1rem;
}

.recruitment-text {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  z-index: 5;
}
</style>
