<template>
  <v-container class="max-width-350">
    <v-row justify="space-between" align="center">
      <div>
        <p class="mb-2 sentence">
          開発
        </p>
        <p class="mb-0 sentence">
          地域に根差すテクノロジー集団
        </p>
        <p class="footer-group-title">
          U-lab
        </p>

        <ul class="d-flex link-inline-list border-black pa-0 mb-2">
          <li>
            <a
              href="https://note.com/kazuma7/n/n75fb0175270d"
              class="sentence link-inline-list-item white--text"
            >U-labとは？</a>
          </li>
          <li>
            <a
              href="https://uu-circle20.firebaseapp.com/"
              class="sentence link-inline-list-item white--text"
            >宇大サークルビラ一覧</a>
          </li>
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
.footer-group-title {
  font-size: 1.75rem;
  font-weight: bolder;
  margin-bottom: 4px !important;
}

.link-inline-list {
  list-style: none;

  li {
    padding: 0 0.5rem;
  }

  li:first-child {
    padding: 0 0.5rem 0 0;
  }

  li:not(:last-child) {
    border-right: 1px solid;
  }
}

.link-inline-list-item {
  text-decoration: none;

  &:hover {
    text-decoration: underline;
  }
}

.sentence {
  font-size: 0.8rem;
}
</style>
