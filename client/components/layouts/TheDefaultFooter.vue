<template>
  <v-footer
    app
    absolute
    class="d-block pa-0"
  >
    <div>
      <RecruitmentFooterField />
    </div>

    <div>
      <SearchField />
    </div>

    <div class="miya-meshi-container border-grey-top">
      <MiyaMeshiFooterField />
    </div>

    <div class="ulab-container">
      <UlabFooterField />
    </div>

    <div class="copyright-container">
      <CopylightFooterField />
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

.copyright-container {
  border-top: 1px #969696 solid;
  background-color: #333;
}
</style>
