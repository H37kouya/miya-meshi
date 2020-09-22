<template>
  <div class="d-flex justify-center">
    <div class="icon-box">
      <nuxt-link to="/" class="icon-box-link text-decoration-none">
        <div class="d-flex justify-center">
          <div>
            <v-img
              src="/s/icon-salad.png"
              width="60px"
              height="45px"
              alt="トップページのアイコン"
            />
          </div>
        </div>

        <p class="icon-text mb-0">
          トップページ
        </p>
      </nuxt-link>
    </div>

    <div class="icon-box">
      <nuxt-link to="/shops" class="icon-box-link text-decoration-none">
        <div class="d-flex justify-center">
          <div>
            <v-img
              src="/s/icon-melon-bread.png"
              width="60px"
              height="45px"
              alt="お店から探すのアイコン"
            />
          </div>
        </div>

        <p class="icon-text mb-0">
          お店から探す
        </p>
      </nuxt-link>
    </div>

    <div class="icon-box">
      <nuxt-link to="/" class="icon-box-link text-decoration-none">
        <div class="d-flex justify-center">
          <div>
            <v-img
              src="/s/icon-omelet-rice.png"
              width="60px"
              height="45px"
              alt="「みやめしとは」のアイコン"
            />
          </div>
        </div>

        <p class="icon-text mb-0">
          みやメシとは
        </p>
      </nuxt-link>
    </div>

    <div class="icon-box">
      <nuxt-link to="/" class="icon-box-link text-decoration-none">
        <div class="d-flex justify-center">
          <div>
            <v-img
              src="/s/icon-rice-boll.png"
              width="60px"
              height="45px"
              alt="お問い合わせのアイコン"
            />
          </div>
        </div>

        <p class="icon-text mb-0">
          お問い合わせ
        </p>
      </nuxt-link>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.icon-box {
  width: 120px;
  padding: 0 1rem;
  a {
    color: #333;
  }
}

.icon-text {
  background: #eeece5;
  border-radius: 0.5rem;
  font-size: 0.75rem;
  font-weight: bolder;
  padding: 0.25rem 0;
  text-align: center;
  bottom: 4px;
}
</style>
