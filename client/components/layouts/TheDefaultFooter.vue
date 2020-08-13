<template>
  <v-footer
    app
    absolute
    class="d-block pa-0"
  >
    <div class="recruitment d-flex align-center justify-center">
      <a
        href="https://forms.gle/gAknXAaCrfsr8UdA8"
        class="white--text text-decoration-none w-100 pos-relative"
        target="_blank"
        rel="noopener"
      >
        <span class="recruitment-text">このサイトに掲載希望の飲食店さんはこちら！</span>
        <v-img src="/tree-background.png" width="100%" max-height="90px" />
      </a>
    </div>

    <div>
      <SearchField />
    </div>

    <div class="miya-meshi-container border-grey-top">
      <FooterMiyaMeshiField />
    </div>

    <div class="ulab-container">
      <FooterUlabField />

      <FooterCopylight />
    </div>
  </v-footer>
</template>

<style lang="scss">
.border-grey-top {
  border-top: 1px solid #c4c4c4;
}

.miya-meshi-container {
  width: 100%;
  background-color: #fff;
  color: $u-black;
  padding: 0 0.5rem;
}

.ulab-container {
  width: 100%;
  background-color: #333;
  color: #fff;
  padding: 0 0.5rem;
}

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
