import firebase from 'firebase'
import { Menu } from '@/lib/types/Menu'
import { Type } from '@/lib/enum'
import { removeUndefinedFromObject } from '@/src/utils/Object'
const MENU_COLLECTION_NAME = 'menus'

/**
 * Menuを削除する
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const deleteMenu = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  await $fireStore.collection(MENU_COLLECTION_NAME).doc(id).delete()
}

/**
 * 複数のMenuをまとめて削除する
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string[] } ids
 */
export const deleteMultipleMenu = async (
  $fireStore: firebase.firestore.Firestore,
  ids: string[]
) => {
  // 並列処理のためのPromiseを用意
  const promises = ids.map(id => deleteMenu($fireStore, id))

  await Promise.all(promises)
}

/**
 * ShopIDによって、Menuを削除する
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const deleteMenuByShopID = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  const menus = await getMenuListByShopID($fireStore, id, 0, true)
  const ids = menus.map(map => map.id)
  await deleteMultipleMenu($fireStore, ids)
}

/**
 * Menu一覧を取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { Number } limit
 * @param { Boolean } admin
 */
export const getMenuList = async (
  $fireStore: firebase.firestore.Firestore,
  limit: number = 12,
  admin: boolean = false
) => {
  const publicWhere: boolean[] = admin ? [true, false] : [true]

  const func = $fireStore
    .collection(MENU_COLLECTION_NAME)
    .where('public', 'in', publicWhere)
    .orderBy('priority', 'desc')

  const list = limit > 0 ? await func.limit(limit).get() : await func.get()

  const menus = [] as Menu[]
  list.forEach((doc) => {
    menus.push(firestoreDocDataToMenu(doc))
  })
  return menus
}

/**
 * ShopIDによって、Menu一覧を取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } shopID
 * @param { Number } limit
 * @param { Boolean } admin
 */
export const getMenuListByShopID = async (
  $fireStore: firebase.firestore.Firestore,
  shopID: string,
  limit: number = 12,
  admin: boolean = false
) => {
  const publicWhere: boolean[] = admin ? [true, false] : [true]

  const func = $fireStore
    .collection(MENU_COLLECTION_NAME)
    .where('shopID', '==', shopID)
    .where('public', 'in', publicWhere)
    .orderBy('priority', 'desc')

  const list = limit > 0 ? await func.limit(limit).get() : await func.get()

  const menus = [] as Menu[]
  list.forEach((doc) => {
    menus.push(firestoreDocDataToMenu(doc))
  })
  return menus
}

/**
 * Menuの取得
 *
 * @param { firebase.firestore.Firestore } $fireStore
 * @param { string } id
 */
export const getMenuByID = async (
  $fireStore: firebase.firestore.Firestore,
  id: string
) => {
  const doc = await $fireStore.collection(MENU_COLLECTION_NAME).doc(id).get()
  return firestoreDocDataToMenu(doc)
}

/**
 * FirebaseのデータをMenu型に変換
 *
 * @param { firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot } doc
 */
export const firestoreDocDataToMenu = (
  doc: firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot
) => {
  const docData = doc.data()

  return {
    type: Type.MENU,
    id: doc.id,
    ...docData
  } as Menu
}
