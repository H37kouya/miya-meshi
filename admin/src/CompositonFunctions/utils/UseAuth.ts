import { SetupContext } from '@vue/composition-api'

export const useAuth = ({ $fireAuth, $router }: SetupContext['root']) => {
  const logout = async () => {
    // ログアウトに関する処理を書く

    // ログアウト処理後にログイン画面へ遷移
    return await $router.push('/signin')
  }

  return {
    logout
  }
}
