<template>
  <footer
    class="pa-0"
  >
    <RecruitmentFooterField />

    <v-lazy>
      <SearchField />
    </v-lazy>

    <v-lazy>
      <div class="miya-meshi-container border-grey-top">
        <MiyaMeshiFooterField />
      </div>
    </v-lazy>

    <v-lazy>
      <div class="ulab-container">
        <UlabFooterField />
      </div>
    </v-lazy>

    <div class="copyright-container">
      <CopylightFooterField />
    </div>
  </footer>
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
