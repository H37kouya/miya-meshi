<template>
  <v-container class="max-width-350">
    <v-row justify="space-between" align="center">
      <div>
        <p class="mb-2 sentence">
          開発
        </p>
        <p class="mb-0 sentence">
          宇都宮大学を拠点にするデジタルラボ
        </p>
        <p class="footer-group-title">
          U-lab
        </p>

        <ul class="d-flex link-inline-list border-black pa-0 mb-2">
          <li><a href="" class="sentence link-inline-list-item white--text">U-labとは？</a></li>
          <li><a href="" class="sentence link-inline-list-item white--text">U-labのHP</a></li>
        </ul>

        <div>
          <v-btn
            icon
            class="mr-2"
            href="https://www.instagram.com/ulab_uu/"
            target="_blank"
            rel="noopener"
          >
            <v-icon color="white" large>
              mdi-instagram
            </v-icon>
          </v-btn>

          <v-btn icon href="https://twitter.com/u_lab0811" target="_blank" rel="noopener">
            <v-icon color="white" large>
              mdi-twitter
            </v-icon>
          </v-btn>
        </div>
      </div>

      <div>
        <UlabImage />
      </div>
    </v-row>
  </v-container>
</template>

<style lang="scss" scoped>
@import "footer_field";

.footer-group-title {
  font-size: 1.75rem;
}
</style>
